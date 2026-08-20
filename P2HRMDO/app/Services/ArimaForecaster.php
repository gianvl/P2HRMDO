<?php

namespace App\Services;

use Illuminate\Process\Exceptions\ProcessTimedOutException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

/**
 * Fits an ARIMA(1,1,0) model to a historical series and forecasts one period
 * ahead, by way of scripts/arima_forecast.js.
 *
 * Every failure returns null rather than a number, so that an unavailable
 * forecast is never mistaken for a genuine forecast of zero.
 */
class ArimaForecaster
{
    /**
     * Forecast the next period from $series, or null if no forecast can be
     * produced.
     */
    public function forecast(array $series): ?int
    {
        if (count($series) < 2) {
            return isset($series[0]) ? (int) $series[0] : null;
        }

        $result = $this->run($series);

        if ($result === null) {
            return null;
        }

        if (! $result->successful()) {
            Log::warning('ARIMA forecast script failed.', [
                'exit_code' => $result->exitCode(),
                'error' => $result->errorOutput(),
            ]);

            return null;
        }

        $forecast = json_decode($result->output(), true)['forecast'] ?? null;

        if (! is_numeric($forecast)) {
            Log::warning('ARIMA forecast script returned unusable output.', [
                'output' => $result->output(),
            ]);

            return null;
        }

        return (int) $forecast;
    }

    /**
     * Run the forecast script, or null if it did not finish in time.
     */
    private function run(array $series)
    {
        try {
            return Process::timeout(config('forecasting.timeout'))->run([
                config('forecasting.node_binary'),
                base_path('scripts/arima_forecast.js'),
                json_encode(['series' => $series, 'steps' => 1]),
            ]);
        } catch (ProcessTimedOutException $e) {
            Log::warning('ARIMA forecast script timed out.', [
                'timeout' => config('forecasting.timeout'),
            ]);

            return null;
        }
    }
}
