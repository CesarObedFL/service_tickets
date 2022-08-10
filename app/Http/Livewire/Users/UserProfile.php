<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserProfile extends Component
{
    use LivewireAlert;

    public User $user;
    
    protected $rules = [
        'user.name' => 'required|max:40|min:3',
        'user.email' => 'required|email:rfc,dns',
        'user.phone' => 'required|min:10',
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function save() {
        $this->validate();
        $this->user->save();
        $this->alert('success', "Your profile was update successfully!...", [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function render()
    {
        return view('livewire.users.user-profile');
    }
}
