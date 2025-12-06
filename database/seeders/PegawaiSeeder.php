<?php

namespace Database\Seeders;

use App\Models\Pegawai;
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
        Pegawai::factory()->count(2)->create([
            "role" => "manajer"
        ]);
        
        Pegawai::factory()->count(30)->create([
            "role" => "user"
        ]);
    }
}
