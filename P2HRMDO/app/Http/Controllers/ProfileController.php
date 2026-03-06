<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();

        return view('userrequestingprofile', compact('loggedInUser'));
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Assuming your User model is named 'User'
            $user = User::findOrFail($id);

            // Initialize the $userData array
            $userData = [];

            // Check if a new password is provided
            if ($request->filled('password')) {
                $newPassword = $request->password;
                $userData['password'] = Hash::make($newPassword);
            }

            // Process the user's profile image and store it in the database
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'profile.' . $image->getClientOriginalExtension();
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = 'profile.' . $originalFileName . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
            
                // Delete the existing image if it exists
                if ($user->image) {
                    Storage::delete('public/images/' . $user->image);
                }
            
                // Update the 'image' field in $userData
                $userData['image'] = $imageName;
            } else {
                
            }

            // Update the user's profile data
            $userData = array_merge(
                $userData,
                $request->except(['image', 'password'])
            );

            // Check if the 'image' key exists in $userData
            if (array_key_exists('image', $userData)) {
                // If it exists, update the user's image
                $user->image = $userData['image'];
            }

            $user->update($userData);

            // Update the corresponding employee record based on user ID
            $employee = Employee::where('user_id', $user->id)->first();

            if ($employee) {
                // Check if the 'image' key exists in $userData
                if (array_key_exists('image', $userData)) {
                    // If it exists, update the image in the employee model
                    $employee->image = $userData['image'];
                    $employee->save();
                }
            }

            return redirect()->route('profile.index')->with('success', 'User profile has been updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Print the error message to see what went wrong
            return redirect()->back()->with('msg', 'Failed to update user profile');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function showApprovalProfile() 
    {
        $loggedInUser = Auth::user();
        return view('userapprovalprofile', compact('loggedInUser'));
    }

    public function updateApprovalProfile(Request $request, string $id)
    {
        try {

            // Assuming your User model is named 'User'
            $user = User::findOrFail($id);

            // Initialize the $userData array
            $userData = [];

            // Check if a new password is provided
            if ($request->filled('password')) {
                $newPassword = $request->password;
                $userData['password'] = Hash::make($newPassword);
            }

            // Process the user's profile image and store it in the database
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'profile.' . $image->getClientOriginalExtension();
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = 'profile.' . $originalFileName . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
            
                // Delete the existing image if it exists
                if ($user->image) {
                    Storage::delete('public/images/' . $user->image);
                }
            
                // Update the 'image' field in $userData
                $userData['image'] = $imageName;
            } else {
                
            }

            // Update the user's profile data
            $userData = array_merge(
                $userData,
                $request->except(['image', 'password'])
            );

            $user->update($userData);

            return redirect()->route('showApprovalProfile')->with('success', 'User profile has been updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Print the error message to see what went wrong
            return redirect()->back()->with('msg', 'Failed to update user profile');
        }
    }

    public function showProcessingProfile() 
    {
        $loggedInUser = Auth::user();
        return view('processing.userprocessingprofile', compact('loggedInUser'));
    }

    public function updateProcessingProfile(Request $request, string $id)
    {
        try {

            // Assuming your User model is named 'User'
            $user = User::findOrFail($id);

            // Initialize the $userData array
            $userData = [];

            // Check if a new password is provided
            if ($request->filled('password')) {
                $newPassword = $request->password;
                $userData['password'] = Hash::make($newPassword);
            }

            // Process the user's profile image and store it in the database
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'profile.' . $image->getClientOriginalExtension();
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = 'profile.' . $originalFileName . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
            
                // Delete the existing image if it exists
                if ($user->image) {
                    Storage::delete('public/images/' . $user->image);
                }
            
                // Update the 'image' field in $userData
                $userData['image'] = $imageName;
            } else {
                
            }

            // Update the user's profile data
            $userData = array_merge(
                $userData,
                $request->except(['image', 'password'])
            );

            $user->update($userData);

            return redirect()->route('showProcessingProfile')->with('success', 'User profile has been updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Print the error message to see what went wrong
            return redirect()->back()->with('msg', 'Failed to update user profile');
        }
    }

}
