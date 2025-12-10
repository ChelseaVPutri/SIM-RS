<?php

use App\Livewire\User\DashboardUser;
use App\Livewire\Manajer\DaftarPegawai;
use App\Livewire\Manajer\DashboardManager;
use App\Livewire\LandingPage;
use App\Livewire\Manajer\PersetujuanCuti;
use App\Livewire\User\PengajuanCuti;
use App\Livewire\Manajer\TambahJadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Public
Route::get("/", LandingPage::class)->name("landing-page");

// Manajer
Route::middleware(['auth', 'role:manajer'])->prefix('manajer')->group(function () {
    Route::get('/dashboard', DashboardManager::class)->name('manajer-dashboard');
    Route::get("/daftar-pegawai", DaftarPegawai::class)->name("daftar-pegawai");
    Route::get('/kelola-jadwal', TambahJadwal::class)->name('kelola-jadwal');
    Route::get('/persetujuan-cuti', PersetujuanCuti::class)->name('persetujuan-cuti');
});


Route::middleware(['auth', 'role:user'])->prefix('staff')->group(function () {
    Route::get('/dashboard', DashboardUser::class)->name('user-dashboard');
    Route::get('/pengajuan-cuti', PengajuanCuti::class)->name('pengajuan-cuti');
});