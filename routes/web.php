<?php

use App\Livewire\DaftarPegawai;
use App\Livewire\DashboardManager;
use App\Livewire\LandingPage;
use App\Livewire\PengajuanCuti;
use App\Livewire\TambahJadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Public
Route::get("/", LandingPage::class)->name("landing-page");
Route::get("/daftar-pegawai", DaftarPegawai::class)->name("daftar-pegawai");
Route::get('/kelola-jadwal', TambahJadwal::class)->name('kelola-jadwal');
Route::get('/pengajuan-cuti', PengajuanCuti::class)->name('pengajuan-cuti');

// Manajer
Route::prefix('manajer')->group(function () {
    Route::get('/dashboard', DashboardManager::class)->name('manajer-dashboard')->middleware('auth');
});