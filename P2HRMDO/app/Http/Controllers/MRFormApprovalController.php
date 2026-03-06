<?php

namespace App\Http\Controllers;

use App\Mail\ChairpersonApprovalForecastMail;
use App\Mail\ChairpersonApprovalMail;
use App\Mail\ChairpersonDisapprovalForecastMail;
use App\Mail\ChairpersonDisapprovalMail;
use App\Mail\DeanApprovalForecastMail;
use App\Mail\DeanApprovalMail;
use App\Mail\DeanDisapprovalForecastMail;
use App\Mail\DeanDisapprovalMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\ForecastSection1;
use App\Models\Manpower;
use App\Models\ManpowerApproval;
use App\Models\ManpowerProcessing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MRFormApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        $pendingForms = ManpowerApproval::orderBy('created_at', 'DESC')
            ->get();

        $validApprovalStatuses = ['Waiting for Approval', 'Approved', 'Disapproved'];

        $forecastSection1 = ForecastSection1::orderBy('created_at', 'DESC')
            ->whereIn('approval_status', $validApprovalStatuses)
            ->get();

        return view('approval.index', compact('pendingForms', 'loggedInUser', 'forecastSection1', 'loggedInUserPosition'));
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
    public function show(string $mrNumApproved)
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;
        
        $pendingForms = ManpowerApproval::findOrFail($mrNumApproved);
        $mrForm = $pendingForms->mrform;

        $vpaName = User::where('position', 'VPA')->value('name');
        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');

        // Retrieve the employees based on college and department
        $collegeDean = User::where('position', 'Dean')
            ->where('college', $pendingForms->college)
            ->first();

        $departmentChairperson = User::where('position', 'Chairperson')
            ->where('department', $pendingForms->department)
            ->first();

        return view('approval.attachsignmrform', compact('mrForm', 'pendingForms', 'collegeDean', 'departmentChairperson', 'hrmdoDirectorName', 'vpaName', 'loggedInUser', 'loggedInUserPosition'));
    }    

    public function show2(string $mrNumApproved)
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        $pendingForms = ManpowerApproval::findOrFail($mrNumApproved);
        $mrForm = $pendingForms->mrform;

        $vpaName = User::where('position', 'VPA')->value('name');
        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');

        // Retrieve the employees based on college and department
        $collegeDean = User::where('position', 'Dean')
            ->where('college', $pendingForms->college)
            ->first();

        $departmentChairperson = User::where('position', 'Chairperson')
            ->where('department', $pendingForms->department)
            ->first();
        
        return view('approval.approvemrform', compact('mrForm', 'pendingForms', 'collegeDean', 'departmentChairperson', 'hrmdoDirectorName', 'vpaName', 'loggedInUser', 'loggedInUserPosition'));
    }   

    public function show3(string $forecast_num_id)
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        $department = $loggedInUser->department;

        $pendingFormsForecast = ForecastSection1::findOrFail($forecast_num_id);

        $vpaName = User::where('position', 'VPA')->value('name');
        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');

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
        return view('approval.attachsignforecastform', [
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
            'loggedInUserPosition' => $loggedInUserPosition,
            'pendingFormsForecast' => $pendingFormsForecast,
            'collegeDean' => $collegeDean,
            'departmentChairperson' => $departmentChairperson,
            'hrmdoDirectorName' => $hrmdoDirectorName,
            'vpaName' => $vpaName
        ]);

    }   

    public function show4(string $forecast_num_id)
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;
        
        $department = $loggedInUser->department;

        $pendingFormsForecast = ForecastSection1::findOrFail($forecast_num_id);

        $vpaName = User::where('position', 'VPA')->value('name');
        $hrmdoDirectorName = User::where('position', 'HRMDO Director')->value('name');

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
        return view('approval.approveforecastform', [
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
            'loggedInUserPosition' => $loggedInUserPosition,
            'pendingFormsForecast' => $pendingFormsForecast,
            'collegeDean' => $collegeDean,
            'departmentChairperson' => $departmentChairperson,
            'hrmdoDirectorName' => $hrmdoDirectorName,
            'vpaName' => $vpaName
        ]);

    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $mrNumApproved)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $mrNumApproved)
    {
        $loggedInUser = Auth::user();

        $loggedInUserPosition = $loggedInUser->position;

        $pendingForms = ManpowerApproval::where('mrNumApproved', $mrNumApproved)->firstOrFail();

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignature = $request->file('chairsignature');
            $chairsignaturePath = $chairsignature->store('images', 'public');
            $pendingForms->chairsignature = $chairsignaturePath;
        } else {
            $chairsignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignature = $request->file('deansignature');
            $deansignaturePath= $deansignature->store('images', 'public');
            $pendingForms->deansignature = $deansignaturePath;
        } else {
            $deansignaturePath = null; // Set the variable to null if no image was uploaded
        }

        // Process the vpa signature image and store it in the database
        if ($request->hasFile('vpasignature')) {
            $vpasignature = $request->file('vpasignature');
            $vpasignaturePath = $vpasignature->store('images', 'public');
            $pendingForms->vpasignature = $vpasignaturePath;
        } else {
            $vpasignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the director signature image and store it in the database
        if ($request->hasFile('directorsignature')) {
            $directorsignature = $request->file('directorsignature');
            $directorsignaturePath= $directorsignature->store('images', 'public');
            $pendingForms->directorsignature = $directorsignaturePath;
        } else {
            $directorsignaturePath = null; // Set the variable to null if no image was uploaded
        }

        $pendingForms->save();

        return redirect()->route('approvaldashboard.index', compact('loggedInUser', 'loggedInUserPosition'));
    }

    public function updateForecastForm(Request $request, string $forecast_num_id) 
    {
        $pendingFormsForecast = ForecastSection1::where('forecast_num_id', $forecast_num_id)->firstOrFail();

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignature = $request->file('chairsignature');
            $chairsignaturePath = $chairsignature->store('images', 'public');
            $pendingFormsForecast->chairsignature = $chairsignaturePath;
        } else {
            $chairsignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignature = $request->file('deansignature');
            $deansignaturePath= $deansignature->store('images', 'public');
            $pendingFormsForecast->deansignature = $deansignaturePath;
        } else {
            $deansignaturePath = null; // Set the variable to null if no image was uploaded
        }

        // Process the vpa signature image and store it in the database
        if ($request->hasFile('vpasignature')) {
            $vpasignature = $request->file('vpasignature');
            $vpasignaturePath = $vpasignature->store('images', 'public');
            $pendingFormsForecast->vpasignature = $vpasignaturePath;
        } else {
            $vpasignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the director signature image and store it in the database
        if ($request->hasFile('directorsignature')) {
            $directorsignature = $request->file('directorsignature');
            $directorsignaturePath= $directorsignature->store('images', 'public');
            $pendingFormsForecast->directorsignature = $directorsignaturePath;
        } else {
            $directorsignaturePath = null; // Set the variable to null if no image was uploaded
        }

        $pendingFormsForecast->save();

        return redirect()->route('approvaldashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $mrNumApproved)
    {
        //
    }

    public function approve($mrNumApproved)
    {
        $mrformFind = ManpowerApproval::find($mrNumApproved);
        if ($mrformFind) {
            if(
                !$mrformFind->directorsignature ||
                !$mrformFind->vpasignature
            ) {
                return redirect()->route('approvaldashboard.show2', ['mrNumApproved' => $mrNumApproved])
                    ->with('error', 'Please attach the director and vpa signature before submitting the form.');
            }
        }

        $mrform = ManpowerApproval::findOrFail($mrNumApproved);

        //Retrieve the Dean and Chairperson emails based on college and department
        $deanEmail = User::where('college', $mrform->college)
            ->where('position', 'Dean')
            ->value('email');

        $chairpersonEmail = User::where('department', $mrform->department)
            ->where('position', 'Chairperson')
            ->value('email');

        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($deanEmail) {
            Mail::to($deanEmail)->send(new DeanApprovalMail($mrform));
        }

        if ($chairpersonEmail) {
            Mail::to($chairpersonEmail)->send(new ChairpersonApprovalMail($mrform));
        }

        $mrform = ManpowerApproval::findOrFail($mrNumApproved);
        $mrform->approval_status = "Approved";
        $mrform->dateapproved = now(); // Set the approval date and time
        $mrform->save();

        // Find the corresponding requesting form and update its status
        $mrformRequesting = Manpower::where('mrNum', $mrform->mrNum)->firstOrFail();
        $mrformRequesting->approval_status = "Approved";
        $mrformRequesting->save();  

        // Create a new ManpowerProcessing record
        $processingForm = new ManpowerProcessing();
        $processingForm->mrNum = $mrform->mrNum;
        $processingForm->college = $mrform->college;
        $processingForm->department = $mrform->department;
        $processingForm->ay = $mrform->ay;
        $processingForm->semester = $mrform->semester;
        $processingForm->num_emp_required = $mrform->num_emp_required;
        $processingForm->employment_status = $mrform->employment_status;
        $processingForm->position = $mrform->position;
        $processingForm->category = $mrform->category;
        $processingForm->category_textbox = $mrform->category_textbox;
        $processingForm->replacement_dropdown = $mrform->replacement_dropdown;
        $processingForm->replacement_others_textbox = $mrform->replacement_others_textbox;
        $processingForm->budget = $mrform->budget;
        $processingForm->fileInput = $mrform->fileInput;
        $processingForm->expertise_textbox = $mrform->expertise_textbox;
        $processingForm->regular = $mrform->regular;
        $processingForm->probationary = $mrform->probationary;
        $processingForm->contractual = $mrform->contractual;
        $processingForm->studassistant = $mrform->studassistant;
        $processingForm->total = $mrform->total;
        $processingForm->approval_status = "Unread";
        $processingForm->chairsignature = $mrform->chairsignature;
        $processingForm->deansignature = $mrform->deansignature;
        $processingForm->vpasignature = $mrform->vpasignature;
        $processingForm->directorsignature = $mrform->directorsignature;
        $processingForm->daterequested = $mrform->daterequested;
        $processingForm->dateapproved = $mrform->dateapproved;
        $processingForm->datereceived = $mrform->dateapproved;
        $processingForm->save();

        return redirect()->route('approvaldashboard.index');
    }

    public function disapprove($mrNumDisapproved)
    {
        $mrformFind = ManpowerApproval::find($mrNumDisapproved);
        if ($mrformFind) {
            if(
                !$mrformFind->directorsignature ||
                !$mrformFind->vpasignature
            ) {
                return redirect()->route('approvaldashboard.show2', ['mrNumApproved' => $mrNumDisapproved])
                    ->with('error', 'Please attach the director and vpa signature before submitting the form.');
            }
        }

        $mrform = ManpowerApproval::findOrFail($mrNumDisapproved);

        //Retrieve the Dean and Chairperson emails based on college and department
            $deanEmail = User::where('college', $mrform->college)
            ->where('position', 'Dean')
            ->value('email');

        $chairpersonEmail = User::where('department', $mrform->department)
            ->where('position', 'Chairperson')
            ->value('email');

        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($deanEmail) {
            Mail::to($deanEmail)->send(new DeanDisapprovalMail($mrform));
        }

        if ($chairpersonEmail) {
            Mail::to($chairpersonEmail)->send(new ChairpersonDisapprovalMail($mrform));
        }

        $mrform = ManpowerApproval::findOrFail($mrNumDisapproved);
        
        $mrform->approval_status = "Disapproved";
        $mrform->dateapproved = now();
        $mrform->save();

        // Find the corresponding requesting form and update its status
        $mrformRequesting = Manpower::where('mrNum', $mrform->mrNum)->firstOrFail();
        $mrformRequesting->approval_status = "Disapproved";
        $mrformRequesting->save();  

        return redirect()->route('approvaldashboard.index');
    }

    public function approveForecastForm($fs1)
    {
        $forecastformFind = ForecastSection1::find($fs1);
        if ($forecastformFind) {
            if(
                !$forecastformFind->directorsignature ||
                !$forecastformFind->vpasignature
            ) {
                return redirect()->route('approvaldashboard.show4', ['forecast_num_id' => $fs1])
                    ->with('error', 'Please attach the director and vpa signature before submitting the form.');
            }
        }

        $forecastSection1 = ForecastSection1::find($fs1);

        //Retrieve the Dean and Chairperson emails based on college and department
        $deanEmail = User::where('college', $forecastSection1->college)
            ->where('position', 'Dean')
            ->value('email');

        $chairpersonEmail = User::where('department', $forecastSection1->department)
            ->where('position', 'Chairperson')
            ->value('email');

        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($deanEmail) {
            Mail::to($deanEmail)->send(new DeanApprovalForecastMail($forecastSection1));
        }

        if ($chairpersonEmail) {
            Mail::to($chairpersonEmail)->send(new ChairpersonApprovalForecastMail($forecastSection1));
        }

        $forecastSection1 = ForecastSection1::find($fs1);
        if ($forecastSection1) {
            $forecastSection1->approval_status = "Approved";
            $forecastSection1->save();
        }

        return redirect()->route('approvaldashboard.index');
    }

    public function disapproveForecastForm($fs1)
    {

        $forecastformFind = ForecastSection1::find($fs1);
        if ($forecastformFind) {
            if(
                !$forecastformFind->directorsignature ||
                !$forecastformFind->vpasignature
            ) {
                return redirect()->route('approvaldashboard.show4', ['forecast_num_id' => $fs1])
                    ->with('error', 'Please attach the director and vpa signature before submitting the form.');
            }
        }

        $forecastSection1 = ForecastSection1::find($fs1);

        //Retrieve the Dean and Chairperson emails based on college and department
            $deanEmail = User::where('college', $forecastSection1->college)
            ->where('position', 'Dean')
            ->value('email');

        $chairpersonEmail = User::where('department', $forecastSection1->department)
            ->where('position', 'Chairperson')
            ->value('email');

        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($deanEmail) {
            Mail::to($deanEmail)->send(new DeanDisapprovalForecastMail($forecastSection1));
        }

        if ($chairpersonEmail) {
            Mail::to($chairpersonEmail)->send(new ChairpersonDisapprovalForecastMail($forecastSection1));
        }

        $forecastSection1 = ForecastSection1::find($fs1);
        if ($forecastSection1) {
            $forecastSection1->approval_status = "Disapproved";
            $forecastSection1->save();
        }

        return redirect()->route('approvaldashboard.index');
    }

}
