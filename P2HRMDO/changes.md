# ARIMA Integration — Change Log

Running record of fixes applied on top of the `feat: integrate arima` commit (`59b9304`).
Each entry maps 1:1 to a commit. Newest last.

---

## 1. ARIMA forecast always returned 0 (blocking)

**Problem**
`scripts/arima_forecast.js` required the `arima` npm package at module top level,
outside the `try` block. Only the large-dataset branch (>= 10 data points) actually
uses that package, but the require ran on every invocation. With `node_modules`
absent — which is the normal state of a fresh clone, since `/node_modules` is
gitignored — the script died with `MODULE_NOT_FOUND` and exit code 1 before
reaching any forecasting logic.

The controller saw `!$result->successful()` and left `$arimaForecast = 0`, so the
UI reported "the possible Manpower Required for the next semester is: **0**" as if
it were a real forecast. Every department, every semester.

**Fix**
Moved `require('arima')` inside the `>= 10` branch so the package is loaded lazily.
The small-dataset path (the only one a 5-year series can reach) no longer depends
on it at all.

**Files**
- `scripts/arima_forecast.js`

**Verification**
```
$ node scripts/arima_forecast.js '{"series":[10,12,11,14,15],"steps":1}'
{"forecast":16,"model":"ARIMA(1,1,0)"}   # exit 0  (was: MODULE_NOT_FOUND, exit 1)
```

---

## 2. `shell_exec('which node')` on every request (blocking)

**Problem**
The controller resolved the Node binary at request time with
`trim(shell_exec('which node') ?? 'node')`. Three failure modes:

1. `shell_exec` is disabled by default in many hardened / shared-hosting PHP
   configurations (`disable_functions`), which makes the call return `null`.
2. `which` does not exist on Windows, so XAMPP deployments resolve nothing.
3. It spawns an extra shell process on every single API call, purely to look up
   a value that never changes between requests.

**Fix**
Introduced `config/forecasting.php` with a `node_binary` setting, read from the
`NODE_BINARY` env var and defaulting to `node` (resolved via PATH). The path is
now deployment configuration, not a runtime shell lookup, and it is cached along
with the rest of the config by `php artisan config:cache`.

Deployments where the web server's PATH does not include Node set an absolute
path in `.env`, e.g. `NODE_BINARY=/usr/local/bin/node`.

**Files**
- `config/forecasting.php` (new)
- `app/Http/Controllers/ForecastingDataController.php`
- `.env.example`

---

## 3. A failed forecast was reported as a forecast of 0 (blocking)

**Problem**
Failure and success shared the same output channel end to end:

- `scripts/arima_forecast.js` caught every exception and printed
  `{"forecast": 0, "model": "error"}` on **stdout** with exit code 0, so a crash
  looked exactly like a successful run.
- The controller had no `else` on `if ($result->successful())` — a non-zero exit
  left `$arimaForecast` at its initialised value of `0`, with nothing logged.

Since 0 is a legitimate forecast ("this department needs no additional staff"),
nobody — user or developer — could tell a broken Node install from a genuinely
flat department. Issue #1 above went unnoticed for exactly this reason.

**Fix**
Three layers, one rule: *an unavailable forecast must never look like a number.*

1. **Script** — errors now go to `stderr` with `process.exit(1)`. An empty or
   non-array `series` is rejected as invalid input rather than answered with 0.
2. **Controller** — extracted `arimaForecast(array $series): ?int`, which returns
   `null` on any failure and writes a `Log::warning` carrying the exit code and
   `stderr`. Malformed script output is treated as a failure too. The API now
   returns `arima.forecast === null` when no forecast could be produced.
3. **Views** — `generateChartExplanation()` gained a guard clause that renders
   "ARIMA forecast is unavailable" instead of the string "null". Chart.js draws
   no bar for a null data point, which is the correct visual.

Extracting the private method was not cosmetic: the early-return style is what
lets each failure path log its own cause and bail, instead of falling through to
a shared default.

