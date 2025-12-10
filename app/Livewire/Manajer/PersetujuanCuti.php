<?php

namespace App\Livewire\Manajer;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Persetujuan Cuti')]
class PersetujuanCuti extends Component
{
    public function render()
    {
        return view('livewire.manajer.persetujuan-cuti');
    }
}
