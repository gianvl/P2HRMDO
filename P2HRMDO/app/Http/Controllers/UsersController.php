<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        $loggedInUser = Auth::user();
        return view('processing.usermanagement.index', compact('users', 'loggedInUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $loggedInUser = Auth::user();
        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();

        
        return view('processing.usermanagement.newuser', compact('roles', 'loggedInUser', 'collegeList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['email', 'required', 'unique:users'],
            'username' => ['required', 'min:3'],
            'password' => ['required', 'confirmed', 'min:6'],
            'position' => ['required'],
            'image' => ['required'],
            // Add other validation rules for your form fields
        ]);
    
        // Hash the password
        $hashedPassword = Hash::make($validatedData['password']);
    
        // Create a new User instance and fill it with the validated data
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $hashedPassword,
            'position' => $validatedData['position'],
        ]);

        $roles = $request->input('roles', []);
        $user->assignRole($roles);
        

        // Process the chairperson signature image and store it in the database
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'profile.' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            // Delete the existing chairperson signature image if it exists
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }
        } else {
            $imageName = null; // Set the variable to null if no image was uploaded
        }

        if (isset($imageName)) {
            $user->image = $imageName;
        }
    
        // Save the employee data to the database
        $user->save();
    
        // Redirect to a relevant route after successful submission
        return redirect()->route('users.index')
                         ->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $loggedInUser = Auth::user();
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('processing.usermanagement.showuser', compact('user', 'loggedInUser', 'roles', 'userRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $loggedInUser = Auth::user();
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray(); // Get the roles assigned to the user
        $collegeList = DB::table('employees')
        ->select(DB::raw('DISTINCT(`college`)'))
        ->get();
        $departmentList = [];
        return view('processing.usermanagement.edituser', compact('user', 'loggedInUser', 'roles', 'userRoles', 'collegeList', 'departmentList'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required'],
            'email' => ['email', 'required'],
            'username' => ['required', 'min:3'],
            'position' => ['required'],
        ]);

        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'position' => $request->position,
            ];

            // Check if a new password is provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Get the selected role from the request
            $selectedRole = $request->input('selected_role', null);

            // Ensure that $selectedRole is not null and corresponds to a valid role
            $roles = Role::pluck('name')->toArray(); // Assuming you have a Role model
            if ($selectedRole && in_array($selectedRole, $roles)) {
                $user->syncRoles([$selectedRole]); // Sync the selected role with the user
            } else {
                // Handle the case where no role is selected or an invalid role is submitted
                // You can add appropriate error handling or fallback logic here
            }

            // Process image and store it in the database
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'profile.' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                // Delete the existing chairperson signature image if it exists
                if ($user->image) {
                    Storage::delete('public/images/' . $user->image);
                }
            } else {
                $imageName = $user->image; // Retrieve the existing image path
            }

            $user->update($request->except(['image', 'password']) + [
                'image' => $imageName,
            ]);

            return redirect()->route('users.index')->with('msg', 'User has been updated successfully.');

        } catch (\Exception $e) {
            dd($e->getMessage()); // Print the error message to see what went wrong
            return redirect()->back()->with('msg', 'Failed to update user.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect()->route('users.index')->with('msg', 'User deleted successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('msg', 'User not deleted');
        }

    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'exists:roles,name'],
        ]);
    
        $role = Role::where('name', $request->role)->firstOrFail();
    
        if ($user->hasRole($role)) {
            return back()->with('msg', 'User already has the selected role');
        }
    
        $user->assignRole($role);
    
        return back()->with('msg', 'Role assigned successfully');

        
    }

    
    public function removeRole(User $user, Role $role)
    {
    if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('msg', 'Role removed successfully');
        }

    return back()->with('msg', 'User does not have the selected role');
    }
    
}
