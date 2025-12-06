<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    protected $Table = 'pengajuan_cuti';

    protected $fillable = [
        'pegawai_id',
        'jenis_cuti',
        'tanggal_mulai_cuti',
        'tanggal_selesai_cuti',
        'alasan_cuti',
        'foto_surat_dokter'
    ];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class);
    }
}
