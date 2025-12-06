<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";

    protected $fillable = [
        'nama_deparment'
    ];

    public function pegawai() {
        return $this->hasMany(Pegawai::class);
    }
}
