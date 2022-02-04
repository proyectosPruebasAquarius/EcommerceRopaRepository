<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Signup extends Component
{
    use RegistersUsers;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'password_confirmation' =>['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPasswordConfirmation()
    {
        if ($this->password !== $this->password_confirmation) {
            $this->addError('password_confirmation', 'La confirmación de la contraseña no coinciden.');
        }
    }

    public function register()
    {
        $validatedData = $this->validate();

        if ($this->password == $this->password_confirmation) {
            try {
                $auth = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                ]);

                Auth::login($auth);
                return redirect(request()->header('Referer'));
            } catch (\Exception $e) {
                //throw $th;
            }
        } else {
            $this->addError('password_confirmation', 'La confirmación de la contraseña no coinciden.');
        }
    }

    public function clean()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->reset(['showRegister', 'name', 'email', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.frontend.signup');
    }
}