**Files**
- `scripts/arima_forecast.js`
- `app/Http/Controllers/ForecastingDataController.php`
- `resources/views/requesting/markovforecast.blade.php`
- `resources/views/approval/markovforecast.blade.php`
- `resources/views/processing/forecastingdata/fdata.blade.php`

**Verification**
```
$ node scripts/arima_forecast.js '{"series":[10,12,11,14,15]}'
{"forecast":16,"model":"ARIMA(1,1,0)"}                       # exit 0

$ node scripts/arima_forecast.js '{"series":[]}'
input.series must be a non-empty array                       # exit 1, stderr

$ node scripts/arima_forecast.js 'not json'
Unexpected token 'o', "not json" is not valid JSON           # exit 1, stderr
```

**Note**
The same three-line explanation function exists verbatim in all three views, so
this guard had to be pasted three times — see the duplication item in the review.

---

## 4. No timeout on the forecast subprocess (blocking)

**Problem**
`Process::run()` was called with no timeout. Laravel's default is 60 seconds, and
the call is synchronous — a Node process that hangs (a pathological series in the
`auto`-fitted branch, a stalled WASM load, a machine under load) holds the PHP
worker for a full minute while the user stares at a spinner. Under php-fpm with a
small worker pool, a handful of these exhausts the pool.

**Fix**
`Process::timeout(config('forecasting.timeout'))`, defaulting to 10 seconds and
overridable via `FORECAST_TIMEOUT`. A timeout throws `ProcessTimedOutException`,
which is caught and funnelled into the same "unavailable" path as any other
failure: log the cause, return `null`. Ten seconds is generous — a five-point
series returns in milliseconds — but bounded.

**Files**
- `config/forecasting.php`
- `app/Http/Controllers/ForecastingDataController.php`
- `.env.example`

---

## Status

All four blocking issues are fixed. Not yet addressed (from the review, in
suggested order):

| # | Issue | Severity |
|---|---|---|
| 5 | Gaps in the year series are silently collapsed, so differencing runs over non-adjacent periods | correctness |
| 6 | `$forecastSection1Arima` / `$numaddfacmember` are queried and aggregated but never used; the on-screen copy claims both inputs feed the model when only `num_emp_required` does | correctness / honesty |
| 7 | `arima.historicalData` is returned but referenced by no view | dead payload |
| 8 | The script accepts `steps` but the small-dataset path always forecasts one period | API consistency |
| 9 | Two parameters fitted on three points; `phi` clamp permits the non-stationary boundary | statistical |
| 10 | Forecasting logic lives in an HTTP controller; no tests anywhere | design |
| 11 | The two `markovforecast.blade.php` views differ by ~47 of ~900 lines | duplication |
| 12 | Files and routes still named "markov" after the package was removed | naming |
| 13 | `routes/api.php:41` exposes manpower data with no auth middleware (pre-existing) | security |

**Environment caveat**
`php` is not installed on this machine, so the PHP changes were not run or linted
locally — they were reviewed by inspection. `composer install` and `npm install`
have not been run either; `npm install` is required before the >= 10 data point
branch can work at all.

---

## Verification (after installing the toolchain)

`npm install`, `brew install php composer`, and `composer install` were run, so
the fixes could be exercised against the real framework rather than reviewed by
inspection. A local `.env` was created from `.env.example` with a generated app
key (gitignored; no database is configured, and none is needed — the forecast
path does not touch one).

`ForecastingDataController::arimaForecast()` invoked directly via reflection:

| case | n | result |
|---|---|---|
| empty | 0 | `null` |
| single | 1 | `7` |
| five-year (real shape) | 5 | `16` |
| flat five-year | 5 | `3` |
| twelve points | 12 | `null` — logged, see below |
| twenty-four points | 24 | `15` |

`php -l` is clean on both changed PHP files. The n=12 failure wrote exactly the
diagnostic it was supposed to:

