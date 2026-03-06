<?php

namespace App\Http\Controllers;
use App\Models\{
    User,
    Employee,
    EvalPage,
    ForecastSection1,
    ForecastSection2,
    ForecastSection3,
    ForecastSection4,
    ForecastSection5,
    ForecastSection6,
    ForecastSection7,
    ForecastSection8,
    Manpower,
    ManpowerProcessing,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ForecastingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();
        $department = $loggedInUser->department;
        $collegeList = DB::table('employees')
            ->select(DB::raw('DISTINCT(`college`)'))
            ->get();

        return view('processing.forecastingsystem.fsystem', compact('loggedInUser', 'collegeList', 'department'));
    
        // $department = $loggedInUser->department;

        // $professors = Employee::where('emp_type', 'Professor')
        // ->where('department', $department)
        // ->get();

        // return view('processing.forecastingsystem.fsystem', [
        //     'loggedInUser' => $loggedInUser,
        //     'professors' => $professors,
        //     'department' => $department,
        // ]);
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

    public function forecastingSystem(string $college, string $department, string $ay, string $semester)
    {
        $firstSemester = [];
        $secondSemester = [];
        if ($semester == "1st Semester") {
            $ForecastSection1 = ForecastSection1::where('college', $college)
                ->where('department', $department)
                ->where('ay', $ay)
                ->where('semester', "1st Semester")
                ->first();

            if ($ForecastSection1) {
                $forecastNumIds[] = $ForecastSection1->forecast_num_id;

                $ForecastSection2 = ForecastSection2::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $ForecastSection3 = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                ->select([
                    "reasonreplace",
                    DB::raw("count(*) as total")
                ])
                ->groupBy("reasonreplace")
                ->get();

                $ForecastSection3List = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                    ->select([
                        "reasonreplace",
                        "forecast_num_id",
                        "namefacreplace",
                        "reasonforhiring",
                    ])
                    ->get();


                

                $ForecastSection4 = ForecastSection4::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection5 = ForecastSection5::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection6 = ForecastSection6::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection7 = ForecastSection7::whereIn('forecast_num_id', $forecastNumIds)
                    ->get();
                $ForecastSection8 = ForecastSection8::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $manpowers = Manpower::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', $semester)
                    ->first();

                $manpowerprocessing = ManpowerProcessing::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', $semester)
                    ->get();
                

                $employeeIds = Employee::where('college', $college)
                    ->where('department', $department)
                    ->get()
                    ->pluck("id");

                $evalpages = [];
                if (count($employeeIds)) {
                    $evalpages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
                        ->where('eval_pages.ay', $ay)
                        ->where('eval_pages.semester', $semester)
                        ->leftJoin('employees', 'employees.id', '=', 'eval_pages.employee_id')
                        ->select([
                            DB::Raw("employees.first_name"),
                            DB::Raw("employees.last_name"),
                            DB::Raw("eval_pages.*"),
                        ])
                        ->get();
                }
                    
                $semesterCurrentSchoolYr = [
                    "ForecastSection1" => $ForecastSection1,
                    "ForecastSection2" => $ForecastSection2,
                    "ForecastSection3" => $ForecastSection3,
                    "ForecastSection3List" => $ForecastSection3List,
                    "ForecastSection4" => $ForecastSection4,
                    "ForecastSection5" => $ForecastSection5,
                    "ForecastSection6" => $ForecastSection6,
                    "ForecastSection7" => $ForecastSection7,
                    "ForecastSection8" => $ForecastSection8,
                    "manpowers" => $manpowers,
                    "manpowerprocessing" => $manpowerprocessing,
                    "evalpages" => $evalpages,
                ];
            } else {
                $semesterCurrentSchoolYr = [
                    "ForecastSection1" => [],
                    "ForecastSection2" => [],
                    "ForecastSection3" => [],
                    "ForecastSection3List" => [],
                    "ForecastSection4" => [],
                    "ForecastSection5" => [],
                    "ForecastSection6" => [],
                    "ForecastSection7" => [],
                    "ForecastSection8" => [],
                    "manpowers" => [],
                    "manpowerprocessing" => [],
                    "evalpages" => [],
                ];
            }           

            $ayArr = explode("-", $ay);
            $previousAy = intval(trim($ayArr[0])) - 1 . '-' . intval(trim($ayArr[1])) - 1;
            $ForecastSection1 = ForecastSection1::where('college', $college)
                ->where('department', $department)
                ->where('ay', $previousAy)
                ->where('semester', "1st Semester")
                ->first();

            if ($ForecastSection1) {
                $forecastNumIds[] = $ForecastSection1->forecast_num_id;

                $ForecastSection2 = ForecastSection2::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                
                $ForecastSection3 = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                ->select([
                    "reasonreplace",
                    DB::raw("count(*) as total")
                ])
                ->groupBy("reasonreplace")
                ->get();

                $ForecastSection3List = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                    ->select([
                        "reasonreplace",
                        "forecast_num_id",
                        "namefacreplace",
                        "reasonforhiring",
                    ])
                    ->get();

                $ForecastSection4 = ForecastSection4::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection5 = ForecastSection5::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection6 = ForecastSection6::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection7 = ForecastSection7::whereIn('forecast_num_id', $forecastNumIds)
                    ->get();
                $ForecastSection8 = ForecastSection8::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $manpowers = Manpower::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $previousAy)
                    ->where('semester', "1st Semester")
                    ->first();

                $manpowerprocessing = ManpowerProcessing::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', $semester)
                    ->get();
    

                $employeeIds = Employee::where('college', $college)
                    ->where('department', $department)
                    ->get()
                    ->pluck("id");

                $evalpages = [];
                if (count($employeeIds)) {
                    $evalpages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
                        ->where('eval_pages.ay', $previousAy)
                        ->where('eval_pages.semester', "2nd Semester")
                        ->leftJoin('employees', 'employees.id', '=', 'eval_pages.employee_id')
                        ->select([
                            DB::Raw("employees.first_name"),
                            DB::Raw("employees.last_name"),
                            DB::Raw("eval_pages.*"),
                        ])
                        ->get();
                }

                $semesterLastSchoolYr = [
                    "ForecastSection1" => $ForecastSection1,
                    "ForecastSection2" => $ForecastSection2,
                    "ForecastSection3" => $ForecastSection3,
                    "ForecastSection3List" => $ForecastSection3List,
                    "ForecastSection4" => $ForecastSection4,
                    "ForecastSection5" => $ForecastSection5,
                    "ForecastSection6" => $ForecastSection6,
                    "ForecastSection7" => $ForecastSection7,
                    "ForecastSection8" => $ForecastSection8,
                    "manpowers" => $manpowers,
                    "manpowerprocessing" => $manpowerprocessing,
                    "evalpages" => $evalpages,
                ];
            } else {
                $semesterLastSchoolYr = [
                    "ForecastSection1" => [],
                    "ForecastSection2" => [],
                    "ForecastSection3" => [],
                    "ForecastSection3List" => [],
                    "ForecastSection4" => [],
                    "ForecastSection5" => [],
                    "ForecastSection6" => [],
                    "ForecastSection7" => [],
                    "ForecastSection8" => [],
                    "manpowers" => [],
                    "manpowerprocessing" => [],
                    "evalpages" => [],
                ];
            }

            
        } else {
            // 2nd sem
            $ForecastSection1 = ForecastSection1::where('college', $college)
                ->where('department', $department)
                ->where('ay', $ay)
                ->where('semester', "2nd Semester")
                ->first();

            if ($ForecastSection1) {
                $manpowers = Manpower::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', "2nd Semester")
                    ->first();
                
                $manpowerprocessing = ManpowerProcessing::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', "2nd Semester")
                    ->get();

                $forecastNumIds[] = $ForecastSection1->forecast_num_id;

                $ForecastSection2 = ForecastSection2::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $ForecastSection3 = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                ->select([
                    "reasonreplace",
                    DB::raw("count(*) as total")
                ])
                ->groupBy("reasonreplace")
                ->get();

                $ForecastSection3List = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                    ->select([
                        "reasonreplace",
                        "forecast_num_id",
                        "namefacreplace",
                        "reasonforhiring",
                    ])
                    ->get();           

                
                $ForecastSection4 = ForecastSection4::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection5 = ForecastSection5::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection6 = ForecastSection6::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection7 = ForecastSection7::whereIn('forecast_num_id', $forecastNumIds)
                    ->get();
                $ForecastSection8 = ForecastSection8::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $employeeIds = Employee::where('college', $college)
                    ->where('department', $department)
                    ->get()
                    ->pluck("id");

                $evalpages = [];
                if (count($employeeIds)) {
                    $evalpages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
                        ->where('eval_pages.ay', $ay)
                        ->where('eval_pages.semester', "2nd Semester")
                        ->leftJoin('employees', 'employees.id', '=', 'eval_pages.employee_id')
                        ->select([
                            DB::Raw("employees.first_name"),
                            DB::Raw("employees.last_name"),
                            DB::Raw("eval_pages.*"),
                        ])
                        ->get();
                }
                    
                $semesterCurrentSchoolYr = [
                    "ForecastSection1" => $ForecastSection1,
                    "ForecastSection2" => $ForecastSection2,
                    "ForecastSection3" => $ForecastSection3, 
                    "ForecastSection3List" => $ForecastSection3List,
                    "ForecastSection4" => $ForecastSection4,
                    "ForecastSection5" => $ForecastSection5,
                    "ForecastSection6" => $ForecastSection6,
                    "ForecastSection7" => $ForecastSection7,
                    "ForecastSection8" => $ForecastSection8,
                    "manpowers" => $manpowers,
                    "manpowerprocessing" => $manpowerprocessing,
                    "evalpages" => $evalpages,
                ];
            } else {
                $semesterCurrentSchoolYr = [
                    "ForecastSection1" => [],
                    "ForecastSection2" => [],
                    "ForecastSection3" => [], 
                    "ForecastSection3List" => [],
                    "ForecastSection4" => [],
                    "ForecastSection5" => [],
                    "ForecastSection6" => [],
                    "ForecastSection7" => [],
                    "ForecastSection8" => [],
                    "manpowers" => [],
                    "manpowerprocessing" => [],
                    "evalpages" => [],
                ];
            }

            $ayArr = explode("-", $ay);
            $previousAy = intval(trim($ayArr[0])) - 1 . '-' . intval(trim($ayArr[1])) - 1;
            $ForecastSection1 = ForecastSection1::where('college', $college)
                ->where('department', $department)
                ->where('ay', $previousAy)
                ->where('semester', "2nd Semester")
                ->first();

            if ($ForecastSection1) {
                $manpowers = Manpower::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', "2nd Semester")
                    ->first();
                
                $manpowerprocessing = ManpowerProcessing::where('college', $college)
                    ->where('department', $department)
                    ->where('ay', $ay)
                    ->where('semester', $semester)
                    ->get();

                $forecastNumIds[] = $ForecastSection1->forecast_num_id;

                $ForecastSection2 = ForecastSection2::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                $ForecastSection3 = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                ->select([
                    "reasonreplace",
                    DB::raw("count(*) as total")
                ])
                ->groupBy("reasonreplace")
                ->get();

                $ForecastSection3List = ForecastSection3::whereIn('forecast_num_id', $forecastNumIds)
                    ->select([
                        "reasonreplace",
                        "forecast_num_id",
                        "namefacreplace",
                        "reasonforhiring",
                    ])
                    ->get();
                
              
                $ForecastSection4 = ForecastSection4::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection5 = ForecastSection5::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection6 = ForecastSection6::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();
                $ForecastSection7 = ForecastSection7::whereIn('forecast_num_id', $forecastNumIds)
                    ->get();
                $ForecastSection8 = ForecastSection8::whereIn('forecast_num_id', $forecastNumIds)
                    ->first();

                
                $employeeIds = Employee::where('college', $college)
                    ->where('department', $department)
                    ->get()
                    ->pluck("id");

                $evalpages = [];
                if (count($employeeIds)) {
                    $evalpages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
                        ->where('eval_pages.ay', $ay)
                        ->where('eval_pages.semester', $semester)
                        ->leftJoin('employees', 'employees.id', '=', 'eval_pages.employee_id')
                        ->select([
                            DB::Raw("employees.first_name"),
                            DB::Raw("employees.last_name"),
                            DB::Raw("eval_pages.*"),
                        ])
                        ->get();
                }

                


                $semesterLastSchoolYr = [
                    "ForecastSection1" => $ForecastSection1,
                    "ForecastSection2" => $ForecastSection2,
                    "ForecastSection3" => $ForecastSection3, 
                    "ForecastSection3List" => $ForecastSection3List,
                    "ForecastSection4" => $ForecastSection4,
                    "ForecastSection5" => $ForecastSection5,
                    "ForecastSection6" => $ForecastSection6,
                    "ForecastSection7" => $ForecastSection7,
                    "ForecastSection8" => $ForecastSection8,
                    "manpowers" => $manpowers,
                    "manpowerprocessing" => $manpowerprocessing,
                    "evalpages" => $evalpages,
                ];
            } else {
                $semesterLastSchoolYr = [
                    "ForecastSection1" => [],
                    "ForecastSection2" => [],
                    "ForecastSection3" => [], 
                    "ForecastSection3List" => [],
                    "ForecastSection4" => [],
                    "ForecastSection5" => [],
                    "ForecastSection6" => [],
                    "ForecastSection7" => [],
                    "ForecastSection8" => [],
                    "manpowers" => [],
                    "manpowerprocessing" => [],
                    "evalpages" => [],
                ];
            }
        }

        return [
            "semesterCurrentSchoolYr" => $semesterCurrentSchoolYr,
            "semesterLastSchoolYr" => $semesterLastSchoolYr,
        ];
    }
}
