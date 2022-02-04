<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Session extends Component
{
    public $showRegister = false;
    public $dirty = false;
    /* public $name; */
    public $email;
    public $password;
    /* public $password_confirmation; */

    protected $listeners = ['showRegister' => 'showRegister'];

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

        if (Auth::attempt($validatedData)) {
            // Authentication passed...
            return redirect()->intended('/');
        } else {
            $this->addError('email', 'Email o contraseña erroneos.');
            $this->addError('password', 'Email o contraseña erroneos.');
        }
    }

    public function showRegister($param)
    {
        $this->showRegister = $param;        
        $this->dirty = $this->showRegister ? false : true;
        /* $this->emit('isDirty', $this->dirty); */
    }

    public function clean()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->reset(['showRegister', 'dirty', 'email', 'password']);
    }

    public function render()
    {
        return view('livewire.frontend.session');
    }
}
