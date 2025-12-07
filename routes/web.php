<?php

use App\Livewire\Manajer\DaftarPegawai;
use App\Livewire\Manajer\DashboardManager;
use App\Livewire\LandingPage;
use App\Livewire\PengajuanCuti;
use App\Livewire\Manajer\TambahJadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Public
Route::get("/", LandingPage::class)->name("landing-page");
Route::get('/pengajuan-cuti', PengajuanCuti::class)->name('pengajuan-cuti');

// Manajer
Route::middleware(['auth', 'role:manajer'])->prefix('manajer')->group(function () {
    Route::get('/dashboard', DashboardManager::class)->name('manajer-dashboard');
    Route::get("/daftar-pegawai", DaftarPegawai::class)->name("daftar-pegawai");
    Route::get('/kelola-jadwal', TambahJadwal::class)->name('kelola-jadwal');
});

// Route::prefix('manajer')->group(function () {
//     Route::get('/dashboard', DashboardManager::class)->name('manajer-dashboard')->middleware('auth');
// });