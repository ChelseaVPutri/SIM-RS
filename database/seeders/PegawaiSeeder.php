<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            'nama_lengkap' => "admin",
            'nip' => '123',
            'password' => Hash::make('123'),
            'role' => 'manajer',
            'department' => 'IGD',
            'sisa_cuti' => 12
        ]);
    }
}
