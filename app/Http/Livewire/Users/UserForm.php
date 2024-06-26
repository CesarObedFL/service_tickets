<?php

namespace App\Http\Livewire\Users;

use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;

class UserForm extends ModalComponent
{
    use LivewireAlert;

    public $user_id;
    public $mode;
    public $name;
    public $email;
    public $password;
    public $password_input_type;
    public $phone;
    public $role; // [user | support | admin ]

    public function mount($user_id, $mode)
    {
        if ( $mode == 'update' ) {
            $user = User::findOrFail($user_id);
            $this->user_id = $user_id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->role = $user->role;
        }
        $this->password_input_type = 'password';
        $this->mode = $mode;
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }

    public function reset_input_fields()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->role = '';
    }

    public function store()
    {
        $validated_data = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'phone' => 'required|min:10',
            'role' => 'required'
        ]);

        User::create([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'phone' => $validated_data['phone'],
            'role' => $validated_data['role']
        ]);

        $this->dispatch('user_added');
        $this->close();
        $this->alert('success', 'User created successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function update()
    {
        $validated_data = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|min:10',
            'role' => 'required'
        ]);

        User::where('id', $this->user_id)->update([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'role' => $validated_data['role']
        ]);

        $this->dispatch('user_updated');
        $this->close();
        $this->alert('success', 'User updated successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function show_password()
    {
        $this->password_input_type = ($this->password_input_type == 'text') ? 'password' : 'text';
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

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
