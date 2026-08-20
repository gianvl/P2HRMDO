<?php

namespace App\Http\Controllers;

use App\Models\{
    Employee,
    EvalPage,
    ForecastSection1,
    Manpower
};
use App\Services\AcademicYearSeries;
use App\Services\ArimaForecaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForecastingDataController extends Controller
{
    public function __construct(private readonly ArimaForecaster $forecaster)
    {
    }

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
        $ayListArima = AcademicYearSeries::window($ay, 5);

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

        $series = AcademicYearSeries::contiguous($numemprequired, $ayListArima);

        $arimaForecast = $this->forecaster->forecast($series);

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
}
