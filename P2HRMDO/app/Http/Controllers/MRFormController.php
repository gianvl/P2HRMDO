<?php

namespace App\Http\Controllers;

use App\Mail\HRMDODirectorNewMRRequestMail;
use App\Mail\VPANewMRRequestMail;
use App\Models\{
    Employee,
    EvalPage,
    Manpower,
    ManpowerApproval,
    ManpowerProcessing,
    PositionFormMapping,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Mail,
    Storage
};

class MRFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();
        
        $department = $loggedInUser->department;
        $college = $loggedInUser->college;

        $mrform = collect(); // Initialize an empty collection

        if ($loggedInUser->position === 'Dean') {
            // If the user is a Dean, filter forms by college
            $college = $loggedInUser->college;
            $mrform = Manpower::where('college', $college)
                ->orderBy('mrNum', 'DESC')
                ->get();
        } elseif ($loggedInUser->position === 'Chairperson') {
            // If the user is a Chairperson, filter forms by department
            $mrform = Manpower::where('department', $department)
                ->orderBy('mrNum', 'DESC')
                ->get();
        }

        return view('requesting.index', compact('mrform', 'loggedInUser', 'department', 'college'));
    }
 
    /**
     * Show the form for creating a new resource.
     */

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

        $positionFormMapping = PositionFormMapping::where('position', $loggedInUser->position)
            ->where('department', $loggedInUser->department)
            ->first();

        $employeeIds = [];
        if (Auth::user()->position == "Chairperson") {
            $employeeIds = Employee::where('department', Auth::user()->department)
                ->get()
                ->pluck("id");
        } else if (Auth::user()->position == "Dean") {
            $employeeIds = Employee::where('college', $deanCollege)
                ->get()
                ->pluck("id");
        }

        $evalPages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
            ->select([
                "e.first_name",
                "e.last_name",
                "eval_pages.*"
            ])
            ->rightJoin(DB::raw('
                    (SELECT 
                        MAX(id) as id,
                        employee_id
                    FROM 
                        eval_pages 
                    GROUP BY
                        employee_id
                    ) as sub_table
                '), 
                function($join) {
                    $join->on('eval_pages.id', '=', 'sub_table.id');
                })
            ->rightJoin('employees as e', 
            function($join) {
                $join->on('e.id', '=', 'eval_pages.employee_id');
            })
            ->get();

        return view('requesting.mrpages.inputmrform', compact(
            'deanUser',
            'deanCollege',
            'loggedInUser', 
            'loggedInUserPosition',
            'positionFormMapping',
            'evalPages'
        ));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $approvalStatus = $request->merge(['approval_status' => 'Pending']);

        $mrform = Manpower::create($request->all());

        // Process the file input and store it in the database
        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');
            $filePath = $file->store('uploads', 'public'); // Store the file and get the path
            $mrform->fileInput = $filePath; // Assign the file path to the 'file_path' column
        }

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignature = $request->file('chairsignature');
            $chairsignaturePath = $chairsignature->store('images', 'public');
            $mrform->chairsignature = $chairsignaturePath;
        } else {
            $chairsignaturePath = null; // Set the variable to null if no image was uploaded
        }
    
        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignature = $request->file('deansignature');
            $deansignaturePath= $deansignature->store('images', 'public');
            $mrform->deansignature = $deansignaturePath;
        } else {
            $deansignaturePath = null; // Set the variable to null if no image was uploaded
        }

        $mrform->save();
        
        // Create a new ManpowerApproval record if the approval status is "Waiting for Approval"
        if ($request->input('approval_status') === 'Waiting for Approval') {

            // Create a new ManpowerApproval instance
            $mrformApproval = new ManpowerApproval;
            $mrformApproval->mrNum = $request->input('mrNum');
            $mrformApproval->college = $request->input('college');
            $mrformApproval->department = $request->input('department');
            $mrformApproval->ay = $request->input('ay');
            $mrformApproval->semester = $request->input('semester');
            $mrformApproval->num_emp_required = $request->input('num_emp_required');
            $mrformApproval->employment_status = $request->input('employment_status');
            $mrformApproval->position = $request->input('position');
            $mrformApproval->category = $request->input('category');
            $mrformApproval->category_textbox = $request->input('category_textbox');
            $mrformApproval->replacement_dropdown = $request->input('replacement_dropdown');
            $mrformApproval->replacement_others_textbox = $request->input('replacement_others_textbox');
            $mrformApproval->budget = $request->input('budget');
            $mrformApproval->expertise_textbox = $request->input('expertise_textbox');
            $mrformApproval->regular = $request->input('regular');
            $mrformApproval->probationary = $request->input('probationary');
            $mrformApproval->contractual = $request->input('contractual');
            $mrformApproval->studassistant = $request->input('studassistant');
            $mrformApproval->total = $request->input('total');
            $mrformApproval->approval_status = $request->input('approval_status');
            $mrformApproval->save();
        }

        // Create a new ManpowerProcessing record if the approval status is "Approved"
        if ($approvalStatus === 'Approved') {

            $processingForm = new ManpowerProcessing;
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
            $processingForm->approval_status = $mrform->approval_status;
            $processingForm->chairsignature = $mrform->chairsignature;
            $processingForm->deansignature = $mrform->deansignature;
            $processingForm->vpasignature = $mrform->vpasignature;
            $processingForm->directorsignature = $mrform->directorsignature;
            $processingForm->save();
        }

        return redirect()->route('requestingdashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $mrNum)
    {
        $loggedInUser = Auth::user();

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

        $mrform = Manpower::where('mrNum', $mrNum)->firstOrFail();
 
        return view('requesting.mrpages.showmrform', compact(
            'mrform', 
            'deanUser',
            'deanCollege',
            'loggedInUser'
        ));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $mrNum)
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

        $mrform = Manpower::where('mrNum', $mrNum)->firstOrFail();

        $positionFormMapping = PositionFormMapping::where('position', $loggedInUser->position)
        ->where('department', $loggedInUser->department)
        ->first();

        $employeeIds = [];
        if (Auth::user()->position == "Chairperson") {
            $employeeIds = Employee::where('department', Auth::user()->department)
                ->get()
                ->pluck("id");
        } else if (Auth::user()->position == "Dean") {
            $employeeIds = Employee::where('college', $deanCollege)
                ->get()
                ->pluck("id");
        }

        $evalPages = EvalPage::whereIn('eval_pages.employee_id', $employeeIds)
            ->select([
                "e.first_name",
                "e.last_name",
                "eval_pages.*"
            ])
            ->rightJoin(DB::raw('
                    (SELECT 
                        MAX(id) as id,
                        employee_id
                    FROM 
                        eval_pages 
                    GROUP BY
                        employee_id
                    ) as sub_table
                '), 
                function($join) {
                    $join->on('eval_pages.id', '=', 'sub_table.id');
                })
            ->rightJoin('employees as e', 
            function($join) {
                $join->on('e.id', '=', 'eval_pages.employee_id');
            })
            ->get();
 
        return view('requesting.mrpages.editmrform', compact(
            'mrform', 
            'deanUser',
            'deanCollege',
            'loggedInUser', 
            'loggedInUserPosition',
            'positionFormMapping',
            'evalPages'
        ));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $mrNum)
    {
        // dd($request);
        $mrform = Manpower::where('mrNum', $mrNum)->firstOrFail();

        // Process the file input and store it in the database
        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');
            $filePath = $file->store('uploads', 'public');
            // Delete the existing file input if it exists
            if ($mrform->fileInput) {
                Storage::delete('public/' . $mrform->fileInput);
            }
            $mrform->fileInput = $filePath;
        }

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('chairsignature')) {
            $chairsignatureFile = $request->file('chairsignature');
            $chairsignaturePath = $chairsignatureFile->store('images', 'public');
            // Delete the existing chairperson signature image if it exists
            if ($mrform->chairsignature) {
                Storage::delete('public/' . $mrform->chairsignature);
            }
            $mrform->chairsignature = $chairsignaturePath; // Retrieve the existing image path
        }

        // Process the dean signature image and store it in the database
        if ($request->hasFile('deansignature')) {
            $deansignatureFile = $request->file('deansignature');
            $deansignaturePath = $deansignatureFile->store('images', 'public');
            // Delete the existing dean signature image if it exists
            if ($mrform->deansignature) {
                Storage::delete('public/' . $mrform->deansignature);
            }
            $mrform->deansignature = $deansignaturePath; // Retrieve the existing image path
        }
       
        // Update the columns only if they have been changed
        $updatedData = [
            'college' => $request->input('college'),
            'department' => $request->input('department'),
            'ay' => $request->input('ay'),
            'semester' => $request->input('semester'),
            'num_emp_required' => $request->input('num_emp_required'),
            'employment_status' => $request->input('employment_status'),
            'position' => $request->input('position'),
            'category' => $request->input('category'),
            'category_textbox' => $request->input('category_textbox'),
            'replacement_dropdown' => $request->input('replacement_dropdown'),
            'replacement_others_textbox' => $request->input('replacement_others_textbox'),
            'budget' => $request->input('budget'),
            'expertise_textbox' => $request->input('expertise_textbox'),
            'regular' => $request->input('regular'),
            'probationary' => $request->input('probationary'),
            'contractual' => $request->input('contractual'),
            'studassistant' => $request->input('studassistant'),
            'total' => $request->input('total'),
        ];

        $mrform->update($updatedData);

        return redirect()->route('requestingdashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $mrNum)
    {
        $mrform = Manpower::where('mrNum', $mrNum)->firstOrFail();
 
        $mrform->delete();
 
        return redirect()->route('requestingdashboard.index');
    }

    /**
     * Send the manpower request for approval.
     */
    public function sendForApproval($mrNum)
    {
        $mrformFind = Manpower::find($mrNum);
        if ($mrformFind) {
            if(
                !$mrformFind->chairsignature ||
                !$mrformFind->deansignature
            ) {
                return redirect()->route('requestingdashboard.index', $mrNum)
                    ->with('error', 'Please attach the chairperson and dean signature before submitting the form.');
            }
        }

        $mrform = Manpower::findOrFail($mrNum);

        // Retrieve the email addresses of users with the position "VPA"
        $vpaEmail = User::where('position', 'VPA')->value('email');

        // Retrieve the email addresses of users with the position "HRMDO Director"
        $hrmdoDirectorEmail = User::where('position', 'HRMDO Director')->value('email');


        // Send approval emails to the Dean and Chairperson if their emails are found
        if ($vpaEmail) {
            Mail::to($vpaEmail)->send(new VPANewMRRequestMail($mrform));
        }
    
        if ($hrmdoDirectorEmail) {
            Mail::to($hrmdoDirectorEmail)->send(new HRMDODirectorNewMRRequestMail($mrform));
        }

        // find the manpower record based on the $id parameter
        $mrform = Manpower::where('mrNum', $mrNum)->firstOrFail();
        
        // update the approval status to "Waiting for Approval"
        $mrform->approval_status = "Waiting for Approval";
        $mrform->daterequested = now();
        $mrform->save();

        // create a new ManpowerApproval record
        $mrformApproval = new ManpowerApproval;
        $mrformApproval->mrNum = $mrform->mrNum;
        $mrformApproval->college = $mrform->college;
        $mrformApproval->department = $mrform->department;
        $mrformApproval->ay = $mrform->ay;
        $mrformApproval->semester = $mrform->semester;
        $mrformApproval->num_emp_required = $mrform->num_emp_required;
        $mrformApproval->employment_status = $mrform->employment_status;
        $mrformApproval->position = $mrform->position;
        $mrformApproval->category = $mrform->category;
        $mrformApproval->category_textbox = $mrform->category_textbox;
        $mrformApproval->replacement_dropdown = $mrform->replacement_dropdown;
        $mrformApproval->replacement_others_textbox = $mrform->replacement_others_textbox;
        $mrformApproval->budget = $mrform->budget;
        $mrformApproval->fileInput = $mrform->fileInput;
        $mrformApproval->expertise_textbox = $mrform->expertise_textbox;
        $mrformApproval->regular = $mrform->regular;
        $mrformApproval->probationary = $mrform->probationary;
        $mrformApproval->contractual = $mrform->contractual;
        $mrformApproval->studassistant = $mrform->studassistant;
        $mrformApproval->total = $mrform->total;
        $mrformApproval->approval_status = "Waiting for Approval";
        $mrformApproval->chairsignature = $mrform->chairsignature;
        $mrformApproval->deansignature = $mrform->deansignature;
        $mrformApproval->daterequested = $mrform->daterequested;
        $mrformApproval->save();

        return redirect()->route('requestingdashboard.index');
    }
    
    public function getDepartments($college)
    {
        $department = [];

        if ($college === 'science') {
            $department = ['Information Technology', 'Computer Science', 'Physics', 'Chemistry', 'Biology'];
        } elseif ($college === 'engineering') {
            $department = ['Mechanical', 'Electrical', 'Civil'];
        } elseif ($college === 'architecture') {
            $department = ['Architecture', 'Interior Design'];
        }

        return response()->json($department);
    }

}