```
[2026-08-20 19:34:36] local.WARNING: ARIMA forecast script failed.
{"exit_code":1,"error":"Series too short (12 values). Minimum length for these parameters is 20"}
```

That is fix #3 doing its job — before it, this case returned a silent `0`.

---

## New findings — the `>= 10` branch is broken (found by the above)

Installing the package made the large-dataset branch reachable for the first
time. It does not work. None of these are reachable with five academic years of
data, so they are latent rather than live, but all three are real.

### A. The threshold is 10; the library requires 20

`scripts/arima_forecast.js` routes any series of 10 or more points to the npm
package, which rejects anything shorter than 20 outright:

```
n=10 -> Series too short (10 values). Minimum length for these parameters is 20
n=15 -> Series too short (15 values). Minimum length for these parameters is 20
n=19 -> Series too short (19 values). Minimum length for these parameters is 20
n=20 -> {"forecast":14,"model":"ARIMA(auto)"}
```

Series of 10–19 points have no working path at all: too long for the hand-rolled
implementation, too short for the library.

### B. `auto: true` returns wrong forecasts

On a perfect linear ramp `10, 11, ... 33`, where the next value is unambiguously
34, auto-fitting is off by nine:

```
auto:true   -> 25, 26, 27
p1 d1 q0    -> 34, 35, 36     <- correct
p2 d1 q1    -> 34, 35, 36
p0 d1 q0    ->  0,  0,  0
```

Explicitly specifying ARIMA(1,1,0) — the same model the small-dataset path
implements by hand — gives the right answer. The package's auto search does not.

### C. The WASM build writes diagnostics to stdout

Certain series make the native solver print to **stdout**, ahead of our JSON:

```
non-stationary AR part

non-stationary AR part

non-stationary AR part
{"forecast":14,"model":"ARIMA(auto)"}
```

`verbose: false` does not suppress this — the text comes from the C library
through Emscripten, not from the JS wrapper. The controller decodes the whole of
stdout, so any such run is unparseable. Post-fix that degrades to a logged
`null`; pre-fix it would have been a silent `0`.

**Not yet fixed — awaiting a decision on whether that branch should exist.**

---

## 5. Series of 10–19 points had no working code path

**Problem** (finding A above)
The script routed `series.length >= 10` to the arima package, but the package
refuses to fit fewer than 20 observations. Anything from 10 to 19 points was too
long for the hand-rolled implementation and too short for the library, so it
failed outright.

**Fix**
Named the real limit `MIN_LIBRARY_SERIES_LENGTH = 20` and branched on that. The
constant carries a comment explaining that it is the package's constraint, not an
arbitrary tuning choice — the previous bare `10` gave no hint of where it came
from or that it was wrong.

**Files**
- `scripts/arima_forecast.js`

**Verification** — ramp `10, 11, 12, …`, so the correct answer is always the next
integer in the ramp:

```
n=5   {"forecast":15,...}   # ramp ends 14 -> 15   correct
n=15  {"forecast":25,...}   # ramp ends 24 -> 25   correct   (previously: error)
n=19  {"forecast":29,...}   # ramp ends 28 -> 29   correct   (previously: error)
n=20  {"forecast":21,...}   # ramp ends 29 -> 30   WRONG, see next fix
n=24  {"forecast":25,...}   # ramp ends 33 -> 34   WRONG, see next fix
```

---

## 6. `auto: true` produced wrong forecasts

**Problem** (finding B above)
The package's auto-fitting is unreliable. On a perfect linear ramp, where the
next value is unambiguous, it was off by nine:

```
series 10..33, correct next value is 34
auto:true   -> 25, 26, 27
p1 d1 q0    -> 34, 35, 36
p2 d1 q1    -> 34, 35, 36
p0 d1 q0    ->  0,  0,  0
```

