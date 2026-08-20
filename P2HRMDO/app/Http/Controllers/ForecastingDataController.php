<?php

namespace App\Http\Controllers;

use App\Models\{
    Employee,
    EvalPage,
    ForecastSection1,
    Manpower
};
use Illuminate\Http\Request;
use Illuminate\Process\Exceptions\ProcessTimedOutException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class ForecastingDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();
        $collegeList = DB::table('employees')
            ->select(DB::raw('DISTINCT(`college`)'))
            ->get();

        return view('processing.forecastingdata.fdata', compact('loggedInUser', 'collegeList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function viewArimaRequesting()
    {
        $loggedInUser = Auth::user();

        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();
        return view('requesting.markovforecast', compact('loggedInUser', 'collegeList'));
    }

    public function viewArimaApproval()
    {
        $loggedInUser = Auth::user();

        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();
        return view('approval.markovforecast', compact('loggedInUser', 'collegeList'));
    }

    public function forecastingData(string $college, string $department, string $ay, string $sem)
    {
        // Current AY data
        $ayList = [$ay];
        $manpower = Manpower::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayList)
            ->where('semester', $sem)
            ->get();

        $employeeIds = Employee::where('college', $college)
            ->where('department', $department)
            ->get()
            ->pluck("id");

        $evalpage = EvalPage::whereIn('employee_id', $employeeIds)
            ->whereIn('ay', $ayList)
            ->where('semester', $sem)
            ->whereNotIn('overallstatus', ["Subject for deliberation"])
            ->get();

        $forecastSection1 = ForecastSection1::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayList)
            ->where('semester', $sem)
            ->with('forecastSection2s')
            ->with('forecastSection3s')
            ->with('forecastSection4s')
            ->with('forecastSection5s')
            ->with('forecastSection6s')
            ->with('forecastSection7s')
            ->with('forecastSection8s')
            ->get();

        // 5-year historical window for ARIMA, oldest academic year first.
        $ayListArima = $this->academicYearWindow($ay, 5);

        $manpowerArima = Manpower::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayListArima)
            ->where('semester', $sem)
            ->get();

        // Aggregate manpower required per academic year. This is the only
        // series the model is fitted on.
        $numemprequired = [];

        foreach ($manpowerArima as $m) {
            $numemprequired[$m->ay] = ($numemprequired[$m->ay] ?? 0) + $m->num_emp_required;
        }

        ksort($numemprequired);

        $series = $this->contiguousSeries($numemprequired, $ayListArima);

        $arimaForecast = $this->arimaForecast($series);

        return [
            "manpower" => $manpower,
            "evalpage" => $evalpage,
            "forecastSection1" => $forecastSection1,
            "ayList" => $ayList,
            "ayListArima" => $ayListArima,
            "arima" => [
                "forecast" => $arimaForecast,
                "historicalData" => $numemprequired,
            ],
        ];
    }

    /**
     * The $count academic years ending at $ay, oldest first.
     *
     * "2024-2025" with a count of 3 gives
     * ["2022-2023", "2023-2024", "2024-2025"].
     */
    private function academicYearWindow(string $ay, int $count): array
    {
        [$startYr, $endYr] = array_map('intval', explode('-', $ay));

        $years = [];
        for ($offset = $count - 1; $offset >= 0; $offset--) {
            $years[] = ($startYr - $offset) . '-' . ($endYr - $offset);
        }

        return $years;
    }

    /**
     * The unbroken run of academic years ending at the most recent year of
     * $window, as a plain list of totals.
     *
     * An academic year with no requisition is absent from $totals rather than
     * present as zero, and the model reads consecutive list entries as
     * consecutive periods. Closing a gap up would difference across the missing
     * years as though they were adjacent, and filling it with zero would invent
     * a requisition for nil that nobody submitted -- both distort the trend.
     * Using only the run leading up to the selected year avoids both, and keeps
     * the one-step forecast landing on the academic year the page names.
     */
    private function contiguousSeries(array $totals, array $window): array
    {
        $series = [];

        foreach (array_reverse($window) as $ay) {
            if (! array_key_exists($ay, $totals)) {
                break;
            }

            array_unshift($series, $totals[$ay]);
        }

        return $series;
    }

    /**
     * Forecast the next period's manpower requirement from a historical series.
     *
     * Returns null when no forecast can be produced, so that an unavailable
     * forecast is never mistaken for a genuine forecast of zero.
     */
    private function arimaForecast(array $series): ?int
    {
        if (count($series) < 2) {
            return isset($series[0]) ? (int) $series[0] : null;
        }

        try {
            $result = Process::timeout(config('forecasting.timeout'))->run([
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
}
