<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AllPermissionsSeeder::class);
        $this->call(AllRolesSeeder::class);
        $this->call(AllUsersSeeder::class);
    }
}
