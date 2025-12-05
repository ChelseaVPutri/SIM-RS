<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]
class LandingPage extends Component
{
    public $nip = '';
    public $password = '';

    protected $rules = [
        'nip' => 'required',
        'password' => 'required'
    ];

    protected $messages = [
        'nip.required' => 'NIP wajib diisi!',
        'password.required' => 'Password wajib diisi!',
    ];

    public function login() {
        $this->validate();
        
        if(Auth::attempt(['nip' => $this->nip,'password'=> $this->password])) {
            session()->regenerate();
            $role = ['admin', 'staff'];

            if($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('user.dashboard'));
            }
        }

        $this->addError('nip', 'NIP atau Password salah.');
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
