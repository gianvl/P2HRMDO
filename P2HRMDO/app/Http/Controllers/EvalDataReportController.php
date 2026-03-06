<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Employee,
    EvalPage
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvalDataReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user(); 

        $department = $loggedInUser->department;
        $college = $loggedInUser->college;

        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();

        return view('requesting.evalpages.searchevaldatareport', [
            'loggedInUser' => $loggedInUser,
            'professors' => $professors,
            'department' => $department,
            'college' => $college,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loggedInUser = Auth::user();
        return view('requesting.evalpages.searchevaldatareport', compact('loggedInUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // //
        // $loggedInUser = Auth::user();
        // return view('requesting.evalpages.searchevaldatareport', compact('loggedInUser'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $loggedInUser = Auth::user();
    //     return view('requesting.evalpages.searchevaldatareport', compact('loggedInUser'));
        
        $evalpages = EvalPage::findOrFail($id);
        $professors = Employee::where('emp_type', '=', 'Professor')
            ->get();
        $employee_id = Employee::where('id', '=', $evalpages->employee_id)
            ->get();
        return view('requesting/evalpages/saveevalpage', [
            'evalpages' => $evalpages,
            'professors' => $professors,
            'employee_id' => $employee_id
        ]);
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

    public function fetchEvalReport($employeeId, $ayFrom, $ayTo)
    {
        $schoolYears = [];
        $ayFromArr = explode("-", $ayFrom);
        $ayToArr = explode("-", $ayTo);
        
        $schoolYears[] = $ayFrom;

        for ($ctr = intval($ayFromArr[0]); $ctr < intval($ayToArr[0]); $ctr++) {
            $schoolYears[] =  $ctr + 1 . "-" . $ctr + 2;
        }

        $schoolYears[] = $ayTo;

        $schoolYears = array_unique($schoolYears);

        $evalPages = EvalPage::where('employee_id', $employeeId)
            ->whereIn("ay", $schoolYears)
            ->get();

        return $evalPages;
    }

    public function fetchDepartmentEvalReport($department, $ayFrom, $ayTo)
    {
        $schoolYears = [];
        $ayFromArr = explode("-", $ayFrom);
        $ayToArr = explode("-", $ayTo);
        
        $schoolYears[] = $ayFrom;

        for ($ctr = intval($ayFromArr[0]); $ctr < intval($ayToArr[0]); $ctr++) {
            $schoolYears[] =  $ctr + 1 . "-" . $ctr + 2;
        }

        $schoolYears[] = $ayTo;

        $schoolYears = array_unique($schoolYears);

        $employeeIds = Employee::where('department', str_replace("%20", "", $department))
            ->select([
                "id"
            ])
            ->get()
            ->pluck("id");

        $evalPages = EvalPage::whereIn('employee_id', $employeeIds)
            ->whereIn("ay", $schoolYears)
            ->get();

        // Fetch employee names based on their IDs and concatenate first_name and last_name
        $employeeNames = Employee::whereIn('id', $employeeIds)
            ->select(["id", "first_name", "last_name"])
            ->get()
            ->keyBy("id")
            ->map(function ($employee) {
                return $employee->first_name . ' ' . $employee->last_name;
            });

        // Attach employee full names to the evaluation data
        $evalPagesWithNames = $evalPages->map(function ($eval) use ($employeeNames) {
            $eval->employee_name = $employeeNames[$eval->employee_id];
            return $eval;
        });

        return $evalPagesWithNames;
    }
}
