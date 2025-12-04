<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page');
    }
}
