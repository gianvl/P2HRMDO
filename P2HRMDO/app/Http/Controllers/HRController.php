<?php

namespace App\Http\Controllers;

use App\Mail\ChairpersonCompletedMail;
use App\Mail\DeanCompletedMail;
use App\Mail\HRMDODirectorCompletedMail;
use App\Mail\VPACompletedMail;
use App\Models\Employee;
use App\Models\ForecastSection1;
use App\Models\Manpower;
use App\Models\ManpowerApproval;
use App\Models\ManpowerProcessing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Mail,
    Validator
};

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();

        $processingForms = ManpowerProcessing::orderBy('created_at', 'DESC')->get();

        // Calculate the counts based on the status of the forms
        $newRequestsCount = $processingForms->where('approval_status', 'Unread')->count();
        $processingCount = $processingForms->where('approval_status', 'Processing')->count();
        $completedCount = $processingForms->where('approval_status', 'Completed')->count();

        $forecastSection1 = ForecastSection1::orderBy('created_at', 'DESC')
            ->where('approval_status', "Approved")
            ->get();

        return view('processing.index', compact('loggedInUser', 'processingForms', 'newRequestsCount', 'processingCount', 'completedCount', 'loggedInUser', 'forecastSection1'));
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
    public function show(string $mrNumProcessing)
    {
        $loggedInUser = Auth::user();

        $processingForms = ManpowerProcessing::findOrFail($mrNumProcessing);
        $mrForm = $processingForms->mrform;

        // Always set the approval_status to "Processing" when viewing
        $processingForms->approval_status = 'Processing';
        $processingForms->save();

        // Find the corresponding requesting form and update its status
        $mrformRequesting = Manpower::where('mrNum', $processingForms->mrNum)->firstOrFail();
        $mrformRequesting->approval_status = "Processing";
        $mrformRequesting->save();  

        // Find the corresponding requesting form and update its status
        $mrformApproval = ManpowerApproval::where('mrNum', $processingForms->mrNum)->firstOrFail();
        $mrformApproval->approval_status = "Processing";
        $mrformApproval->save();  

        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');
        $vpaName = User::where('position', 'VPA')->value('name');

        // Retrieve the employees based on college and department
        $collegeDean = User::where('position', 'Dean')
            ->where('college', $processingForms->college)
            ->first();

        $departmentChairperson = User::where('position', 'Chairperson')
            ->where('department', $processingForms->department)
            ->first();

        return view('processing.processmrform', compact('mrForm', 'processingForms', 'collegeDean', 'departmentChairperson', 'hrmdoDirectorName', 'vpaName', 'loggedInUser'));
    }   
    
    public function show2(string $mrNumProcessing)
    {
        $loggedInUser = Auth::user();

        // $processingForms = ManpowerProcessing::findOrFail($mrNumProcessing);
        $processingForms = ManpowerProcessing::with('manpowerProcessingHiree')->findOrFail($mrNumProcessing);

        $mrForm = $processingForms->mrform;    

        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');
        $vpaName = User::where('position', 'VPA')->value('name');

        // Retrieve the employees based on college and department
        $collegeDean = User::where('position', 'Dean')
            ->where('college', $processingForms->college)
            ->first();

        $departmentChairperson = User::where('position', 'Chairperson')
            ->where('department', $processingForms->department)
            ->first();

        return view('processing.processmrformCompleted', compact('mrForm', 'processingForms', 'collegeDean', 'departmentChairperson', 'hrmdoDirectorName', 'vpaName', 'loggedInUser'));
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

    public function completed($mrNumCompleted, Request $request)
    {
        $rules = [
            'receivedBy' => 'required',
            'rank' => 'required',
            'hireeName' => ['required', 'array', function ($attribute, $value, $fail) use ($request) {
                foreach ($request->input('hireeName') as $index => $name) {
                    if (empty(trim($name))) {
                        $fail("All fields for hiree information must be filled out.");
                    }
                }
            }],
            'hireeDate' => ['required', 'array', function ($attribute, $value, $fail) use ($request) {
                foreach ($request->input('hireeDate') as $index => $date) {
                    if (empty(trim($date))) {
                        $fail("All fields for hiree information must be filled out.");
                    }
                }
            }],
            'hireeRate' => ['required', 'array', function ($attribute, $value, $fail) use ($request) {
                foreach ($request->input('hireeRate') as $index => $rate) {
                    if (empty(trim($rate))) {
                        $fail("All fields for hiree information must be filled out.");
                    }
                }
            }],
        ];

        $validator = Validator::make($request->all(), $rules);   

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
            ->with('error', 'Please fill out all the fields before completing the form.');
        }

        $mrform = ManpowerProcessing::findOrFail($mrNumCompleted);
        $mrform->approval_status = "Completed";

        $mrform->receivedby = $request->input('receivedBy');
        $mrform->rank = $request->input('rank');

        $mrform->manpowerProcessingHiree()->createMany(
            collect($request->input('hireeName'))->zip(
                $request->input('hireeDate'),
                $request->input('hireeRate')
            )->map(function ($item) {
                return [
                    'hireeName' => $item[0],
                    'hireeDate' => $item[1],
                    'hireeRate' => $item[2],
                ];
            })
        );

        $mrform->datecompleted = now();
        $mrform->save();

        // Find the corresponding requesting form and update its status
        $mrformRequesting = Manpower::where('mrNum', $mrform->mrNum)->firstOrFail();
        $mrformRequesting->approval_status = "Completed";
        $mrformRequesting->save();  

        // Find the corresponding requesting form and update its status
        $mrformApproval = ManpowerApproval::where('mrNum', $mrform->mrNum)->firstOrFail();
        $mrformApproval->approval_status = "Completed";
        $mrformApproval->save();

        $mrform = ManpowerProcessing::findOrFail($mrNumCompleted);

        //Retrieve the Dean and Chairperson emails based on college and department
        $deanEmail = User::where('college', $mrform->college)
            ->where('position', 'Dean')
            ->value('email');

        $chairpersonEmail = User::where('department', $mrform->department)
            ->where('position', 'Chairperson')
            ->value('email');

        // Retrieve the email addresses of users with the position "VPA"
        $vpaEmail = User::where('position', 'VPA')->value('email');

        // Retrieve the email addresses of users with the position "HRMDO Director"
        $hrmdoDirectorEmail = User::where('position', 'HRMDO Director')->value('email');


        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($deanEmail) {
            Mail::to($deanEmail)->send(new DeanCompletedMail($mrform));
        }

        if ($chairpersonEmail) {
            Mail::to($chairpersonEmail)->send(new ChairpersonCompletedMail($mrform));
        }

        if ($vpaEmail) {
            Mail::to($vpaEmail)->send(new VPACompletedMail($mrform));
        }
    
        if ($hrmdoDirectorEmail) {
            Mail::to($hrmdoDirectorEmail)->send(new HRMDODirectorCompletedMail($mrform));
        }

        return redirect()->route('processingdashboard.index');
    }  

    public function showForecastForm(string $forecast_num_id)
    {
        $loggedInUser = Auth::user();

        $department = $loggedInUser->department;

        $pendingFormsForecast = ForecastSection1::findOrFail($forecast_num_id);

        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');
        $vpaName = User::where('position', 'VPA')->value('name');

        // Retrieve the employees based on college and department
        $collegeDean = User::where('position', 'Dean')
            ->where('college', $pendingFormsForecast->college)
            ->first();

        $departmentChairperson = User::where('position', 'Chairperson')
            ->where('department', $pendingFormsForecast->department)
            ->first();

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

        $forecastSection2 = $forecastSection1->forecastSection2s()->firstOrFail();

        $forecastSection3 = $forecastSection1->forecastSection3s()->get();
        
        $forecastSection4 = $forecastSection1->forecastSection4s()->firstOrFail();
        $forecastSection5 = $forecastSection1->forecastSection5s()->firstOrFail();
        $forecastSection6 = $forecastSection1->forecastSection6s()->firstOrFail();
        $forecastSection7 = $forecastSection1->forecastSection7s()->get();

        $forecastSection8 = $forecastSection1->forecastSection8s()->firstOrFail();

        // return view('requesting/forecastpages/savemforecast', compact[
        return view('processing.forecastformApproved', [
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
            'loggedInUser' => $loggedInUser,
            'pendingFormsForecast' => $pendingFormsForecast,
            'collegeDean' => $collegeDean,
            'departmentChairperson' => $departmentChairperson,
            'hrmdoDirectorName' => $hrmdoDirectorName,
            'vpaName' => $vpaName
        ]);
    }
}
