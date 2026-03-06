<?php

namespace App\Http\Controllers;

use App\Mail\HRMDODirectorNewForecastRequestMail;
use App\Mail\VPANewForecastRequestMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\User;
use App\Models\ForecastSection1;
use App\Models\ForecastSection2;
use App\Models\ForecastSection3;
use App\Models\ForecastSection4;
use App\Models\ForecastSection5;
use App\Models\ForecastSection6;
use App\Models\ForecastSection7;
use App\Models\ForecastSection8;
use App\Models\PositionFormMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB,
    Mail,
    Storage
};

class ForecastingController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        $department = $loggedInUser->department;
        $college = $loggedInUser->college;
    
        // Create a query builder for forecastSection1 table
        $forecastSection1Query = ForecastSection1::orderBy('forecast_num_id', 'DESC');
    
        // Apply filters based on user role
        if ($loggedInUser->position === 'Dean') {
            $forecastSection1Query->where('college', $college);
        } elseif ($loggedInUser->position === 'Chairperson') {
            $forecastSection1Query->where('department', $department);
        }
    
        // Paginate the results for forecastSection1
        $forecastSection1 = $forecastSection1Query->paginate(10);
    
        // Fetch data for other forecastSection tables (similar pattern)
        $forecastSection2 = ForecastSection2::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection3 = ForecastSection3::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection4 = ForecastSection4::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection5 = ForecastSection5::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection6 = ForecastSection6::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection7 = ForecastSection7::orderBy('forecast_num_id', 'DESC')->paginate(10);
        $forecastSection8 = ForecastSection8::orderBy('forecast_num_id', 'DESC')->paginate(10);
    
        return view('requesting.forecastpages.mforecastlist', compact(
            'loggedInUser',
            'department',
            'forecastSection1',
            'forecastSection2',
            'forecastSection3',
            'forecastSection4',
            'forecastSection5',
            'forecastSection6',
            'forecastSection7',
            'forecastSection8'
        ));
    }

    public function create()
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        // Fetch the dean user based on some criteria (you need to define this criteria)
        $deanUser = User::where('position', 'Dean')->first();

        // Check if a dean user was found
        if ($deanUser) {
            // Display the dean user's college
            $deanCollege = $deanUser->college;
        } else {
            // Handle the case where no dean user was found
            $deanCollege = ''; // or any default value
        }

        $department = $loggedInUser->department;

        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();

        $positionFormMapping = PositionFormMapping::where('position', $loggedInUser->position)
            ->where('department', $loggedInUser->department)
            ->first();

        $employeeCountByEmployeeStatus = Employee::select(
                'employment_status',
                DB::raw('count(*) as total')
            )
            ->whereNotNull('employment_status')
            ->where('employment_status', "<>", "")
            ->where('college', "<>", "")
            ->where('college', $loggedInUser->college)
            ->where('department', $loggedInUser->department)
            ->groupBy('employment_status')
            ->get();

        // dd($employeeCountByEmployeeStatus);
        
        $employeeCountByEmployeeStatusArr = [];
        foreach ($employeeCountByEmployeeStatus as $status) {
            $employeeCountByEmployeeStatusArr[$status->employment_status] = $status->total;
        }

        // dd($employeeCountByEmployeeStatusArr);

        return view('requesting.forecastpages.mforecastform', compact(
            'deanUser',
            'deanCollege',
            'loggedInUser', 
            'loggedInUserPosition',
            'positionFormMapping',
            'professors',
            'employeeCountByEmployeeStatusArr'
        ));
    }

    public function store(Request $request)
    {

        // dd($request);

        $requestAll = $request->all();
        $totalServiceSubjs = 0;
        foreach ($requestAll as $key => $val) {
            if (str_contains($key, "servsubj-")) {
                $totalServiceSubjs++;
            }
        }

        // Validate the request data
        $validatedData = $request->validate([
            'college' => 'required',
            'department' => 'required',
            'ay' => 'required',
            'semester' => 'required',
        ]);

        // Create a new ForecastSection1 instance
        $forecastSection1 = new ForecastSection1($validatedData);

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignature = $request->file('chairsignature');
            $chairsignaturePath = $chairsignature->store('images', 'public');
            $forecastSection1->chairsignature = $chairsignaturePath;
        } else {
            $chairsignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignature = $request->file('deansignature');
            $deansignaturePath= $deansignature->store('images', 'public');
            $forecastSection1->deansignature = $deansignaturePath;
        } else {
            $deansignaturePath = null; // Set the variable to null if no image was uploaded
        }

        $forecastSection1->save();

        // Create related models and save them using the relationships
        $forecastSection1->forecastSection2s()->create([
            'forecast_num_id' => $forecastSection1->forecast_num_id,
            'fulltimeperm' => $request->input('fulltimeperm'),
            'parttimeperm' => $request->input('parttimeperm'),
            'fulltimecontrac' => $request->input('fulltimecontrac'),
            'parttimecontrac' => $request->input('parttimecontrac')
        ]);


        if ($request->input('namefacreplace')) {
            for ($ctr = 0; $ctr < count($request->input('namefacreplace')); $ctr++) {
                $forecastSection3 = new ForecastSection3;
                $forecastSection3->forecast_num_id = $forecastSection1->forecast_num_id;
                $forecastSection3->namefacreplace = (explode(" | ", $request->input('namefacreplace')[$ctr]))[0] ?? null;
                $forecastSection3->reasonreplace = $request->input('reasonreplace')[$ctr] ?? null;
                $forecastSection3->reasonforhiring = $request->input('reasonforhiring')[$ctr] ?? null;
                $forecastSection3->save();
            }
        }
        
        $jspermfull = 0;
        $jspermpart = 0;
        $jscontracfull = 0;
        $jscontracpart = 0;
        if ($request->input('numaddfacmemberSelectedType') == "Permanent-Full-time") {
            $jspermfull = $request->input('numaddfacmember');
        } else if ($request->input('numaddfacmemberSelectedType') == "Permanent-Part-time") {
            $jspermpart = $request->input('numaddfacmember');
        } else if ($request->input('numaddfacmemberSelectedType') == "Contractual-Full-time") {
            $jscontracfull = $request->input('numaddfacmember');
        } else {
            $jscontracpart = $request->input('numaddfacmember');
        }

        $forecastSection1->forecastSection4s()->create([
            'forecast_num_id' => $forecastSection1->forecast_num_id,
            'numaddfacmember'=> $request->input('numaddfacmember'),
            'jspermfull'=> $jspermfull,
            'jspermpart'=> $jspermpart,
            'jscontracfull'=> $jscontracfull,
            'jscontracpart'=> $jscontracpart
        ]);

        $forecastSection1->forecastSection5s()->create([
            'forecast_num_id' => $forecastSection1->forecast_num_id,
            'jsbachelor'=> $request->input('jsbachelor'),
            'jsmasters'=> $request->input('jsmasters'),
            'jsalliedprog'=> $request->input('jsalliedprog'),
            'yrsofteachexp'=> $request->input('yrsofteachexp'),
            'technicalskills'=> $request->input('technicalskills'),
            'interpersonalskills'=> $request->input('interpersonalskills')
        ]);

        $forecastSection1->forecastSection6s()->create([
            'forecast_num_id' => $forecastSection1->forecast_num_id,

            'aydropdown1s'=> $request->input('aydropdown1s'),
            'aydropdown2s'=> $request->input('aydropdown2s'),
            'forecastSemester'=> $request->input('forecastSemester'),

            'studentpop1y1s'=> $request->input('studentpop1y1s'),
            'studentpop1y2s'=> $request->input('studentpop1y2s'),
            'Total1y1s2sstudent'=> $request->input('Total1y1s2sstudent'),

            'numsectopened1y1s'=> $request->input('numsectopened1y1s'),
            'numsectopened1y2s'=> $request->input('numsectopened1y2s'),
            'Total1y1s2ssection'=> $request->input('Total1y1s2ssection'),

            'studentpop2y1s'=> $request->input('studentpop2y1s'),
            'studentpop2y2s'=> $request->input('studentpop2y2s'),
            'Total2y1s2sstudent'=> $request->input('Total2y1s2sstudent'),

            'numsectopened2y1s'=> $request->input('numsectopened2y1s'),
            'numsectopened2y2s'=> $request->input('numsectopened2y2s'),
            'Total2y1s2ssection'=> $request->input('Total2y1s2ssection'),

            'studentpop3y1s'=> $request->input('studentpop3y1s'),
            'studentpop3y2s'=> $request->input('studentpop3y2s'),
            'Total3y1s2sstudent'=> $request->input('Total3y1s2sstudent'),

            'numsectopened3y1s'=> $request->input('numsectopened3y1s'),
            'numsectopened3y2s'=> $request->input('numsectopened3y2s'),
            'Total3y1s2ssection'=> $request->input('Total3y1s2ssection'),

            'studentpop4y1s'=> $request->input('studentpop4y1s'),
            'studentpop4y2s'=> $request->input('studentpop4y2s'),
            'Total4y1s2sstudent'=> $request->input('Total4y1s2sstudent'),

            'numsectopened4y1s'=> $request->input('numsectopened4y1s'),
            'numsectopened4y2s'=> $request->input('numsectopened4y2s'),
            'Total4y1s2ssection'=> $request->input('Total4y1s2ssection'),

            'studentpop5y1s'=> $request->input('studentpop5y1s'),
            'studentpop5y2s'=> $request->input('studentpop5y2s'),
            'Total5y1s2sstudent'=> $request->input('Total5y1s2sstudent'),

            'numsectopened5y1s'=> $request->input('numsectopened5y1s'),
            'numsectopened5y2s' => $request->input('numsectopened5y2s'),
            'Total5y1s2ssection'=> $request->input('Total5y1s2ssection'),
            
            'Total1sstudent'=> $request->input('Total1sstudent'),
            'Total2sstudent' => $request->input('Total2sstudent'),
            'TotalStudentForecast'=> $request->input('TotalStudentForecast'),

            'Total1ssection'=> $request->input('Total1ssection'),
            'Total2ssection' => $request->input('Total2ssection'),
            'TotalSectionForecast'=> $request->input('TotalSectionForecast')
        ]);

        
        for ($ctr = 0; $ctr < $totalServiceSubjs; $ctr++) {
            $forecastSection1->forecastSection7s()->create([
                'servsubj' => $request->input('servsubj-' . $ctr + 1)[0],
                'ssubj1stnumsectopened'=> $request->input('ssubj1stnumsectopened-' . $ctr + 1)[0],
                'ssubj2ndnumsectopened' => $request->input('ssubj2ndnumsectopened-' . $ctr + 1)[0],
                'Total1s2sForecastServSubject' => $request->input('Total1s2sForecastServSubject-' . $ctr + 1),
            ]);
        }

        $forecastSection1->forecastSection8s()->create([
            'forecast_num_id' => $forecastSection1->forecast_num_id,
            'grandt1st'=> $request->input('grandt1st'),
            'grand2nd' => $request->input('grand2nd'),
            'forecastgrandtotal' => $request->input('forecastgrandtotal')
        ]);

        // Redirect or return a response
        return redirect()->route('forecast.index');
    }

    public function show($forecast_num_id)
    {
        $loggedInUser = Auth::user();

        $department = $loggedInUser->department;

        // Fetch the dean user based on some criteria (you need to define this criteria)
        $deanUser = User::where('position', 'Dean')->first();

        // Check if a dean user was found
        if ($deanUser) {
            // Display the dean user's college
            $deanCollege = $deanUser->college;
        } else {
            // Handle the case where no dean user was found
            $deanCollege = ''; // or any default value
        }

        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();

        $employeeCountByEmployeeStatus = Employee::select(
            'employment_status',
            DB::raw('count(*) as total')
        )
            ->whereNotNull('employment_status')
            ->where('employment_status', "<>", "")
            ->where('college', "<>", "")
            ->where('college', $loggedInUser->college)
            ->where('department', $loggedInUser->department)
            ->groupBy('employment_status')
            ->get();
    
        $employeeCountByEmployeeStatusArr = [];
        foreach ($employeeCountByEmployeeStatus as $status) {
            $employeeCountByEmployeeStatusArr[$status->employment_status] = $status->total;
        }

        $forecastSection1 = ForecastSection1::findOrFail($forecast_num_id);

        // firstOrFail -> single records
        // get -> multiple records

        // Dump and Die
        // dd(variable)

        $forecastSection2 = $forecastSection1->forecastSection2s()->firstOrFail();

        $forecastSection3 = $forecastSection1->forecastSection3s()->get();
        
        $forecastSection4 = $forecastSection1->forecastSection4s()->firstOrFail();
        $forecastSection5 = $forecastSection1->forecastSection5s()->firstOrFail();
        $forecastSection6 = $forecastSection1->forecastSection6s()->firstOrFail();
        $forecastSection7 = $forecastSection1->forecastSection7s()->get();

        $forecastSection8 = $forecastSection1->forecastSection8s()->firstOrFail();

        // return view('requesting/forecastpages/savemforecast', compact[
        return view('requesting/forecastpages/savemforecast', [
            'forecastSection1' => $forecastSection1,
            'forecastSection2' => $forecastSection2,
            'forecastSection3' => $forecastSection3,
            'forecastSection4' => $forecastSection4,
            'forecastSection5' => $forecastSection5,
            'forecastSection6' => $forecastSection6,
            'forecastSection7' => $forecastSection7,
            'forecastSection8' => $forecastSection8,
            'professors' => $professors,
            'department' => $department,
            'employeeCountByEmployeeStatusArr' => $employeeCountByEmployeeStatusArr,
            'deanUser' => $deanUser,
            'deanCollege' => $deanCollege,
            'loggedInUser' => $loggedInUser
        ]);
    }

    public function edit($forecast_num_id)
    {

        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        // Fetch the dean user based on some criteria (you need to define this criteria)
        $deanUser = User::where('position', 'Dean')->first();

        // Check if a dean user was found
        if ($deanUser) {
            // Display the dean user's college
            $deanCollege = $deanUser->college;
        } else {
            // Handle the case where no dean user was found
            $deanCollege = ''; // or any default value
        }

        $department = $loggedInUser->department;

        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();

        $positionFormMapping = PositionFormMapping::where('position', $loggedInUser->position)
            ->where('department', $loggedInUser->department)
            ->first();

        $employeeCountByEmployeeStatus = Employee::select(
                'employment_status',
                DB::raw('count(*) as total')
            )
            ->whereNotNull('employment_status')
            ->where('employment_status', "<>", "")
            ->where('college', "<>", "")
            ->where('college', $loggedInUser->college)
            ->where('department', $loggedInUser->department)
            ->groupBy('employment_status')
            ->get();
        
        $employeeCountByEmployeeStatusArr = [];
        foreach ($employeeCountByEmployeeStatus as $status) {
            $employeeCountByEmployeeStatusArr[$status->employment_status] = $status->total;
        }
            
        $forecastSection1 = ForecastSection1::findOrFail($forecast_num_id);
        $forecastSection2 = $forecastSection1->forecastSection2s()->firstOrFail();
        $forecastSection3 = $forecastSection1->forecastSection3s()->get();
        $forecastSection4 = $forecastSection1->forecastSection4s()->firstOrFail();
        $forecastSection5 = $forecastSection1->forecastSection5s()->firstOrFail();
        $forecastSection6 = $forecastSection1->forecastSection6s()->firstOrFail();
        $forecastSection7 = $forecastSection1->forecastSection7s()->get();
        $forecastSection8 = $forecastSection1->forecastSection8s()->firstOrFail();

        $employees = Employee::all();
        $employeeMap = [];
        foreach ($employees as  $employee) {
            $employeeMap[trim($employee->first_name) . ' ' . trim($employee->last_name)] = $employee->employment_status;
        }

        $forecastSection7Arr = [];
        foreach ($forecastSection7 as $data) {
            $forecastSection7Arr[] = [
                "servsubj_id" => $data->servsubj_id,
                "forecast_num_id" => $data->forecast_num_id,
                "servsubj" => $data->servsubj,
                "ssubj1stnumsectopened" => $data->ssubj1stnumsectopened,
                "ssubj2ndnumsectopened" => $data->ssubj2ndnumsectopened,
                "Total1s2sForecastServSubject" => $data->Total1s2sForecastServSubject,
            ];
        }

        // return view('requesting/forecastpages/savemforecast', compact[
        return view('requesting/forecastpages/editmforecast', [
            'forecastSection1' => $forecastSection1,
            'forecastSection2' => $forecastSection2,
            'forecastSection3' => $forecastSection3,
            'forecastSection4' => $forecastSection4,
            'forecastSection5' => $forecastSection5,
            'forecastSection6' => $forecastSection6,
            'forecastSection7' => $forecastSection7,
            'forecastSection8' => $forecastSection8,
            'deanUser' => $deanUser,
            'deanCollege' => $deanCollege,
            'loggedInUser' => $loggedInUser,
            'loggedInUserPosition' => $loggedInUserPosition,
            'positionFormMapping' => $positionFormMapping,
            'professors' => $professors,
            'employeeCountByEmployeeStatusArr' => $employeeCountByEmployeeStatusArr,
            'forecastSection7Arr' => json_encode($forecastSection7Arr),
            'employeeMap' => $employeeMap
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $forecast_num_id)
    {
        // dd($request);
        $loggedInUser = Auth::user();

        // Retrieve the ForecastSection1 record
        $forecastSection1 = ForecastSection1::findOrFail($forecast_num_id);

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignatureFile = $request->file('chairsignature');
            $chairsignaturePath = $chairsignatureFile->store('images', 'public');
            // Delete the existing chairperson signature image if it exists
            if ($forecastSection1->chairsignature) {
                Storage::delete('public/' . $forecastSection1->chairsignature);
            }
            $forecastSection1->chairsignature = $chairsignaturePath; // Retrieve the existing image path
        }

        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignatureFile = $request->file('deansignature');
            $deansignaturePath = $deansignatureFile->store('images', 'public');
            // Delete the existing dean signature image if it exists
            if ($forecastSection1->deansignature) {
                Storage::delete('public/' . $forecastSection1->deansignature);
            }
            $forecastSection1->deansignature = $deansignaturePath; // Retrieve the existing image path
        }

        // Update the ForecastSection1 record
        $forecastSection1->college = $request->input('college') ?? $forecastSection1->college;
        $forecastSection1->department = $request->input('department')  ?? $forecastSection1->department;
        $forecastSection1->ay = $request->input('ay') ?? $forecastSection1->ay;
        $forecastSection1->semester = $request->input('semester') ?? $forecastSection1->semester;
        $forecastSection1->save();
        
        // Retrieve and update the related ForecastSection2 record
        $forecastSection2 = $forecastSection1->forecastSection2s()->first();
        $forecastSection2->fulltimeperm = $request->input('fulltimeperm');
        $forecastSection2->parttimeperm = $request->input('parttimeperm');
        $forecastSection2->fulltimecontrac = $request->input('fulltimecontrac');
        $forecastSection2->parttimecontrac = $request->input('parttimecontrac');
        $forecastSection2->save();
        
        // forecastSection3 model
        // Delete to reset
        ForecastSection3::where('forecast_num_id', $forecast_num_id)
            ->delete();
        
        // Re-insert records
        $namefacreplace = $request->input('namefacreplace');
        $reasonreplace = $request->input('reasonreplace');
        $reasonforhiring = $request->input('reasonforhiring');

        for ($ctr = 0; $ctr < count($namefacreplace); $ctr++) {
            $forecastSection3 = new ForecastSection3;
            $forecastSection3->forecast_num_id = $forecast_num_id;
            $forecastSection3->namefacreplace = (explode(" | ", $namefacreplace[$ctr]))[0] ?? null;
            $forecastSection3->reasonreplace = $reasonreplace[$ctr] ?? null;
            $forecastSection3->reasonforhiring = $reasonforhiring[$ctr] ?? null;
            $forecastSection3->save();
        }
        
        // Retrieve and update the related ForecastSection4 record
        $forecastSection4 = $forecastSection1->forecastSection4s()->first();


        $jspermfull = 0;
        $jspermpart = 0;
        $jscontracfull = 0;
        $jscontracpart = 0;
        if ($request->input('numaddfacmemberSelectedType') == "Permanent-Full-time") {
            $jspermfull = $request->input('numaddfacmember');
        } else if ($request->input('numaddfacmemberSelectedType') == "Permanent-Part-time") {
            $jspermpart = $request->input('numaddfacmember');
        } else if ($request->input('numaddfacmemberSelectedType') == "Contractual-Full-time") {
            $jscontracfull = $request->input('numaddfacmember');
        } else {
            $jscontracpart = $request->input('numaddfacmember');
        }

        $forecastSection4->numaddfacmember = $request->input('numaddfacmember');
        $forecastSection4->jspermfull = $jspermfull;
        $forecastSection4->jspermpart = $jspermpart;
        $forecastSection4->jscontracfull = $jscontracfull;
        $forecastSection4->jscontracpart = $jscontracpart;
        $forecastSection4->save();
        
        // Retrieve and update the related ForecastSection5 record
        $forecastSection5 = $forecastSection1->forecastSection5s()->first();
        $forecastSection5->jsbachelor = $request->input('jsbachelor');
        $forecastSection5->jsmasters = $request->input('jsmasters');
        $forecastSection5->jsalliedprog = $request->input('jsalliedprog');
        $forecastSection5->yrsofteachexp = $request->input('yrsofteachexp');
        $forecastSection5->technicalskills = $request->input('technicalskills');
        $forecastSection5->interpersonalskills = $request->input('interpersonalskills');
        $forecastSection5->save();
        
        // Retrieve and update the related ForecastSection6 record
        $forecastSection6 = $forecastSection1->forecastSection6s()->first();

        $forecastSection6->aydropdown1s = $request->input('aydropdown1s');
        $forecastSection6->aydropdown2s = $request->input('aydropdown2s');
        $forecastSection6->forecastSemester = $request->input('forecastSemester');

        $forecastSection6->studentpop1y1s = $request->input('studentpop1y1s');
        $forecastSection6->studentpop1y2s = $request->input('studentpop1y2s');
        $forecastSection6->Total1y1s2sstudent = $request->input('Total1y1s2sstudent');

        $forecastSection6->numsectopened1y1s = $request->input('numsectopened1y1s');
        $forecastSection6->numsectopened1y2s = $request->input('numsectopened1y2s');
        $forecastSection6->Total1y1s2ssection = $request->input('Total1y1s2ssection');

        $forecastSection6->studentpop2y1s = $request->input('studentpop2y1s');
        $forecastSection6->studentpop2y2s = $request->input('studentpop2y2s');
        $forecastSection6->Total2y1s2sstudent = $request->input('Total2y1s2sstudent');

        $forecastSection6->numsectopened2y1s = $request->input('numsectopened2y1s');
        $forecastSection6->numsectopened2y2s = $request->input('numsectopened2y2s');
        $forecastSection6->Total2y1s2ssection = $request->input('Total2y1s2ssection');

        $forecastSection6->studentpop3y1s = $request->input('studentpop3y1s');
        $forecastSection6->studentpop3y2s = $request->input('studentpop3y2s');
        $forecastSection6->Total3y1s2sstudent = $request->input('Total3y1s2sstudent');

        $forecastSection6->numsectopened3y1s = $request->input('numsectopened3y1s');
        $forecastSection6->numsectopened3y2s = $request->input('numsectopened3y2s');
        $forecastSection6->Total3y1s2ssection = $request->input('Total3y1s2ssection');

        $forecastSection6->studentpop4y1s = $request->input('studentpop4y1s');
        $forecastSection6->studentpop4y2s = $request->input('studentpop4y2s');
        $forecastSection6->Total4y1s2sstudent = $request->input('Total4y1s2sstudent');

        $forecastSection6->numsectopened4y1s = $request->input('numsectopened4y1s');
        $forecastSection6->numsectopened4y2s = $request->input('numsectopened4y2s');
        $forecastSection6->Total4y1s2ssection = $request->input('Total4y1s2ssection');

        $forecastSection6->studentpop5y1s = $request->input('studentpop5y1s');
        $forecastSection6->studentpop5y2s = $request->input('studentpop5y2s');
        $forecastSection6->Total5y1s2sstudent = $request->input('Total5y1s2sstudent');

        $forecastSection6->numsectopened5y1s = $request->input('numsectopened5y1s');
        $forecastSection6->numsectopened5y2s = $request->input('numsectopened5y2s');
        $forecastSection6->Total5y1s2ssection = $request->input('Total5y1s2ssection');
        
        $forecastSection6->Total1sstudent = $request->input('Total1sstudent');
        $forecastSection6->Total2sstudent = $request->input('Total2sstudent');
        $forecastSection6->TotalStudentForecast = $request->input('TotalStudentForecast');

        $forecastSection6->Total1ssection = $request->input('Total1ssection');
        $forecastSection6->Total2ssection = $request->input('Total2ssection');
        $forecastSection6->TotalSectionForecast = $request->input('TotalSectionForecast');
        $forecastSection6->save();

        // forecastSection7 model
        // Delete to reset
        ForecastSection7::where('forecast_num_id', $forecast_num_id)
            ->delete();

        $requestAll = $request->all();
        $totalServiceSubjs = 0;

        // Determine the total number of records to insert
        foreach ($requestAll as $key => $val) {
            if (str_contains($key, "servsubj-")) {
                $totalServiceSubjs++;
            }
        }

        for ($ctr = 0; $ctr < $totalServiceSubjs; $ctr++) {
            $forecastSection7 = new ForecastSection7;

            $forecastSection7->forecast_num_id = $forecast_num_id;
            $forecastSection7->servsubj = $request->input('servsubj-' . $ctr + 1) [0] ?? null;
            $forecastSection7->ssubj1stnumsectopened = $request->input('ssubj1stnumsectopened-' . $ctr + 1) [0] ?? null;
            $forecastSection7->ssubj2ndnumsectopened = $request->input('ssubj2ndnumsectopened-' . $ctr + 1) [0] ?? null;
            $forecastSection7->Total1s2sForecastServSubject = $request->input('Total1s2sForecastServSubject-' . $ctr + 1);

            $forecastSection7->save();
        }


        // Retrieve and update the related ForecastSection8 record
        $forecastSection8 = $forecastSection1->forecastSection8s()->first();
        $forecastSection8->grandt1st = $request->input('grandt1st');
        $forecastSection8->grand2nd = $request->input('grand2nd');
        $forecastSection8->forecastgrandtotal = $request->input('forecastgrandtotal');
        $forecastSection8->save();

        return redirect()->route('forecast.index')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($forecast_num_id)
    {
        $forecastSection1 = ForecastSection1::findOrFail($forecast_num_id);

        $forecastSection1->delete();

        return redirect()->route('forecast.index')->with('success', 'forecast form deleted successfully');

    }

    public function sendForApproval($fs1)
    {
        $forecastformFind = ForecastSection1::find($fs1);
        if ($forecastformFind) {
            if(
                !$forecastformFind->chairsignature ||
                !$forecastformFind->deansignature
            ) {
                return redirect()->route('forecast.index', $fs1)
                    ->with('error', 'Please attach the chairperson and dean signature before submitting the form.');
            }
        }

        $forecastSection1 = ForecastSection1::findOrFail($fs1);

        // Retrieve the email addresses of users with the position "VPA"
        $vpaEmail = User::where('position', 'VPA')->value('email');

        // Retrieve the email addresses of users with the position "HRMDO Director"
        $hrmdoDirectorEmail = User::where('position', 'HRMDO Director')->value('email');


        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($vpaEmail) {
            Mail::to($vpaEmail)->send(new VPANewForecastRequestMail($forecastSection1));
        }
    
        if ($hrmdoDirectorEmail) {
            Mail::to($hrmdoDirectorEmail)->send(new HRMDODirectorNewForecastRequestMail($forecastSection1));
        }

        $forecastSection1 = ForecastSection1::find($fs1);
        if ($forecastSection1) {
            $forecastSection1->approval_status = "Waiting for Approval";
            $forecastSection1->save();
        }

        return redirect()->route('forecast.index')->with('success', 'forecast approval sent');
    }

    public function professionalMajorSubjects(string $ay, string $semester)
    {
        $semester = str_replace("%20", "", $semester);
        if ($semester == "1st Semester") {
            $ayArr = explode("-", $ay);
            $prevAy = intval($ayArr[0]) - 1 . "-" . intval($ayArr[1]) - 1;
            $forecastSection6 = ForecastSection6::where('forecastSemester', "2nd Semester")
                ->where('aydropdown2s', $prevAy)
                ->first();
        } else {
            $forecastSection6 = ForecastSection6::where('forecastSemester', "1st Semester")
                ->where('aydropdown1s', $ay)
                ->first();
        }
        
        return $forecastSection6;
    }

    public function professorsDepartment(string $college, string $department)
    {
        $professors = Employee::where('emp_type', 'Professor')
            ->where('department', $department)
            ->get();

        $employeeCountByEmployeeStatus = Employee::select(
            'employment_status',
            DB::raw('count(*) as total')
        )
            ->whereNotNull('employment_status')
            ->where('employment_status', "<>", "")
            ->where('college', "<>", "")
            ->where('college', $college)
            ->where('department', $department)
            ->groupBy('employment_status')
            ->get();
    
        $employeeCountByEmployeeStatusArr = [];
        foreach ($employeeCountByEmployeeStatus as $status) {
            $employeeCountByEmployeeStatusArr[$status->employment_status] = $status->total;
        }
        
        return [
            "professors" => $professors,
            "employeeCountByEmployeeStatusArr" => $employeeCountByEmployeeStatusArr
        ];
    }
}