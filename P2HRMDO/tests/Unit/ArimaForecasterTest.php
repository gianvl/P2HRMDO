<?php

namespace Tests\Unit;

use App\Services\ArimaForecaster;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Tests\TestCase;

class ArimaForecasterTest extends TestCase
{
    private ArimaForecaster $forecaster;

    protected function setUp(): void
    {
        parent::setUp();

        $this->forecaster = new ArimaForecaster();
    }

    private function fakeScript(string $output = '', int $exitCode = 0, string $errorOutput = ''): void
    {
        Process::fake([
            '*' => Process::result(output: $output, errorOutput: $errorOutput, exitCode: $exitCode),
        ]);
    }

    public function test_it_returns_the_forecast_from_the_script(): void
    {
        $this->fakeScript('{"forecast":16,"model":"ARIMA(1,1,0)"}');

        $this->assertSame(16, $this->forecaster->forecast([10, 12, 11, 14, 15]));
    }

    public function test_it_passes_the_series_to_the_script(): void
    {
        $this->fakeScript('{"forecast":9}');

        $this->forecaster->forecast([4, 5, 6]);

        Process::assertRan(function ($process) {
            $command = $process->command;

            return str_contains($command[1], 'scripts/arima_forecast.js')
                && json_decode($command[2], true)['series'] === [4, 5, 6];
        });
    }

    public function test_a_single_observation_is_returned_without_running_the_script(): void
    {
        Process::fake();

        $this->assertSame(7, $this->forecaster->forecast([7]));

        Process::assertNothingRan();
    }

    public function test_an_empty_series_yields_no_forecast(): void
    {
        Process::fake();

        $this->assertNull($this->forecaster->forecast([]));

        Process::assertNothingRan();
    }

    /**
     * The defect this guards: 0 is a legitimate forecast, so a failed run must
     * never be reported as one.
     */
    public function test_a_failed_script_yields_null_rather_than_zero(): void
    {
        $this->fakeScript(exitCode: 1, errorOutput: 'Series too short');

        $this->assertNull($this->forecaster->forecast([1, 2, 3]));
    }

    public function test_it_logs_why_a_failed_script_produced_no_forecast(): void
    {
        Log::spy();
        $this->fakeScript(exitCode: 1, errorOutput: 'Cannot find module');

        $this->forecaster->forecast([1, 2, 3]);

        Log::shouldHaveReceived('warning')
            ->withArgs(fn ($message, $context) => trim($context['error']) === 'Cannot find module'
                && $context['exit_code'] === 1)
            ->once();
    }

    /**
     * Output polluted by the WASM solver's diagnostics is unparseable, and must
     * not be mistaken for a result.
     */
    public function test_unparseable_output_yields_null(): void
    {
        $this->fakeScript("non-stationary AR part\n{\"forecast\":14}");

        $this->assertNull($this->forecaster->forecast([1, 2, 3]));
    }

    public function test_output_without_a_forecast_yields_null(): void
    {
        $this->fakeScript('{"model":"ARIMA(1,1,0)"}');

        $this->assertNull($this->forecaster->forecast([1, 2, 3]));
    }

    public function test_a_non_numeric_forecast_yields_null(): void
    {
        $this->fakeScript('{"forecast":null}');

        $this->assertNull($this->forecaster->forecast([1, 2, 3]));
    }

    public function test_a_fractional_forecast_is_cast_to_a_whole_number_of_staff(): void
    {
        $this->fakeScript('{"forecast":8.7}');

        $this->assertSame(8, $this->forecaster->forecast([1, 2, 3]));
    }
}
