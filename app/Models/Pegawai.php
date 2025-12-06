<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Pegawai extends Authenticatable
{
    protected $table = "pegawai";
    
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'password',
        'role'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function getAuthIdentifierName()
    {
        return 'nip';
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function jadwal() {
        return $this->hasMany(Jadwal::class);
    }

    public function pengajuanCuti() {
        return $this->hasMany(PengajuanCuti::class);
    }
    
}
