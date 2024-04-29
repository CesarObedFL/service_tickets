<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required',
    ];

    public function mount() 
    {
        if(auth()->user()) {
            redirect('/user-profile');
        }
    }

    public function login() 
    {
        $credentials = $this->validate();
        if(auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = User::where(["email" => $this->email])->first();
            auth()->login($user);
            return redirect()->intended('/user-profile');        
        }
        else{
            return $this->addError('email', trans('auth.failed')); 
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
