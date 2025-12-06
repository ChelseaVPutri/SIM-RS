<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shift')->insert([
            [
                'nama_shift' => 'Shift Pagi',
                // 'waktu_mulai' => ''
            ]
        ]);
    }
}
