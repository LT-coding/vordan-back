<?php

namespace Database\Seeders\Admin;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GeneralAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'email' => 'admin@gmail.com',
            'phone' => '+37400000000',
            'password' => Hash::make('password')
        ]);
        $user->adminAccount()->create(['name' => 'Admin']);
        $user->assignRole('admin');
    }
}
