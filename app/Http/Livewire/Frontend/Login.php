<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $showRegister = false;
    public $dirty = false;
    /* public $name; */
    public $email;
    public $password;
    /* public $password_confirmation; */

    protected $listeners = ['cleanModal' => 'clean'];

    protected $rules = [        
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $validatedData = $this->validate();
//\Debugbar::info($validatedData);
        if (Auth::attempt($validatedData)) {
            // Authentication passed...
            return redirect()->intended('/');
        } else {
            $this->addError('email', 'Email o contraseña erroneos.');
            $this->addError('password', 'Email o contraseña erroneos.');
        }
    }

    public function clean()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->reset(['showRegister', 'dirty', 'email', 'password']);
    }

    public function render()
    {
        return view('livewire.frontend.login');
    }
}
