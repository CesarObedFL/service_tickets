<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Auth;
use App\Models\Ticket;
use App\Models\Notification;

class TicketShow extends Component
{
    use LivewireAlert;

    protected $listeners = [ 'add_notification' => 'render' ];

    public $ticket;

    public function mount( $id )
    {
        // if user's role is admin or support, shows every ticket
        if( auth()->user()->role == 'admin' || auth()->user()->role == 'support' ) {
            $this->ticket = Ticket::with('notifications')->where('id', $id)->first();

        // if not, user only can see his own tickets
        } else {
            $this->ticket = Ticket::with('notifications')->where('id', $id)->where('user_id', auth()->user()->id)->first();
        }
        
        // change ticket's notification 'is_read' status to true
        foreach( $this->ticket->notifications as $notification ) {
            $notification->is_read = true;
            $notification->save();
        }
    }

    public function render()
    {
        return view('livewire.tickets.ticket-show');
    }

    public function open_or_close_ticket()
    {
        if ($this->ticket->status == 'solved' ) {
            $status = 'pending'; 
            $message = 'the ticket has been opened';
        } else {
            $status = 'solved';
            $message = 'the ticket has been closed';
        }

        $this->ticket->status = $status;
        $this->ticket->save();

        Notification::create([
            'type' => 'action', 
            'message' => $message, 
            'is_read' => true, 
            'ticket_id' => $this->ticket->id
        ]);

        $this->dispatch('add_notification');
        $this->alert('success', 'Ticket status chenged successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }
}
