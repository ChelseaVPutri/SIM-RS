<?php

use App\Livewire\DashboardManager;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Public
Route::get("/", LandingPage::class)->name("landing-page");
// Route::get("/dashboard", DashboardManager::class)->name("dashboard");

// Manajer
Route::prefix('manajer')->group(function () {
    Route::get('/dashboard', DashboardManager::class)->name('manajer-dashboard')->middleware('auth');
});