<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Pegawai extends Authenticatable
{
    use HasFactory;

    protected $table = "pegawai";
    
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'nomor_telepon',
        'password',
        'department_id',
        'hari_libur',
        'status',
        'sisa_cuti',
        'role'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
        'hari_libur' => 'array',
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
