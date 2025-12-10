<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class DashboardUser extends Component
{
    public function render()
    {
        return view('livewire.user.dashboard-user');
    }
}
