<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaType = DB::table('member_types')->where('name', 'mahasiswa')->first();
        $dosenType = DB::table('member_types')->where('name', 'dosen')->first();

        if ($mahasiswaType && $dosenType) {
            DB::table('members')->insert([
                [
                    'member_code' => '22.220.0022',
                    'password' => Hash::make('password'),
                    'member_type_id' => $mahasiswaType->member_type_id,
                    'name' => 'John Doe Mahasiswa',
                    'gender' => 'L',
                    'faculty' => 'Fakultas Teknologi Informasi (FTI)',
                    'study_program' => 'S1 Teknik Informatika',
                    'whatsapp_number' => '081234567890',
                    'address' => 'Jl. Mahasiswa No. 1',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'member_code' => 'JANE DOE',
                    'password' => Hash::make('password'),
                    'member_type_id' => $dosenType->member_type_id,
                    'name' => 'Jane Doe Dosen',
                    'gender' => 'P',
                    'faculty' => 'Fakultas Teknologi Informasi (FTI)',
                    'study_program' => 'S1 Teknik Informatika',
                    'whatsapp_number' => '080987654321',
                    'address' => 'Jl. Dosen No. 2',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
