<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AllRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin Role
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id')->all(); // Get all permission ids
        $superAdmin->syncPermissions($permissions);

        // Manager Role
        $manager = Role::create(['name' => 'Manager']);
        $managerPermissions = Permission::whereIn('name', [
            'User View',
            'User Edit',
            'User Create',
            'User Delete',
        ])->pluck('id')->all(); // Get permission ids by name
        $manager->syncPermissions($managerPermissions);

        // Simple User Role
        $manager = Role::create(['name' => 'Simple User']);
        $managerPermissions = Permission::whereIn('name', [
            'User View',
        ])->pluck('id')->all(); // Get permission ids by name
        $manager->syncPermissions($managerPermissions);

    }
}
