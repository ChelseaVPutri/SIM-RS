<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PengajuanCuti as ModelPengajuan;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanCuti extends Component
{
    use WithFileUploads;

    public $jenis_cuti = '';
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $alasan;
    public $bukti_foto;
    public $sisa_cuti;
    public $total_cuti = 12;
    public $pendingCount = 0;
    public $approvedCount = 0;

    // Rules validasi
    protected $rules = [
        'jenis_cuti' => 'required|in:Cuti sakit,Cuti tahunan',
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'alasan' => 'required|string|min:10',
        'bukti_foto' => 'nullable|image|max:5120'
    ];

    public function mount() {
        $pegawai = Auth::user();

        if($pegawai) {
            $this->sisa_cuti = $pegawai->sisa_cuti;
            $this->pendingCount = ModelPengajuan::where('pegawai_id', $pegawai->id)
                ->where('status', 'Pending')
                ->count();
            $this->approvedCount = ModelPengajuan::where('pegawai_id', $pegawai->id)
                ->where('status', 'Disetujui')
                ->count();
        }
    }

    public function save() {
        $this->validate();
        $pegawai = Auth::user();

        if(!$pegawai) {
            
        }

        // Hitung durasi cuti
        $start = Carbon::parse($this->tanggal_mulai);
        $end = Carbon::parse($this->tanggal_selesai);
        $durasi = $start->diffInDays($end) + 1;

        // Cek apakah sisa cuti pegawai cukup
        if($pegawai->sisa_cuti < $durasi) {
            $this->addError('jenis_cuti', "Sisa cuti tidak mencukupi untuk pengajuan ini. Anda mengajukan: {$durasi} hari, Sisa cuti anda: {$pegawai->sisa_cuti} hari.");
            return;
        }

        // Logic upload foto
        $pathFoto = null;
        if($this->bukti_foto) {
            $pathFoto = $this->bukti_foto->store('bukti-cuti', 'public');
        }

        // Save ke database
        ModelPengajuan::create([
            'pegawai_id' => $pegawai->id,
            'jenis_cuti' => $this->jenis_cuti,
            'tanggal_mulai_cuti' => $this->tanggal_mulai,
            'tanggal_selesai_cuti' => $this->tanggal_selesai,
            'alasan_cuti' => $this->alasan,
            'foto_bukti' => $pathFoto,
            'status' => 'pending'
        ]);

        $this->reset(['jenis_cuti', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'bukti_foto']);
        $this->mount();
        $this->dispatch('show-toast', message: 'Pengajuan cuti berhasil dikirim!');


    }

    public function render()
    {
        return view('livewire.pengajuan-cuti');
    }
}
