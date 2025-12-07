<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    protected $table = 'pengajuan_cuti';

    protected $fillable = [
        'pegawai_id',
        'jenis_cuti',
        'tanggal_mulai_cuti',
        'tanggal_selesai_cuti',
        'alasan_cuti',
        'foto_bukti',
        'status',
    ];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class);
    }
}
