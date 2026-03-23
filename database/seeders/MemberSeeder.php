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
                    'nim' => '1234567890',
                    'password' => Hash::make('password'),
                    'member_type_id' => $mahasiswaType->member_type_id,
                    'name' => 'John Doe Mahasiswa',
                    'gender' => 'L',
                    'faculty' => 'Fakultas Teknik',
                    'study_program' => 'Teknik Informatika',
                    'whatsapp_number' => '081234567890',
                    'address' => 'Jl. Mahasiswa No. 1',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nim' => '0987654321',
                    'password' => Hash::make('password'),
                    'member_type_id' => $dosenType->member_type_id,
                    'name' => 'Jane Doe Dosen',
                    'gender' => 'P',
                    'faculty' => 'Fakultas Ilmu Komputer',
                    'study_program' => 'Sistem Informasi',
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
