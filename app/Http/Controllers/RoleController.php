<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    protected $permissions = [
        'index' => 'Role View',
        'show' => 'Role View',
        'create' => 'Role Create',
        'store' => 'Role Create',
        'edit' => 'Role Edit',
        'update' => 'Role Edit',
        'destroy' => 'Role Delete',
    ];

    public function __construct()
    {
        foreach ($this->permissions as $method => $permission) {
            $this->middleware(function ($request, $next) use ($permission, $method) {
                if (!$request->user() || !$request->user()->hasPermissionTo($permission)) {
                    abort(403, 'Unauthorized action.');
                }
                return $next($request);
            })->only($method);
        }
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);
    
        try {
            DB::beginTransaction();
    
            $role->update(['name' => $request->name]);
    
            if ($request->permissions) {
                $permissions = Permission::where('guard_name', 'web')->whereIn('id', $request->permissions)->pluck('id')->toArray();
                $role->permissions()->sync($permissions);
            } else {
                $role->permissions()->detach(); // Remove all permissions if none are provided
            }
    
            DB::commit();
    
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the role.');
        }
    }
    
    
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully');
    }
}
