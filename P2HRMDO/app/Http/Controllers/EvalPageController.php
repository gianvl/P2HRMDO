<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Employee,
    EvalPage
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user(); // Assuming you're using authentication
        $department = $loggedInUser->department;
        $college = $loggedInUser->college;
    
        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();
    
        return view('requesting/evalpages/inputevalpage', [
            'professors' => $professors,
            'loggedInUser' => $loggedInUser,
            'college' => $college,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedInUser = Auth::user();
        $evalpages = EvalPage::all();
        return view('evalpages/inputevalpage', compact('evalpages','loggedInUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        dd($request->all());
        $evalpage = EvalPage::create($request->all()); 
        return redirect()->route('evalpages.show', [$evalpage->id ])->with('success', 'Data saved successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loggedInUser = Auth::user();

        $evalpages = EvalPage::findOrFail($id);
        $professors = Employee::where('emp_type', '=', 'Professor')
            ->get();
        $employee_id = Employee::where('id', '=', $evalpages->employee_id)
            ->get();
        return view('requesting/evalpages/saveevalpage', [
            'evalpages' => $evalpages,
            'professors' => $professors,
            'employee_id' => $employee_id,
            'loggedInUser' => $loggedInUser
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

    public function evaluationCheck($employeeId, $ay, $semester)
    {
        $evalCount = EvalPage::where('employee_id', $employeeId)
            ->where('ay', $ay)
            ->where('semester', str_replace("%20", " ", $semester))
            ->count();

        return [
            "count" => $evalCount
        ];
    }

    public function storeViaAPI(Request $request)
    {   
        $evalpage = EvalPage::create($request->all());

        return $evalpage;
    }
}
