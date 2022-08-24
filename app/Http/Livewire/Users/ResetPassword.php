<?php

namespace App\Http\Livewire\Users;

use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;

class ResetPassword extends ModalComponent
{
    use LivewireAlert;

    public $user_id;
    public $password;
    public $confirm_password;
    public $input_password_type;
    public $input_confirm_password_type;

    protected $rules = [
        'confirm_password' => 'required',
        'password' => 'required|min:6|same:confirm_password'
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->input_password_type = 'password';
        $this->input_confirm_password_type = 'password';
    }

    public function render()
    {
        return view('livewire.users.reset-password');
    }

    public function store()
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                if ( $this->password != $this->confirm_password ) {
                    $validator->errors()->add('password', 'passwords doesn\'t match...');
                    $validator->errors()->add('confirm_password', 'passwords doesn\'t match...');
                }
            });
        })->validate();    
        
        User::where('id', $this->user_id)->update([
            'password' => Hash::make( $this->password ),
        ]);

        $this->close();
        $this->alert('success', "Password reset successfully!...", [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function close()
    {
        $this->user_id = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->closeModal();
    }

    public function show_password()
    {
        $this->input_password_type = ($this->input_password_type == 'text') ? 'password' : 'text';
    }

    public function show_confirm_password()
    {
        $this->input_confirm_password_type = ($this->input_confirm_password_type == 'text') ? 'password' : 'text';
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
