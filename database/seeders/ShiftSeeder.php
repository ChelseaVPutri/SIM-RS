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
                'waktu_mulai' => '00:00:00',
                'waktu_selesai' => '08:00:00'
            ],
            [
                'nama_shift' => 'Shift Siang',
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '15:00:00'
            ],
            [
                'nama_shift' => 'Shift Malam',
                'waktu_mulai' => '15:00:00',
                'waktu_selesai' => '00:00:00'
            ],
        ]);
    }
}
