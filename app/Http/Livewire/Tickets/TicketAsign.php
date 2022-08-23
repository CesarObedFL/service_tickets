<?php

namespace App\Http\Livewire\Tickets;

use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;

class TicketAsign extends ModalComponent
{
    use LivewireAlert;

    public $ticket_id;
    public $support_user; // the value of the user's id

    protected $rules = [
        'support_user' => 'required',
    ];

    public function mount($ticket_id)
    {
        $this->ticket_id = $ticket_id;
    }

    public function render()
    {
        return view('livewire.tickets.ticket-asign', [ 'support_users' => User::select('id', 'name')->where('role', 'support')->get() ]);
    }

    public function reset_fields()
    {
        $this->support_user = '';
    }

    public function save()
    {
        $this->validate();

        Ticket::where('id', $this->ticket_id)->update([ 'asigned_to' => $this->support_user ]);

        Notification::create([
            'type' => 'action', 
            'message' => 'ticket assigned to support user', 
            'is_read' => false, 
            'ticket_id' => $this->ticket_id
        ]);

        $this->emit('asigned_user');
        $this->close();
        $this->alert('success', 'User asigned to the ticket successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function close()
    {
        $this->reset_fields();
        $this->closeModal();
    }

    public static function modalMaxWidth() : string 
    {
        return '3xl';
    }

    public static function closeModalOnEscape(): bool 
    {
        return true;
    }
}
