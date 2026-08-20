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
