<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

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
            $pegawai = Auth::user();

            if($pegawai->role === 'manajer') {
                return redirect()->intended(route('manajer-dashboard'));
            } else {
                return redirect()->intended(route('pengajuan-cuti'));
            }
        }

        throw ValidationException::withMessages([
            'password' => 'NIP atau password yang Anda masukkan salah.',
        ]);
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
