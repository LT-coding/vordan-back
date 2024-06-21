<?php

namespace Database\Seeders\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'manager',
            ],
            [
                'name' => 'accountant',
            ],
            [
                'name' => 'business_admin',
            ],
            [
                'name' => 'business_manager',
            ],
            [
                'name' => 'account',
            ],
        ];

        foreach ($data as $new) {
            Role::create($new);
        }
    }
}
