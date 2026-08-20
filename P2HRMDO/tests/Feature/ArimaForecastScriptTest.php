<?php

namespace Tests\Feature;

use App\Services\ArimaForecaster;
use Illuminate\Support\Facades\Process;
use Tests\TestCase;

/**
 * Exercises the real forecast script. The unit tests fake the subprocess, so
 * this is what covers the model itself and the contract between PHP and Node:
 * exit codes, and JSON on stdout with nothing else mixed in.
 */
class ArimaForecastScriptTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Process::run([config('forecasting.node_binary'), '--version'])->successful()) {
            $this->markTestSkipped('Node.js is not available on this machine.');
        }
    }

    private function runScript(string $input)
    {
        return Process::run([
            config('forecasting.node_binary'),
            base_path('scripts/arima_forecast.js'),
            $input,
        ]);
    }

    public function test_it_forecasts_a_rising_five_year_history(): void
    {
        $this->assertSame(16, (new ArimaForecaster())->forecast([10, 12, 11, 14, 15]));
    }

    public function test_a_flat_history_forecasts_the_same_figure(): void
    {
        $this->assertSame(3, (new ArimaForecaster())->forecast([3, 3, 3, 3, 3]));
    }

    public function test_two_observations_are_enough_to_forecast(): void
    {
        $this->assertSame(9, (new ArimaForecaster())->forecast([7, 9]));
    }

    /**
     * A department can genuinely need nobody. That 0 must arrive as an integer,
     * not as the null the service uses for "no forecast available".
     */
    public function test_a_steep_decline_forecasts_zero_rather_than_a_negative_headcount(): void
    {
        $forecast = (new ArimaForecaster())->forecast([10, 8, 6, 4, 1]);

        $this->assertSame(0, $forecast);
        $this->assertNotNull($forecast);
    }

    public function test_stdout_carries_json_and_nothing_else(): void
    {
        $result = $this->runScript('{"series":[10,12,11,14,15],"steps":1}');

        $this->assertTrue($result->successful());
        $this->assertIsArray(json_decode($result->output(), true));
    }

    public function test_invalid_input_fails_loudly_instead_of_forecasting_zero(): void
    {
        foreach (['{"series":[]}', 'not json', '{}'] as $input) {
            $result = $this->runScript($input);

            $this->assertFalse($result->successful(), "expected failure for: {$input}");
            $this->assertNotEmpty($result->errorOutput(), "expected a reason for: {$input}");
            $this->assertEmpty($result->output(), "expected no result for: {$input}");
        }
    }

    /**
     * Series of at least 20 points are fitted by the arima package rather than
     * the hand-rolled implementation. Both model ARIMA(1,1,0), so a ramp must
     * come out the same either side of the threshold.
     */
    public function test_long_series_are_fitted_by_the_library(): void
    {
        if (! is_dir(base_path('node_modules/arima'))) {
            $this->markTestSkipped('The arima package is not installed; run npm install.');
        }

        $ramp = range(10, 29);
        $result = $this->runScript(json_encode(['series' => $ramp, 'steps' => 1]));
        $output = json_decode($result->output(), true);

        $this->assertSame(30, $output['forecast']);
        $this->assertStringContainsString('via arima', $output['model']);

        $shortRamp = range(10, 28);
        $shortOutput = json_decode($this->runScript(json_encode(['series' => $shortRamp, 'steps' => 1]))->output(), true);

        $this->assertSame(29, $shortOutput['forecast']);
        $this->assertSame('ARIMA(1,1,0)', $shortOutput['model']);
    }
}
