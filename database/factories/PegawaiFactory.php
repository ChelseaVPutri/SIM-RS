<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = $this->faker->randomElement([
            '0812', '0813', '0858'
        ]);

        return [
            'nama_lengkap' => $this->faker->name(),
            'nip' => str_pad($this->faker->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'nomor_telepon' => $prefix . $this->faker->numerify('########'),
            'department_id' => Department::inRandomOrder()->first()->id,
            'sisa_cuti' => 12,
            'password' => Hash::make('123'),
            'status' => 'aktif', 
            'role' => 'user'
        ];
    }

    public function manajer() {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'manajer'
            ];
        }); 
    }
}
