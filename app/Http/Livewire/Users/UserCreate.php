<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserCreate extends ModalComponent
{

    public $name;
    public $email;
    public $password;
    public $phone;
    public $rol; // [user | support | admin ]

    public function render()
    {
        return view('livewire.users.user-create');
    }

    public function reset_input_fields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->rol = '';
    }

    public function store()
    {
        $validated_data = $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        //User::create($validated_data);
    }

    public function close()
    {
        $this->reset_input_fields();
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    /*public static function closeModalOnEscape(): bool
    {
        return false;
    }*/
}
