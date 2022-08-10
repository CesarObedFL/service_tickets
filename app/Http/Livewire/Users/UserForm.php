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
    public $input_password_type;
    public $phone;
    public $role; // [user | support | admin ]

    public function mount($user_id, $mode)
    {
        if ( $mode == 'update' ) {
            $user = User::findOrFail($user_id);
            $this->user_id = $user_id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = Hash::check('plain-text', $user->password);
            $this->phone = $user->phone;
            $this->role = $user->role;
        }
        $this->input_password_type = 'password';
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
        ]/*, [
            'name.required' => 'El campo de Nombre es requerido...',
            'email.required' => 'El campo de Email es requerido...',
            'email.email' => 'El campo debe ser un correo valido...',
            'password.required' => 'El campo de Contraseña es requerido...',
            'phone.required' => 'El campo de Teléfono es requerido...',
            'role.required' => 'El campo de rol es requerido...'
        ]*/);

        User::create([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'phone' => $validated_data['phone'],
            'role' => $validated_data['role']
        ]);

        $this->emit('user_added');
        $this->close();
        $this->alert('success', 'User created successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function update()
    {
        $validated_data = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'phone' => 'required|min:10',
            'role' => 'required'
        ]/*, [
            'name.required' => 'El campo de Nombre es requerido...',
            'email.required' => 'El campo de Email es requerido...',
            'email.email' => 'El campo debe ser un correo valido...',
            'password.required' => 'El campo de Contraseña es requerido...',
            'phone.required' => 'El campo de Teléfono es requerido...',
            'role.required' => 'El campo de rol es requerido...'
        ]*/);

        User::where('id', $this->user_id)->update([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'phone' => $validated_data['phone'],
            'role' => $validated_data['role']
        ]);

        $this->emit('user_updated');
        $this->close();
        $this->alert('success', 'User updated successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function show_password()
    {
        $this->input_password_type = ($this->input_password_type == 'text') ? 'password' : 'text';
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
