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
