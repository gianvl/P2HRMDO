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
use Fieg\Markov\MarkovChain;

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

    public function viewMarkovRequesting()
    {
        $loggedInUser = Auth::user();

        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();
        return view('requesting.markovforecast', compact('loggedInUser', 'collegeList'));
    }

    public function viewMarkovApproval()
    {
        $loggedInUser = Auth::user();

        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();
        return view('approval.markovforecast', compact('loggedInUser', 'collegeList'));
    }

    public function forecastingData(string $college, string $department, string $ay, string $sem)
    {
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

        ////MANPOWER REQUIRED////
        $chart1Sentences = [];
        foreach ($manpower as $mp) {
            $chart1Sentences[] = "manpower estimate " . $mp->num_emp_required ?? 0;
        }
        foreach ($forecastSection1 as $fs1) {
            $chart1Sentences[] = "forecastSection4s estimate " . $fs1->forecast_num_id . " " . $fs1->forecastSection4s[0]->numaddfacmember ?? 0;
        }
        $chain = new MarkovChain();

        foreach ($chart1Sentences as $sentence) {
            $tokens = explode(" ", $sentence);
            $chain->train($tokens);
        }

        $chart1Result = $chain->query("estimate");

        $markov = [
            "chart1" => $chart1Result,
        ];

        // MARKOV CHART 1 NEW COMPUTATION
        $ayListMarkov = [$ay];
        $ayArrMarkov = explode("-", $ay);
        $startYrMarkov = intval($ayArrMarkov[0]);
        $endYrMarkov = intval($ayArrMarkov[1]);
        for ($yrCtr = 0; $yrCtr < 4; $yrCtr++) {
            $startYrMarkov = $startYrMarkov - 1;
            $endYrMarkov = $endYrMarkov - 1;
            $ayListMarkov[] = "{$startYrMarkov}-{$endYrMarkov}";
        }

        $manpowerMarkov = Manpower::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayListMarkov)
            ->where('semester', $sem)
            ->get();

        $employeeIdsMarkov = Employee::where('college', $college)
            ->where('department', $department)
            ->get()
            ->pluck("id");

        $evalpageMarkov = EvalPage::whereIn('employee_id', $employeeIdsMarkov)
            ->whereIn('ay', $ayListMarkov)
            ->where('semester', $sem)
            ->get();

        $forecastSection1Markov = ForecastSection1::where('college', $college)
            ->where('department', $department)
            ->whereIn('ay', $ayListMarkov)
            ->where('semester', $sem)
            ->with('forecastSection2s')
            ->with('forecastSection3s')
            ->with('forecastSection4s')
            ->with('forecastSection5s')
            ->with('forecastSection6s')
            ->with('forecastSection7s')
            ->with('forecastSection8s')
            ->get();
        
        $numaddfacmember = [];
        $numemprequired = [];
        $totalcount = [];
        foreach ($forecastSection1Markov as $fmarkov) {

            foreach ($fmarkov->forecastSection4s as $forecastSection4s) {
                if (isset($numaddfacmember[$fmarkov->ay])) {
                    $numaddfacmember[$fmarkov->ay] += $forecastSection4s->numaddfacmember;
                } else {
                    $numaddfacmember[$fmarkov->ay] = $forecastSection4s->numaddfacmember;
                }
            }

        }
        

        foreach ($manpowerMarkov as $mmarkov) {
            if (isset($numemprequired[$mmarkov->ay])) {
                $numemprequired[$mmarkov->ay] += $mmarkov->num_emp_required;
            } else {
                $numemprequired[$mmarkov->ay] = $mmarkov->num_emp_required;
            }
        }

        foreach ($evalpageMarkov as $eMarkov) {
            if (isset($totalcount[$eMarkov->ay])) {
                if ($eMarkov->overallstatus == "Subject for deliberation") {
                    $totalcount[$eMarkov->ay] += 1;
                } else {
                    $overallstatus = $eMarkov->overallstatus;
                    $overallstatus = floatval(str_replace("%", "", $overallstatus));
                    if ($overallstatus < 50) {
                        $totalcount[$eMarkov->ay] += 1;
                    }
                }
            } else {
                if ($eMarkov->overallstatus == "Subject for deliberation") {
                    $totalcount[$eMarkov->ay] = 1;
                } else {
                    $overallstatus = $eMarkov->overallstatus;
                    $overallstatus = floatval(str_replace("%", "", $overallstatus));
                    if ($overallstatus < 50) {
                        $totalcount[$eMarkov->ay] = 1;
                    }
                }
            }
        }

        $sentences = [];
        foreach ($numaddfacmember as $key => $value) {
            $sentences[] = ($totalcount[$key] ?? null) . " " . ($value ?? null) . " " . ($numemprequired[$key] ?? null);
        }

        $finalMarkovchain = new MarkovChain();
        foreach ($sentences as $sentence) {
            $tokens = explode(" ", $sentence);
            $finalMarkovchain->train($tokens);
        }
        $finalMarkovchain = $finalMarkovchain->getTransitionMatrix();

        $relativeValues = [
            "forecasted" => 0,
            "requested" => 0
        ];

        foreach ($forecastSection1 as $fs) {
            foreach ($fs->forecastSection4s as $forecastSection4s) {
                $relativeValues["forecasted"] += $forecastSection4s->numaddfacmember;
            }
        }

        foreach ($manpower as $mp) {
            $relativeValues["requested"] += $mp->num_emp_required;
        }

        $selectedMarkovKeys = [];
        foreach ($finalMarkovchain as $key => $value) {
            foreach ($value as $k => $v) {
                if (
                    $k == $relativeValues["forecasted"] ||
                    $k == $relativeValues["requested"]
                ) {
                    $selectedMarkovKeys[] = $key;
                }
            }
        }

        $selectedMarkovKeys = array_values(array_unique($selectedMarkovKeys));
    

        $finalMarkovValueChart1 = round(array_sum($selectedMarkovKeys) / count($selectedMarkovKeys));

        return [
            "manpower" => $manpower,
            "evalpage" => $evalpage,
            "forecastSection1" => $forecastSection1,
            "markov" => $markov,
            "ayList" => $ayList,
            "ayListMarkov" => $ayListMarkov,
            "markov5years" => [
                "manpowerMarkov" => $manpowerMarkov,
                "evalpageMarkov" => $evalpageMarkov,
                "forecastSection1Markov" => $forecastSection1Markov,
                "total" => [
                    "numaddfacmember" => $numaddfacmember,
                    "numemprequired" => $numemprequired,
                    "totalcount" => $totalcount,
                    "sentences" => $sentences,
                    "finalMarkovchain" => $finalMarkovchain,
                    "relativeValues" => $relativeValues,
                    "selectedMarkovKeys" => $selectedMarkovKeys,
                    "finalMarkovValueChart1" => $finalMarkovValueChart1
                ]
            ]
        ];
    }
}
