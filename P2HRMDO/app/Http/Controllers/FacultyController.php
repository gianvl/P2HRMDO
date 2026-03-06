<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Hash,
    Storage
};
use App\Models\{
    Employee,
    User
};
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FacultyController extends Controller
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

        return view('processing.facultylist.faculty', compact(
            'loggedInUser',
            'collegeList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedInUser = Auth::user();

        $collegeList = DB::table('employees')
            ->select(DB::raw('DISTINCT(`college`)'))
            ->get(); 

        $departmentList = [];

        return view('processing.facultylist.addfaculty', compact(
            'loggedInUser', 
            'collegeList',
            'departmentList'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'prefix' => 'required',
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => [
                'required',
                Rule::unique('employees', 'email')->whereNull('deleted_at')
            ],
            'emp_no' => [
                'required',
                Rule::unique('employees', 'emp_no')->whereNull('deleted_at')
            ],
            'specialization' => 'required',
            'employment_status' => 'required',
            'college' => 'required',
            'department' => 'required',
            'emp_type' => 'required',
            'image' => 'nullable',
            'hired_at' => 'required',
            'resigned_at' => 'nullable',
        ], [
            'email.unique' => 'The email address has already been assigned to another employee.',
            'emp_no.unique' => 'The employee number has already been assigned to another employee.',
            // Add other custom error messages as needed
        ]);
        
        $user = null;
        
        if (
            in_array(
                $request->get('emp_type'), 
                ["Dean", "Chairperson", "Coordinator", "VPA", "HRMDO Director"]
            )
        ) {
            $user = new User;
            $user->name = $request->get('first_name') . " " . $request->get('last_name');
            // $user->name = $request->get('prefix') . " " . $request->get('first_name') . " " . $request->get('last_name');
            $user->email = $request->get('email') ?? strtolower($request->get('first_name') . $request->get('last_name')) . "@adamson.edu.ph";
            $user->username = strtolower($request->get('first_name') . $request->get('last_name'));
            $user->position = $request->get('emp_type');
            $user->college = $request->get('college');
            $user->department = $request->get('department');
            $user->password = Hash::make(strtolower($request->get('first_name') . $request->get('last_name')));
            $user->save();
        
            // Assign roles based on the faculty member's position
            $roleId = 0; // Initialize role ID
        
            switch ($request->get('emp_type')) {
                case "Coordinator":
                    $roleId = 1;
                    break;
                case "Chairperson":
                case "Dean":
                    $roleId = 2;
                    break;
                case "VPA":
                case "HRMDO Director":
                    $roleId = 3;
                    break;
                // Add more cases for other positions if needed
            }
        
            if ($roleId) {
                DB::table('model_has_roles')
                    ->insert([
                        "role_id" => $roleId,
                        "model_type" => 'App\Models\User',
                        "model_id" => $user->id,
                    ]);
            }
        }
        
        // Create a new Employee instance and fill it with the validated data
        $employee = new Employee($validatedData);

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'profile.' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            // Delete the existing chairperson signature image if it exists
            if ($employee->image) {
                Storage::delete('public/images/' . $employee->image);
            }
        } else {
            $imageName = null; // Set the variable to null if no image was uploaded
        }

        if (isset($imageName)) {
            $employee->image = $imageName;
            if ($user) {
                $user->image = $imageName;
                $user->save();
            }
        }
    
        // Save the employee data to the database
        if ($user) {
            $employee->user_id = $user->id;
        }
        
        $employee->save();

        // dd($request);
    
        // Redirect to a relevant route after successful submission
        return redirect()->route('faculty.index')
                         ->with('success', 'Employee added successfully');
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
        $loggedInUser = Auth::user();
        $employee = Employee::find($id);

        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get(); 

        $departmentList = [];

        return view('processing.facultylist.editfaculty', compact(
            'employee', 
            'loggedInUser',
            'collegeList',
            'departmentList'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Retrieve the employee record
        $employee = Employee::findOrFail($id);

        // Retrieve the associated user record
        $user = User::find($employee->user_id);

        // Validate the request data
        $request->validate([
            // 'prefix' => 'required',
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => [
                'required',
                Rule::unique('employees', 'email')->whereNull('deleted_at')->ignore($id),
            ],
            'emp_no' => [
                'required',
                Rule::unique('employees', 'emp_no')->whereNull('deleted_at')->ignore($id),
            ],
            'specialization' => 'required',
            'employment_status' => 'required',
            'college' => 'required',
            'department' => 'required',
            'emp_type' => 'required',
            'hired_at' => 'required',
            'resigned_at' => 'nullable',
        ], [
            'email.unique' => 'The email address has already been assigned to another employee.',
            'emp_no.unique' => 'The employee number has already been assigned to another employee.',
            // Add other custom error messages as needed
        ]);

        try {
            // Check if emp_type is changed
            if ($employee->emp_type !== $request->emp_type) {
                // Delete user record if it exists
                if ($employee->user) {
                    $employee->user->delete();
                }

                // Create a new user if emp_type requires it
                if (in_array($request->emp_type, ["Dean", "Chairperson", "Coordinator", "VPA", "HRMDO Director"])) {
                    $user = new User;
                    $user->name = $request->first_name . ' ' . $request->last_name;
                    // $user->name = $request->prefix . ' ' . $request->first_name . ' ' . $request->last_name;
                    $user->username = strtolower($request->first_name . $request->last_name);
                    $user->email = $request->email;
                    $user->college = $request->college;
                    $user->department = $request->department;
                    $user->position = $request->emp_type;
                    $user->image = $employee->image;
                    $user->password = Hash::make(strtolower($request->first_name . $request->last_name));
                    $user->save();

                    // Assign roles based on the faculty member's position
                    $roleId = 0; // Initialize role ID
                    switch ($request->emp_type) {
                        case "Coordinator":
                            $roleId = 1;
                            break;
                        case "Chairperson":
                        case "Dean":
                            $roleId = 2;
                            break;
                        case "VPA":
                        case "HRMDO Director":
                            $roleId = 3;
                            break;
                    }

                    if ($roleId) {
                        $user->roles()->attach($roleId);
                    }

                    // Update the user_id in the Employee model
                    $employee->user_id = $user->id;
                }
            } 

            // Update all fields from the request in the Employee model
            $employee->update($request->all());

            // Update the employee and user records
            $imageName = $employee->image;

            if ($request->hasFile('image')) {
                // Process the chairperson signature image and store it in the database
                $image = $request->file('image');
                $imageName = 'profile.' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);

                // Delete the existing chairperson signature image if it exists
                if ($employee->image) {
                    Storage::delete('public/images/' . $employee->image);
                }
            }

            // Update the employee record
            $employee->update($request->except(['image']) + ['image' => $imageName]);

            // Update the user record if it exists
            if ($employee->user) {
                $user = $employee->user;
                // $user->name = $request->prefix . ' ' . $request->first_name . ' ' . $request->last_name;
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->username = strtolower($request->first_name . $request->last_name);
                $user->email = $request->email;
                $user->college = $request->college;
                $user->department = $request->department;
                $user->position = $request->emp_type;
                $user->image = $imageName;
                $user->save();

                // Update the role based on the new position
                $roleId = 0; // Initialize role ID
                switch ($request->emp_type) {
                    case "Chairperson":
                    case "Dean":
                        $roleId = 2;
                        break;
                    case "Coordinator":
                        $roleId = 1;
                        break;
                    case "VPA":
                    case "HRMDO Director":
                        $roleId = 3;
                        break;
                }

                // Assign the new role to the user
                if ($roleId) {
                    $user->roles()->sync([$roleId]);
                }
            }

        } catch (QueryException $exception) {
            // Handle unique constraint violation (duplicate username or email)
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) { // MySQL error code for duplicate entry
                $errorMessage = $exception->getMessage();

                // Check if the error message contains information about the unique constraint
                if (str_contains($errorMessage, 'users_email_unique')) {
                    return redirect()->back()->withInput()->withErrors(['email' => 'Cannot create user because email address already exists.']);
                } elseif (str_contains($errorMessage, 'users_username_unique')) {
                    return redirect()->back()->withInput()->withErrors([
                        'first_name' => 'Cannot create user because username already exists. Please change first name or last name.',
                        'last_name' => 'Cannot create user because username already exists. Please change first name or last name.',
                    ]);
                } else {
                    // Handle other unique constraint violations or unknown errors
                    return redirect()->back()->withInput()->withErrors(['withErrors' => 'An error occurred.']);
                }
            }

            // If it's a different type of exception, you may want to handle it accordingly
            return redirect()->back()->withInput()->withErrors(['withErrors' => 'An error occurred.']);
        }

        // Redirect to a relevant route after successful update
        return redirect()->route('faculty.index')->with('msg', 'Faculty has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::find($id);
            $user = null;
            if ($employee->user_id) {
                $user = User::find($employee->user_id);
            }

            $employee->delete();

            if ($user) {
                $user->delete();
            }

            return redirect()->route('faculty.index')->with('msg', 'Faculty member deleted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('msg', 'Faculty member not deleted');
        }
    }

    public function checkEmpNo($empNo)
    {
        // Check if the employee number already exists in the database
        $exists = Employee::where('emp_no', $empNo)->exists();

        // Return a JSON response indicating whether the employee number exists or not
        return response()->json(['exists' => $exists]);
    }

    public function checkEmailInEmployee($email)
    {
        // Check if the email already exists in the database
        $exists = Employee::where('email', $email)->exists();

        // Return a JSON response indicating whether the email exists or not
        return response()->json(['exists' => $exists]);
    }
}