**Fix**
Specify the order explicitly: `{ p: 1, d: 1, q: 0 }`. Beyond being correct, this
makes the script coherent — it is the same ARIMA(1,1,0) that
`arimaSmallDataset()` implements by hand, so the two paths are now one model with
two implementations, differing only because the library will not fit short
series. Previously the script silently switched *models* at the threshold, which
meant the forecast could jump for reasons that had nothing to do with the data.

The `model` field now reports `ARIMA(1,1,0) via arima` so logs still show which
implementation ran.

**Files**
- `scripts/arima_forecast.js`

**Verification** — ramp, correct answer is always the next integer, and note the
two implementations now agree across the n=19/n=20 boundary:

```
n=19  ends 28  {"forecast":29,"model":"ARIMA(1,1,0)"}
n=20  ends 29  {"forecast":30,"model":"ARIMA(1,1,0) via arima"}
n=24  ends 33  {"forecast":34,"model":"ARIMA(1,1,0) via arima"}   # was 25
n=30  ends 39  {"forecast":40,"model":"ARIMA(1,1,0) via arima"}
```

---

## 7. WASM solver diagnostics corrupted the JSON result

**Problem** (finding C above)
The arima package's WASM build prints solver diagnostics straight to **stdout**,
ahead of the result:

```
non-stationary AR part

non-stationary AR part

non-stationary AR part
{"forecast":14,"model":"ARIMA(auto)"}
```

stdout is this script's result channel, so the controller's
`json_decode($result->output(), true)` sees that whole blob and fails. Post-fix-3
that degrades to a logged `null`; before it, a silent `0`. `verbose: false` does
not help — the text comes from the C library via Emscripten, not the JS wrapper.

**Fix**
Added `withCleanStdout(fn)`, which points `process.stdout.write` at stderr for
the duration of the fit and restores it in a `finally`. The diagnostics are
genuinely useful when a forecast looks wrong, so they are redirected rather than
discarded — the controller already logs stderr on failure.

Reaching into the package's Emscripten module to pass a `print` handler would
also have worked, but that means depending on `arima/wasm/native-sync.js`
internals, which are not part of its public API.

**Files**
- `scripts/arima_forecast.js`

**Verification**
Fix #6 removed the natural trigger — the diagnostics came from the auto search,
and the explicit order does not emit them — so the guard is defensive. It was
therefore tested against a known emitter: the real package in `auto` mode, using
the shipped `withCleanStdout` extracted from the script itself rather than a
copy.

```
stdout: {"forecast":14}                  <- pure, parses as JSON
stderr: non-stationary AR part
        non-stationary AR part
        non-stationary AR part
        restored: true                   <- process.stdout.write put back
```

---

## Status after the branch fixes

Every case now returns a forecast instead of failing. Through the real
controller, via reflection:

| case | n | before | after |
|---|---|---|---|
| empty | 0 | `null` | `null` |
| single | 1 | `7` | `7` |
| five-year (real shape) | 5 | `16` | `16` |
| flat five-year | 5 | `3` | `3` |
| twelve points | 12 | `null` (too short for the library) | `23` |
| nineteen, ramp to 28 | 19 | `null` (too short for the library) | `29` |
| twenty, ramp to 29 | 20 | `21` (auto misfit) | `30` |
| twenty-four | 24 | `15` (auto misfit) | `20` |

