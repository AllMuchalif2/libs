<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pustakawan1',
                'name' => 'Staff Pustakawan',
                'email' => 'pustakawan@example.com',
                'password' => Hash::make('password'),
                'role' => 'pustakawan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
