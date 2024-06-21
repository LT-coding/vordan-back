<?php

namespace Database\Seeders;

use Database\Seeders\Admin\GeneralAdminSeeder;
use Database\Seeders\RolePermission\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(GeneralAdminSeeder::class);
    }
}
