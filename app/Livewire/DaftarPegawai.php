<?php

namespace App\Livewire;

use App\Models\Pegawai;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Daftar Perawat")]
class DaftarPegawai extends Component
{
    public $total_pegawai_count = 0;
    public $total_pegawai_aktif_count = 0;
    public $total_pegawai_cuti_count = 0;

    public function mount() {
        $this->total_pegawai_count = Pegawai::where('role', 'user')->count();
        $this->total_pegawai_aktif_count = Pegawai::where('role', 'user')->where('status', 'Aktif')->count();
        $this->total_pegawai_cuti_count = Pegawai::where('status', 'Cuti')->count();
    }
    public function render()
    {
        return view('livewire.daftar-pegawai');
    }
}
