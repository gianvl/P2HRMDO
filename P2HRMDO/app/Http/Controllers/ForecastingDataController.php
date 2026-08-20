<?php

namespace App\Http\Controllers;

use App\Models\{
    Employee,
    EvalPage,
    ForecastSection1,
    Manpower
};
use Illuminate\Http\Request;
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

        // 5-year historical data for ARIMA
        $ayListArima = [$ay];
        $ayArr = explode("-", $ay);
        $startYr = intval($ayArr[0]);
        $endYr = intval($ayArr[1]);
        for ($yrCtr = 0; $yrCtr < 4; $yrCtr++) {
            $startYr--;
            $endYr--;
            $ayListArima[] = "{$startYr}-{$endYr}";
        }

        $manpowerArima = Manpower::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayListArima)
            ->where('semester', $sem)
            ->get();

        $forecastSection1Arima = ForecastSection1::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayListArima)
            ->where('semester', $sem)
            ->with('forecastSection4s')
            ->get();

        // Aggregate manpower required per academic year
        $numemprequired = [];
        $numaddfacmember = [];

        foreach ($manpowerArima as $m) {
            $numemprequired[$m->ay] = ($numemprequired[$m->ay] ?? 0) + $m->num_emp_required;
        }

        foreach ($forecastSection1Arima as $f) {
            foreach ($f->forecastSection4s as $fs4) {
                $numaddfacmember[$f->ay] = ($numaddfacmember[$f->ay] ?? 0) + $fs4->numaddfacmember;
            }
        }

        // Build time series sorted chronologically
        ksort($numemprequired);
        $series = array_values($numemprequired);

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

        $result = Process::run([
            config('forecasting.node_binary'),
            base_path('scripts/arima_forecast.js'),
            json_encode(['series' => $series, 'steps' => 1]),
        ]);

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
