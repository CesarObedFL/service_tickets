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

    public $today_tickets = [ 0, 0, 0, 0 ]; // total, solved, pending, in_process

    public $month_days = 0;
    public $month_days_labels = [];
    public $month_tickets = [];
    public $month_solved_tickets = [];
    public $month_pending_tickets = [];

    // calculates the variables
    public function mount()
    {
        $this->ticket_statistics['total_tickets'] = Ticket::count();
        $this->ticket_statistics['solved_tickets'] = Ticket::where('status', 'solved')->count();
        $this->ticket_statistics['pending_tickets'] = Ticket::where('status', 'pending')->count();
        $this->ticket_statistics['in_process_tickets'] = Ticket::where('status', 'in process')->count();

        $this->today_tickets[0] = Ticket::whereDate('created_at', date('y-m-d'))->count();
        $this->today_tickets[1] = Ticket::whereDate('created_at', date('y-m-d'))->where('status', 'solved')->count();
        $this->today_tickets[2] = Ticket::whereDate('created_at', date('y-m-d'))->where('status', 'pending')->count();
        $this->today_tickets[3] = Ticket::whereDate('created_at', date('y-m-d'))->where('status', 'in process')->count();

        $this->month_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        for ($i = 0; $i < $this->month_days; $i++) {
            $this->month_days_labels[$i] = (string)($i+1).'th';
            $this->month_tickets[$i] = Ticket::whereMonth('created_at', date('m'))->whereDay('created_at', ($i+1))->count();
            $this->month_solved_tickets[$i] = Ticket::whereMonth('created_at', date('m'))->whereDay('created_at', ($i+1))->where('status', 'solved')->count();
            $this->month_pending_tickets[$i] = Ticket::whereMonth('created_at', date('m'))->whereDay('created_at', ($i+1))->where('status', 'pending')->count();
        }

        $this->ticket_statistics['solved_tickets_percent'] = ($this->ticket_statistics['solved_tickets'] * 100) /  (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
        $this->ticket_statistics['pending_tickets_percent'] = ($this->ticket_statistics['pending_tickets'] * 100) / (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
        $this->ticket_statistics['in_process_tickets_percent'] = ($this->ticket_statistics['in_process_tickets'] * 100) / (( $this->ticket_statistics['total_tickets'] > 0 ) ? $this->ticket_statistics['total_tickets'] : 1);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
