<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'nullable|array',
        ]);
    
        $user = User::create($request->only('name', 'email', 'password'));
        
        // Assign roles by ID
        if ($request->roles) {
            foreach ($request->roles as $roleId) {
                $role = Role::find($roleId);
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }
    
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }
    

    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'roles' => 'nullable|array',
        ]);
    
        // Update user attributes except password
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }
    
        // Sync roles
        if ($request->roles) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->syncRoles($roles);
        } else {
            // If no roles are provided, remove all existing roles
            $user->syncRoles([]);
        }
    
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }
    

    
    

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
