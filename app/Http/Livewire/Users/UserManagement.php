<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;

class UserManagement extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [ 'user_added' => 'render', 'user_updated' => 'render' ];

    protected $queryString = [ 'search' => [ 'except' => ''], 'per_page' ];

    public $search = '';
    public $per_page = 10;
    public $order_by = 'id';
    public $sort_direction = 'asc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.users.user-management', [ 
                                                        'users' => User::select('id', 'name', 'email', 'role', 'status')
                                                                        ->where('name' , 'LIKE', "%{$this->search}%")
                                                                        ->orWhere('email', 'LIKE', "%{$this->search}%")
                                                                        ->orderBy($this->order_by, $this->sort_direction)
                                                                        ->paginate($this->per_page)
                                                    ]);
    }

    public function order_by( $order_by_parameter )
    {
        if ( $this->order_by == $order_by_parameter ) {
            $this->sort_direction = ( $this->sort_direction == 'asc' ) ? 'desc' : 'asc';
        } else {
            $this->sort_direction = 'asc';
            $this->order_by = $order_by_parameter;
        }
    }

    public function change_status($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status == true) ? false : true;
        $user->save();
        $this->alert('success', "The status of the user $id has been changed successfully!...", [ 'position' => 'center', 'timer' => 2500 ]);
    }
}
