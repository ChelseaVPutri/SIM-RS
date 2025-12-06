<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('department')->insert([
            [
                'nama_department' => 'UGD'
            ],
            [
                'nama_department' => 'IGD'
            ],
            [
                'nama_department' => 'ICU'
            ],
            [
                'nama_department' => 'Rawat Inap Lantai 5'
            ],
            [
                'nama_department' => 'Rawat Inap Lantai 6'
            ],
        ]);
    }
}
