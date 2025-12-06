<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Daftar Perawat")]
class DaftarPegawai extends Component
{
    public function render()
    {
        return view('livewire.daftar-pegawai');
    }
}
