<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AllUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User 1: Super Admin
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $superAdmin = User::create([
            'name' => 'Ehtisham Ali',
            'email' => 'ehtisham@gmail.com',
            'password' => Hash::make('password'), // Change 'password' to the desired password
        ]);
        $superAdmin->assignRole($superAdminRole);

        // User 2: Manager
        $managerRole = Role::where('name', 'Manager')->first();
        $manager = User::create([
            'name' => 'Example Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password'), // Change 'password' to the desired password
        ]);
        $manager->assignRole($managerRole);

        // User 2: Simple User
        $userRole = Role::where('name', 'Simple User')->first();
        $user = User::create([
            'name' => 'Simple User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'), // Change 'password' to the desired password
        ]);
        $user->assignRole($userRole);        
    }
}
