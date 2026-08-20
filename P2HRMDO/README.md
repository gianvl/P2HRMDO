# P2HRMDO

A Laravel application for the HRMDO (Human Resource Management and Development
Office): faculty evaluation, manpower requisition and approval, and manpower
forecasting.

The forecasting page projects next year's manpower requirement for a college and
department from its own history, using an ARIMA model. That subsystem is
documented in detail below, because it is the part with a moving piece outside
PHP — it runs a Node.js script on every request.

## Requirements

| | |
|---|---|
| PHP | 8.1 or newer |
| Composer | 2.x |
| MySQL | any version Laravel 10 supports |
| **Node.js** | **16 or newer (Vite's floor) — required at runtime, not just for the build** |

Node is not optional and is not only a build-time tool. Every forecast shells out
to `scripts/arima_forecast.js`, so the **web server's** PHP process must be able
to run `node`. See [Configuration](#configuration) if it cannot.

## Setup

```bash
composer install
npm install                 # required: the forecast script depends on this

cp .env.example .env
php artisan key:generate

# point .env at your database, then:
php artisan migrate
php artisan db:seed         # roles, users, employees and sample forecast data
php artisan storage:link    # so uploaded images resolve
```

`db:seed` is destructive: 15 of the 19 seeders `truncate()` the tables they fill.
It is meant for a fresh database. See [Deployment](#deployment) before running it
anywhere that holds real records.

Run it:

```bash
php artisan serve           # http://127.0.0.1:8000
npm run dev                 # asset watcher, in a second terminal
```

## Deployment

`.env` is not in the repository, so **nothing below is inherited from a
developer machine** — each item has to be done on the server itself. The two
that are most often missed are `NODE_BINARY` and `storage:link`; both fail
quietly rather than loudly.

### 1. Code and dependencies

```bash
composer install --no-dev --optimize-autoloader
npm install          # required: the forecast script needs node_modules
npm run build        # compiles assets into public/build
```

### 2. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Then edit `.env`:

```ini
APP_ENV=production
APP_DEBUG=false          # leaving this true exposes stack traces publicly
APP_URL=https://your-host

DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

# The web server's PHP must be able to execute this. See below.
NODE_BINARY=/usr/local/bin/node
FORECAST_TIMEOUT=10
```

### 3. `NODE_BINARY` — read this one

Every forecast runs `scripts/arima_forecast.js` as a subprocess, so **Node is a
runtime dependency of the web server, not just a build tool**. The PHP process
serving requests must be able to execute it.

It usually cannot. Node installed through a version manager (fnm, nvm, asdf) is
placed on the `PATH` of an *interactive shell* only, and Apache, php-fpm and
XAMPP do not get that `PATH`. The failure looks like this in the log:

```
local.WARNING: ARIMA forecast script failed.
{"exit_code":127,"error":"sh: line 0: exec: node: not found"}
```

Find the real path and put it in `.env`:

```bash
which node          # Linux / macOS  -> /usr/local/bin/node
where node          # Windows        -> C:\Program Files\nodejs\node.exe
```

Do not use a version manager's shim path. `fnm` reports something like
`~/.local/state/fnm_multishells/17280_1699.../bin/node`, which is created per
shell session and disappears. Use the real installation path — for fnm that is
`~/.local/share/fnm/node-versions/vNN/installation/bin/node`.

### 4. Database

```bash
php artisan migrate --force
```

> **Do not run `php artisan db:seed` on a database that holds real records.**
> 15 of the 19 seeders call `truncate()` on the tables they populate, so seeding
> destroys existing data. Seed only when first setting up an empty database.

### 5. Storage

```bash
php artisan storage:link
```

Profile photographs are read from `storage/app/public/images/`, and the `users`
table stores filenames like `profile.man2.png`. Without the symlink — or without
the files — every avatar falls back to the default `images/profilepic.png`,
which is a graceful failure but still a missing photograph.

### 6. Permissions

```bash
chmod -R ug+rwx storage bootstrap/cache
```

### 7. Cache for production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Re-run all three after any change to `.env`, routes or views — cached config
ignores later `.env` edits, which is a common source of "I changed it and
nothing happened". `php artisan optimize:clear` undoes all of it.

### 8. Web server

Point the document root at **`public/`**, never at the project root. Anything
else exposes `.env`, `storage/` and the whole source tree over HTTP.

Serve over HTTPS. The application previously loaded a script over plain `http://`
which browsers block on an HTTPS page; that is fixed, and a test now enforces it
(`tests/Feature/ViewScriptTagsTest.php`).

### After deploying: a five-minute check

1. **Log in.** Confirm you reach the dashboard for your role.
2. **Run a forecast** with a college and department that has five academic years
   of requisitions. A number should appear, not "unavailable".
3. If it says unavailable, check the log before anything else:
   ```bash
   tail -f storage/logs/laravel.log | grep ARIMA
   ```
   A line means the plumbing — almost always `NODE_BINARY`. Silence means the
   data genuinely does not support a forecast, which is a correct answer.
4. **Save an evaluation.** A `419` in the browser's network tab means the CSRF
   token is not reaching `/api/evaluation/post`.
5. **Open a manpower requisition form** and confirm a modal opens — that
   exercises jQuery and Bootstrap being loaded exactly once.

## Roles

Routes are grouped by role behind the `auth` middleware (`routes/web.php:194`):

- **AdminProcessing** — HRMDO staff: processing, faculty lists, forecasting data.
- **UserRequesting** — departments raising manpower requisitions and forecast forms.
- **UserApproval** — chairpersons, deans, VPA and the HRMDO Director.

The `/api/*` routes are the application's own AJAX endpoints, not a public API.
They require an authenticated session like every other route.

## The manpower forecast

### What it predicts

For a chosen college, department, academic year and semester, the model forecasts
**the manpower required for that same semester in the next academic year**.

This is worth being precise about. Selecting *1st Semester 2024-2025* produces a
forecast for *1st Semester 2025-2026* — not for 2nd Semester 2024-2025. The model
is fitted on one semester's figures across consecutive years, so the step it takes
is one year, not one semester. To forecast the other semester, select it: the same
model runs on that semester's history.

### The series it is fitted on

A single series: **"Manpower Required"**, totalled per academic year from the
Manpower Requisition forms, over a five-year window ending at the selected year.

"Number of Additional Faculty" from the Forecasting form is charted beside the
forecast for comparison. It is **not** an input to the model.

**Missing years break the series rather than being closed up.** A department that
filed no requisition in 2022-2023 has no entry for that year, and the model only
uses the unbroken run leading up to the selected year:

```
2020-21  2021-22  2022-23  2023-24  2024-25        fitted on
   4        5        —        7        8     ->    [7, 8]
```

Closing the gap would difference 2021-22 against 2023-24 as if they were adjacent
years, counting a two-year jump as one year's growth. Filling it with a zero would
invent a requisition for nobody that was never filed. Neither is honest, so the
series stops at the gap. The chart draws the break, so this is visible on the page
rather than hidden in the controller.

### The model

**ARIMA(1,1,0)** — one order of differencing, then a first-order autoregression.
There is no moving-average term. Two implementations, chosen by series length:

| Series length | Implementation |
|---|---|
| 2 – 19 points | Hand-rolled in `scripts/arima_forecast.js`: first difference, then AR(1) by least squares |
| 20+ points | The [`arima`](https://www.npmjs.com/package/arima) npm package, with the order given explicitly |

The threshold is the package's own limit — it refuses to fit fewer than 20
observations. With five academic years of data, real usage always takes the first
path; the second exists for completeness.

The order is passed explicitly rather than using the package's `auto` mode, which
mispredicts badly: on a ramp of `10 … 33`, where the next value is plainly 34,
`auto` forecasts 25 while an explicit `(1,1,0)` gives 34.

**A caveat worth stating plainly.** Five academic years yields four differences and
three usable regression pairs, so the AR coefficient is estimated from very little
data. Treat the output as a trend-informed projection, not a precise prediction.
The arithmetic is exact; the sample size is what it is.

### When there is no forecast

The page shows **"ARIMA forecast is unavailable"** whenever a number cannot be
produced honestly — rather than showing `0`, which is a legitimate forecast meaning
"this department needs nobody". The two are deliberately distinct: the API returns
`null` for unavailable and an integer for a real forecast.

Causes, in likelihood order:

1. **Fewer than two usable years** — no requisitions for the selected year, or a
   gap immediately before it.
2. **Node cannot be run by the web server** — the most common deployment problem.
   See [Configuration](#configuration).
3. **`npm install` was never run** — only affects series of 20+ points.

Every failure is logged with its cause:

```bash
tail -f storage/logs/laravel.log | grep ARIMA
# [.. ] local.WARNING: ARIMA forecast script failed. {"exit_code":1,"error":"..."}
```

If the page says unavailable and the log says nothing, the cause is (1) — the data,
not the plumbing.

### Configuration

`config/forecasting.php`, both overridable in `.env`:

| Variable | Default | Purpose |
|---|---|---|
| `NODE_BINARY` | `node` | Path to Node. Set an absolute path (`/usr/local/bin/node`, `C:\Program Files\nodejs\node.exe`) when the web server's `PATH` does not include it — common under XAMPP, php-fpm and shared hosting. |
| `FORECAST_TIMEOUT` | `10` | Seconds to wait for the script. It runs while a user waits, so this is deliberately below Laravel's 60-second default. |

Run `php artisan config:clear` after changing either if config is cached.

### Calling it directly

```bash
node scripts/arima_forecast.js '{"series":[10,12,11,14,15],"steps":1}'
# {"forecast":16,"model":"ARIMA(1,1,0)"}
```

The contract: **stdout is JSON and nothing else**, exit code 0. Any failure exits
non-zero with the reason on stderr and nothing on stdout — a forecast of `0` on
stdout always means a real forecast of zero.

## Tests

```bash
./vendor/bin/phpunit                       # everything
./vendor/bin/phpunit --testdox             # readable list
./vendor/bin/phpunit --testsuite Unit      # no Node, no database
```

Unit tests fake the subprocess, so every failure path runs without Node. Feature
tests exercise the real script and skip themselves cleanly if Node or
`node_modules` is missing.

## Key files

```
app/Services/ArimaForecaster.php        runs the model; null on any failure
app/Services/AcademicYearSeries.php     builds the year window and the unbroken run
app/Http/Controllers/
    ForecastingDataController.php       gathers the data, returns the JSON payload
scripts/arima_forecast.js               the model itself
config/forecasting.php                  node binary and timeout
routes/api.php                          the AJAX endpoints, behind web + auth
```

The forecast reaches the page through
`GET /api/processing/forecastingdata/{college}/{department}/{ay}/{semester}`,
whose `arima` key carries `forecast` (integer or `null`) and `historicalData`.

## Change log

`changes.md` records the fixes made to the ARIMA integration — the problem, the
cause, the fix and the verification for each. Worth reading before changing the
forecasting code, since several of the fixes are non-obvious and easy to undo by
accident.
