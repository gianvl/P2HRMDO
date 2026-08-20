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
