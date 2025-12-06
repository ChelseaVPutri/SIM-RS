<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'pegawai_id',
        'shift_id'
    ];

    public function shift() {
        return $this->belongsTo(Shift::class);
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class);
    }
}
