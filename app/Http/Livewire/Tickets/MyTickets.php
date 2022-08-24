<?php

namespace App\Http\Livewire\Tickets;

use App\Http\Livewire\Auth;
use Livewire\Component;
use App\Models\Ticket;

class MyTickets extends Component
{
    protected $listeners = [ 'ticket_created' => 'render' ];

    // only render the tickets of the authenticated user
    public function render()
    {
        return view('livewire.tickets.my-tickets', [ 'tickets' => Ticket::where('user_id', auth()->user()->id)->get() ]);
    }
}
