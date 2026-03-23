<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member_types')->insert([
            [
                'name' => 'mahasiswa',
                'loan_limit' => 1,
                'loan_duration' => 7, // 1 minggu = 7 hari
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dosen',
                'loan_limit' => 5,
                'loan_duration' => 180, // 1 semester sekitar 180 hari (atau 6 bulan)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
