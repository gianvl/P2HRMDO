<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('processing.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('processing.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' =>'required']);
        Permission::create($validated);

        return to_route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('processing.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' =>'required']);
        $permission->update($validated);

        return to_route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if($permission->hasRole($request->role)){
            return back();
        }

        $permission->assignRole($request->role);
        return back();
    }

    
    public function removeRole(Permission $permission, Role $role)
    {
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back();
        }
    }
}
