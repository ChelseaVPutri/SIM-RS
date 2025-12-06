<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Pegawai;
use App\Models\Shift;
use App\Models\Jadwal;
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

        return Pegawai::where('department_id', $this->department_id)->get();
    }

    public function save() {
        $this->validate([
            'tanggal' => 'required|date',
            'department_id' => 'required',
            'pegawai_id' => 'required',
            'shift_id' => 'required',
        ]);

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
        return view('livewire.tambah-jadwal');
    }
}
