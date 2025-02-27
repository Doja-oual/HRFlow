<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Employee ' . $i,
                'email' => 'employee' . $i . '@example.com',
                'password' => Hash::make('password123'), // Mot de passe hashé
                'role' => 'employee',
                'employee_id' => 'EMP00' . $i,
                'position' => 'Developer',
                'department' => 'IT',
                'hire_date' => now()->subDays(rand(30, 365)), // Date aléatoire
                'status' => 'active',
                'phone' => '06000000' . $i,
                'address' => '123 Employee Street ' . $i,
                'date_of_birth' => now()->subYears(rand(20, 40))->format('Y-m-d'),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'contract_type' => rand(0, 1) ? 'permanent' : 'contract',
                'profile_picture' => 'profile_pictures/default.png',
            ]);
        }
    }
}
