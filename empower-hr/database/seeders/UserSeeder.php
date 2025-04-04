<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => 'System Administrator',
        ]);

        User::create([
            'username'     => 'HR Manager',
            'email'    => 'hr@example.com',
            'password' => Hash::make('password'),
            'role'     => 'HR Manager',
        ]);

        User::create([
            'username'     => 'Dept Manager',
            'email'    => 'manager@example.com',
            'password' => Hash::make('password'),
            'role'     => 'Department Manager',
        ]);

        User::create([
            'username'     => 'Employee One',
            'email'    => 'employee1@example.com',
            'password' => Hash::make('password'),
            'role'     => 'Employee',
        ]);
    }
}
