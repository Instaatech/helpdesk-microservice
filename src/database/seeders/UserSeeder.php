<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an user 
        User::create([
            'name' => 'Test User',
            'email' => 'user@yopmail.com',
            'role' => 1,
            'password' => Hash::make('User@123')
        ]);

        // create an employee 
        User::create([
            'name' => 'Test Employee 1',
            'email' => 'employee1@yopmail.com',
            'role' => 2,
            'category_id' => 1,
            'password' => Hash::make('Employee@123')
        ]);

        User::create([
            'name' => 'Test Employee 2',
            'email' => 'employee2@yopmail.com',
            'role' => 2,
            'category_id' => 2,
            'password' => Hash::make('Employee@123')
        ]);

        User::create([
            'name' => 'Test Employee 3',
            'email' => 'employee3@yopmail.com',
            'role' => 2,
            'category_id' => 3,
            'password' => Hash::make('Employee@123')
        ]);
    }
}
