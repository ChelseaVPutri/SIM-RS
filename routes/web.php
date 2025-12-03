<?php

use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;


// Public
Route::get("/", LandingPage::class)->name("landing-page");