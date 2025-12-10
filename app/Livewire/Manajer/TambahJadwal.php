<?php

namespace App\Livewire\Manajer;

use App\Models\Department;
use App\Models\Pegawai;
use App\Models\Shift;
use App\Models\Jadwal;
use App\Models\PengajuanCuti;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Kelola Jadwal Shift')]
class TambahJadwal extends Component
{
    public $tanggal;
    public $department_id = '';
    public $pegawai_id = '';
    public $shift_id = '';
    public $departments;
    public $shifts;
    public $jadwal_baru_count = 0;
    public $total_pegawai_count = 0;

    public function mount() {
        $this->departments = Department::all();
        $this->shifts = Shift::all();
        $this->total_pegawai_count = Pegawai::where('role', 'user')->count();
        $this->jadwal_baru_count = Jadwal::whereDate('created_at', today())->count();
    }

    public function getPegawaiOptionsProperty() {
        if(empty($this->department_id)) {
            return [];
        }

        return Pegawai::where('department_id', $this->department_id)
            ->where('role', 'user')
            ->get();
    }

    public function save() {
        $this->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'department_id' => 'required',
            'pegawai_id' => 'required',
            'shift_id' => 'required',
        ], [
            'tanggal.after_or_equal' => 'Tanggal penugasan minimal hari ini.'
        ]);

        // Validasi hari libur
        $pegawai = Pegawai::find($this->pegawai_id);
        if ($pegawai && $pegawai->hari_libur) {
            $namaHariJadwal = Carbon::parse($this->tanggal)->locale('id')->translatedFormat('l');

        // Cek apakah nama hari ini ada di array hari_libur pegawai
        if (in_array($namaHariJadwal, $pegawai->hari_libur)) {
            $strLibur = implode(' & ', $pegawai->hari_libur);
            $this->addError('pegawai_id', "Pegawai ini libur rutin setiap {$strLibur}. Tidak bisa ditugaskan pada hari {$namaHariJadwal}.");
            return;
        }
    }

        // Validasi cuti
        $isCuti = PengajuanCuti::where('pegawai_id', $this->pegawai_id)
            ->where('status', 'Disetujui')
            ->where(function ($query) {
                $query->whereDate('tanggal_mulai_cuti', '<=', $this->tanggal)
                    ->whereDate('tanggal_selesai_cuti', '>=', $this->tanggal);
            })
            ->exists();

            if($isCuti) {
                $this->addError('pegawai_id', 'Pegawai sedang cuti pada tanggal tersebut dan tidak dapat ditugaskan');
                return;
            }

        Jadwal::create([
            'tanggal' => $this->tanggal,
            'pegawai_id' => $this->pegawai_id,
            'shift_id' => $this->shift_id
        ]);

        $this->reset(['pegawai_id', 'shift_id', 'tanggal']);
        $this->jadwal_baru_count++;
        $this->dispatch('show-toast', message: 'Jadwal berhasil disimpan!');
        $this->dispatch('pg:eventRefresh-jadwalTable');
    }

    public function render()
    {
        return view('livewire.manajer.tambah-jadwal');
    }
}
