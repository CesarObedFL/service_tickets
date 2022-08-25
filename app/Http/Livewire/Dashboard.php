<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ticket;

class Dashboard extends Component
{

    // statistics array variables of the dashboard
    public $ticket_statistics = [ 
        'total_tickets' => 0,
        'solved_tickets' => 0, 'solved_tickets_percent' => 0,
        'pending_tickets' => 0, 'pending_tickets_percent' => 0,
        'in_process_tickets' => 0, 'in_process_tickets_percent' => 0
    ];

    // calculates the variables
    public function mount()
    {
        $this->ticket_statistics['total_tickets'] = Ticket::count();
        $this->ticket_statistics['solved_tickets'] = Ticket::where('status', 'solved')->count();
        $this->ticket_statistics['pending_tickets'] = Ticket::where('status', 'pending')->count();
        $this->ticket_statistics['in_process_tickets'] = Ticket::where('status', 'in process')->count();

        $this->ticket_statistics['solved_tickets_percent'] = ($this->ticket_statistics['solved_tickets'] * 100) /  (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
        $this->ticket_statistics['pending_tickets_percent'] = ($this->ticket_statistics['pending_tickets'] * 100) / (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
        $this->ticket_statistics['in_process_tickets_percent'] = ($this->ticket_statistics['in_process_tickets'] * 100) / (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
