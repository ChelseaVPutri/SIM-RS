<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shift';

    protected $fillable = [
        'nama_shift',
        'waktu_mulai',
        'waktu_selesai'
    ];

    public function jadwal() {
        return $this->hasMany(Jadwal::class);
    }
}