`php -l` clean. The remaining open items are #5–#13 in the table above, of which
the correctness ones (gap-collapsing series, dead queries, and the on-screen copy
that overstates the model's inputs) are the ones worth doing next.

---

## 8. The page overstated what the model actually uses

**Problem**
The on-screen explanation claimed the forecast was built from two historical
series:

> To forecast manpower needs for the HRMDO, the ARIMA model uses the following
> historical data collected over 5 academic years:
> - "Number of Additional Faculty" as derived from the Forecasting Form.
> - "Manpower Required" as obtained from the Manpower Requisition Form.

Only the second is true. The controller fits on `num_emp_required` alone. The
block even contradicted itself four lines later, where the formula correctly read
`ARIMA Forecast = f(Historical "Manpower Required")`.

The controller carried the matching dead weight: `$forecastSection1Arima` ran a
five-year eager-loaded query and `$numaddfacmember` aggregated it, on every
request, and neither was ever read or returned. The claim and the unused query
are the same defect seen from two ends — leftovers from the Markov
implementation, which genuinely did consume both series.

A third inaccuracy sat in the same block: the model was described as "combining
three components: autoregression (AR), differencing (I), and moving average
(MA)". ARIMA(1,1,0) has `q = 0` — there is no MA component.

**Fix**
Aligned the copy with the code rather than the other way round.

- Controller: deleted the unused query and aggregation.
- Views: the input list now names one series. "Number of Additional Faculty" is
  still described, correctly, as a comparison figure charted beside the forecast
  and explicitly *not* an input.
- Views: the description now says ARIMA(1,1,0) — differencing plus a first-order
  autoregression — and states that MA is unused.
- Views: `generateChartExplanation()` presented all three numbers in one
  sentence, which read as though all three fed the model. It now separates the
  forecast from the two current-year figures shown for comparison.

Feeding "Number of Additional Faculty" in as a second input was the other way to
resolve this, but that means an exogenous regressor (ARIMAX) fitted on five
observations — indefensible at that sample size, and a modelling change rather
than a documentation fix.

**Files**
- `app/Http/Controllers/ForecastingDataController.php`
- `resources/views/requesting/markovforecast.blade.php`
- `resources/views/approval/markovforecast.blade.php`
- `resources/views/processing/forecastingdata/fdata.blade.php`

**Verification**
`php -l` clean; the forecast probe returns identical values to before, confirming
the removed query fed nothing. `$forecastSection1` (current academic year) is
untouched and still populates the "Forecasted Manpower" bar.

---

## 9. The heading named the wrong forecast period

**Problem**
The heading above the chart promised a forecast for the semester immediately
following the selected one:

```js
if (selectedSemester === "2nd Semester") {
    headingElement.textContent = "ARIMA Forecast for A.Y. (" + nextAcademicYear + ") - 1st Semester";
} else if (selectedSemester === "1st Semester") {
    headingElement.textContent = "ARIMA Forecast for A.Y. (" + selectedYear + ") - 2nd Semester";
}
```

The model forecasts something else. The controller filters the five-year history
to one semester (`->where('semester', $sem)`), so for A.Y. 2024-2025, 1st
Semester the fitted series is:

| A.Y. | Semester |
|---|---|
| 2020-2021 | 1st Sem |
| 2021-2022 | 1st Sem |
| 2022-2023 | 1st Sem |
| 2023-2024 | 1st Sem |
| 2024-2025 | 1st Sem |

One step beyond a list of 1st Semesters is **1st Semester 2025-2026**. The
heading called that number "A.Y. 2024-2025 - 2nd Semester" — wrong by one
semester and one academic year. Anyone planning from that page would budget for
the wrong term.

**Fix**
Corrected the heading, not the model. Filtering to a single semester is
deliberate and sound: 1st and 2nd semester have systematically different staffing
needs, so a 1st Semester figure belongs in a series of 1st Semester figures.

The page also already covers both semesters — selecting 2nd Semester forecasts
2nd Semester of the next academic year. Only the wording was wrong.

Reshaping the series to forecast the immediately-following semester would mean
interleaving both semesters into one series: ten alternating points over five
years, where the 1st-vs-2nd-semester swing would dominate the trend and would
need seasonal handling to avoid producing nonsense. That is real statistical risk
to reach a number already available from the semester dropdown.

The branch disappeared with the fix — both semesters now take the same path, so
the heading is one line built from the selected semester.

**Files**
- `resources/views/requesting/markovforecast.blade.php`
- `resources/views/approval/markovforecast.blade.php`

(`fdata.blade.php` has no such heading and is unaffected.)

**Verification**
```
selected: 2024-2025 1st Semester  ->  ARIMA Forecast for A.Y. (2025-2026) - 1st Semester
selected: 2024-2025 2nd Semester  ->  ARIMA Forecast for A.Y. (2025-2026) - 2nd Semester
selected: 2019-2020 1st Semester  ->  ARIMA Forecast for A.Y. (2020-2021) - 1st Semester
```

Each now names the period the fitted series actually continues.

---

## 10. Gaps in the year series were silently closed up

**Problem**
The series was built by aggregating into a map keyed by academic year and then
flattening it:

```php
ksort($numemprequired);
$series = array_values($numemprequired);
```

A year in which a department filed no requisition is simply **absent** from that
map — not present as zero. `array_values()` then closes the hole, and the model
reads consecutive list entries as consecutive periods. So a department with data
for 2020-21, 2021-22, 2023-24 and 2024-25 produced the series `[4, 5, 7, 8]`, in
which 2021-22 and 2023-24 are differenced as though they were adjacent years. The
jump across the missing year is counted as one year's growth, inflating the
trend:

```
collapsed [4,5,7,8] -> forecast 10
```

**Fix**
Two small private methods, each with one job:

- `academicYearWindow($ay, $count)` builds the five-year window explicitly,
  oldest first. It replaces an inline decrementing loop, and gives the series
  code a definitive list of which years *should* be present — you cannot detect a
  missing year without knowing which years to expect.
- `contiguousSeries($totals, $window)` walks back from the most recent year and
  stops at the first gap.

The three ways to handle a hole are to close it, to fill it, or to stop at it.
Closing it is what the bug did. Filling it with zero invents a requisition for
nil that nobody submitted, which drags the forecast down and is a worse lie than
the gap. Stopping at it uses only genuinely adjacent observations.

Anchoring the run to the selected academic year matters for a second reason: a
one-step-ahead forecast only lands on the year the heading names if the series
actually ends at the selected year. A run ending earlier would predict a year
already in the past while the page labelled it as next year's — reintroducing fix
#9 by a different route.

**Behaviour change worth knowing:** where history is patchy the forecast is now
based on fewer points, and if the *selected* year has no requisition at all the
forecast is unavailable rather than wrong. The views already render that state
properly (fix #3).

**Files**
- `app/Http/Controllers/ForecastingDataController.php`

**Verification** — window `2020-2021 … 2024-2025`, via the real methods:

| case | series before | series now | forecast |
|---|---|---|---|
| all five present | `[4,5,6,7,8]` | `[4,5,6,7,8]` | `9` |
| hole in the middle | `[4,5,7,8]` → `10` | `[7,8]` | `8` |
| oldest two missing | `[6,7,8]` | `[6,7,8]` | `9` |
| selected year missing | `[4,5,6,7]` → wrong period | `[]` | `null` |
| only the selected year | `[8]` | `[8]` | `8` |
| nothing at all | `[]` | `[]` | `null` |

The middle row is the bug: a series spanning a missing year forecast 10, where
the two genuinely adjacent observations give 8.

**Still open**
`steps` is fixed at 1, so there is no way to forecast further ahead than the next
academic year. If HRMDO ever needs a forecast for a year whose predecessor has no
data, that is the feature to build — multi-step forecasting from the last
complete run — rather than relaxing the contiguity rule.

---

## 11. Forecasting logic extracted from the controller, and tested

**Problem**
Every fix in this session was verified by invoking private controller methods
through `ReflectionMethod` from throwaway scripts. That worked, but the fact it
was *necessary* is the smell: `arimaForecast()`, `academicYearWindow()` and
`contiguousSeries()` are pure logic with no HTTP concerns, reachable only through
a route. Nothing in the repository protected any of the ten fixes from
regression, and the probe scripts are gone.

**Fix — extraction**
Split by responsibility rather than moving the block wholesale:

- `App\Services\AcademicYearSeries` — pure functions over academic year strings:
  `window()` and `contiguous()`. No knowledge of ARIMA, subprocesses or config,
  so the gap-handling rules can be tested without any of that.
- `App\Services\ArimaForecaster` — owns the subprocess, the timeout, the config
  lookups and the logging. One public method, `forecast(array $series): ?int`.

The controller takes `ArimaForecaster` by constructor injection and drops from
265 to 173 lines. Behaviour is unchanged, confirmed by re-running the same probes
against the extracted services before committing.

**Fix — tests**
28 tests, 47 assertions, all green.

`tests/Unit/AcademicYearSeriesTest.php` (9 tests) — window construction
including the both-halves decrement, and every gap case: no gaps, a hole in the
middle, the selected year missing, only the selected year, nothing at all, and
years outside the window. The hole-in-the-middle test names the bug it guards.

`tests/Unit/ArimaForecasterTest.php` (10 tests) — uses `Process::fake()`, so the
failure paths are testable without Node. Covers the arguments handed to the
script, and separately that a failed run, unparseable output, missing `forecast`
key, and a non-numeric forecast each yield `null` rather than a number. One test
asserts the *reason* reaches the log, since silent failure was the original bug.

`tests/Feature/ArimaForecastScriptTest.php` (8 tests) — runs the real script, so
the model and the PHP/Node contract are covered too: known forecasts either side
of the 20-point threshold, stdout parsing as JSON with nothing mixed in, and
invalid input failing loudly with an empty stdout and a populated stderr. It
skips cleanly when Node or `node_modules` is absent.

The test that matters most: a steep decline forecasts `0` as an integer, proving
a genuine zero is still distinguishable from the `null` that means "unavailable".

**Also fixed**
Laravel's stock `tests/Feature/ExampleTest.php` asserted that `/` returns 200. It
returns 302 — `routes/web.php:36` redirects guests to the login screen — so the
suite failed out of the box, which trains people to ignore red. It now asserts
the redirect.

**Files**
- `app/Services/AcademicYearSeries.php` (new)
- `app/Services/ArimaForecaster.php` (new)
- `app/Http/Controllers/ForecastingDataController.php`
- `tests/Unit/AcademicYearSeriesTest.php` (new)
- `tests/Unit/ArimaForecasterTest.php` (new)
- `tests/Feature/ArimaForecastScriptTest.php` (new)
- `tests/Feature/ExampleTest.php`

**Verification**
```
$ ./vendor/bin/phpunit
............................                                      28 / 28 (100%)
OK (28 tests, 47 assertions)
```

---

## 12. The five-year history is now plotted

**Problem**
`arima.historicalData` had been returned by the controller since the original
integration and read by no view (open item #7). The page showed the forecast as a
single bar next to two current-year figures, with no sight of the trend it came
from — a reader had no way to judge whether the number was plausible.

The second chart was a **pie** of those same three values: "Forecasted Manpower",
"Requested Manpower" and the ARIMA forecast. A pie states that its slices are
parts of one whole. These are three independent estimates *of the same quantity*,
so the shape asserted a relationship that does not exist, and the slice sizes
meant nothing.

**Fix**
Replaced the pie with a line chart of the five academic years the model was
fitted on, followed by the forecast year:

- **Manpower Required (recorded)** — the actual figures, solid.
- **ARIMA Forecast** — dashed, starting at the last recorded year so the
  projected segment joins the history rather than floating unattached.

`spanGaps: false` means an academic year with no requisition **breaks the line**
rather than being drawn through. This is the useful part: the contiguity rule
from fix #10 is now visible. A department missing 2022-2023 shows a broken line,
and it is obvious at a glance why the forecast used only the two years after the
break.

The bar chart is untouched — it still answers "how do this year's three figures
compare", which is a different question from "where is this heading".

`nextAcademicYear()` was extracted while adding the forecast year label, and
`updateHeading()` now uses it instead of repeating the same arithmetic inline.

**Files**
- `resources/views/requesting/markovforecast.blade.php`
- `resources/views/approval/markovforecast.blade.php`
- `resources/views/processing/forecastingdata/fdata.blade.php`

**Verification**
Every inline `<script>` in all three views parses (`node --check`), all three
templates compile through Blade, and the suite is still green at 28 tests. The
data preparation was run against four histories:

| history | line drawn | forecast segment |
|---|---|---|
| all five years | `[4,5,6,7,8]` | `8 → 9` |
| gap at 2022-2023 | `[4,5,null,7,8]` — line breaks | `8 → 8` |
| selected year missing | `[4,5,6,7,null]` | nothing drawn |
| no history at all | nothing drawn | nothing drawn |

The last two draw no forecast at all, matching the "forecast unavailable" caption
from fix #3 rather than contradicting it.

**Note**
If the pie chart was a requirement, it can come back in a third canvas — but the
data would still not be parts of a whole.

---

## 13. The /api endpoints were reachable without logging in

**Problem**
Every route in `routes/api.php` sat in a `['cors']`-only group:

```php
Route::middleware(['cors'])->group(function () {
    Route::get('/processing/forecastingdata/{college}/{department}/{ay}/{semester}', ...);
    Route::get('/evaluation/datareport/{employeeId}/{ayFrom}/{ayTo}', ...);
    ...
```

No session, no authentication. Anyone who knew a URL could read any college's
manpower requisitions, any department's evaluation reports, and any professor's
record — no login, no cookie, a plain `curl` was enough. The `cors` middleware
additionally returned `Access-Control-Allow-Origin: *` on every response.

The cause is structural rather than an oversight in one line. These are the web
application's **own AJAX endpoints** — all 27 call sites are Blade pages behind
`auth` — but they live in `routes/api.php` purely for the `/api` URL prefix, and
that file is bound to the `api` middleware group, which contains only throttling
and route-model binding. Being in the "API" file quietly opted them out of the
session and authentication every calling page already had.

Pre-existing; not introduced by the ARIMA work.

**Fix**
Put the group behind the session and the auth guard:

```php
Route::middleware(['web', 'auth', 'cors'])->group(function () {
```

`web` supplies the session cookie the browser is already sending, so `auth` can
see the logged-in user. Order matters — the session has to start before the guard
looks for a user.

**The one thing that could have broken.** `web` also brings CSRF verification.
Seven of the eight routes are GETs, which CSRF ignores, but `/api/evaluation/post`
is a POST and was sending no token — there is no `csrf-token` meta tag and no
global `$.ajaxSetup` anywhere in the project, and `VerifyCsrfToken::$except` is
empty. Left alone it would have started failing with a 419 and broken evaluation
saving. Its payload now includes `_token`.

The `Access-Control-Allow-Origin: *` header is left as it is. Once credentials
are required it stops being exploitable — browsers refuse to send cookies to a
wildcard origin — so it is untidy rather than dangerous, and removing it belongs
to a separate change.

**Files**
- `routes/api.php`
- `resources/views/requesting/evalpages/inputevalpage.blade.php`
- `tests/Feature/ApiRoutesRequireAuthenticationTest.php` (new)

**Verification**
```
✔ Every api route is behind authentication
✔ Api routes start a session so auth can see the logged in user
✔ A guest cannot read forecasting data
✔ A guest cannot read department or professor data
✔ A guest cannot post an evaluation
✔ A logged in user is let through
```

The first test walks the live route table rather than a fixed list, so a new
`/api` route added without authentication fails it. The last is the other half of
the guarantee — locking guests out must not lock users out. It asserts "not
rejected" rather than "200" so it holds with or without a database: with MySQL
down the request still reaches the controller and fails there, which is itself
proof it passed the auth middleware.

Suite: 34 tests, 56 assertions, green.

**Not verified**
The authenticated POST to `/api/evaluation/post` was not exercised end to end —
that needs a running database and a logged-in browser session. The `_token`
addition is the standard Laravel form-field approach and `VerifyCsrfToken` reads
`_token` from the request body before falling back to headers, but saving an
evaluation is worth clicking through once on a machine with the database up.
