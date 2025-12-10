<?php

namespace App\Livewire\Manajer;

use App\Models\PengajuanCuti;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Persetujuan Cuti')]
class PersetujuanCuti extends Component
{
    public $total_pending = 0;
    public $total_disetujui = 0;
    public $total_ditolak = 0;

    public function mount() {
        $now = now();

        $this->total_pending = PengajuanCuti::where('status', 'Pending')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $this->total_disetujui = PengajuanCuti::where('status', 'Disetujui')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $this->total_ditolak = PengajuanCuti::where('status', 'Ditolak')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();
    }

    public function render()
    {
        return view('livewire.manajer.persetujuan-cuti');
    }
}
