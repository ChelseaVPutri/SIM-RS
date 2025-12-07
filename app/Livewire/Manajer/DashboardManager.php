<?php

namespace App\Livewire\Manajer;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Dashboard")]
class DashboardManager extends Component
{
    public function render()
    {
        return view('livewire.manajer.dashboard-manager');
    }
}
