<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Ticket;
use App\Models\Notification;

class TicketList extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [ 
        'asigned_user' => 'render' , 
        'confirmed' => 'create_notification' 
    ];

    protected $queryString = [ 
        'search' => [ 'except' => '' ], 
        'page' => [ 'except' => 1 ],
        'status' => [ 'except' => 'all' ], 
        'priority' => [ 'except' => 'all' ], 
        'per_page' 
    ];


    public $page;
    public $per_page = 10;
    public $order_by = 'created_at';
    public $sort_direction = 'desc';
    public $search = '';
    public $priority = 'all';
    public $status = 'all';
    public $ticket_id = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $_status = $this->status;
        $_priority = $this->priority;
        $_search = $this->search;
        return view('livewire.tickets.ticket-list', [ 'tickets' => Ticket::where(function($query) use ($_search) {
                                                                                $query->when($_search, function($query, $_search) {
                                                                                    if( $_search != '' )
                                                                                        return $query->where('problem', 'LIKE', "%{$_search}%")->orWhereRelation('user', 'name', 'LIKE', "%{$_search}%");
                                                                                    return $query;
                                                                                });
                                                                            })
                                                                            ->where(function($query) use ($_status) {
                                                                                $query->when($_status, function($query, $_status) {
                                                                                    if( $_status != 'all' )
                                                                                        return $query->where('status', '=', $_status);
                                                                                    return $query;
                                                                                });
                                                                            })
                                                                            ->where(function($query) use ($_priority) {
                                                                                $query->when($_priority, function($query, $_priority) {
                                                                                    if( $_priority != 'all' )
                                                                                        return $query->where('priority', '=', $_priority);
                                                                                    return $query;
                                                                                });
                                                                            })
                                                                            ->orderBy($this->order_by, $this->sort_direction)
                                                                            ->paginate($this->per_page)
                                                    ]);
    }

    public function order( $order_by_parameter )
    {
        if( $this->order_by == $order_by_parameter ) {
            $this->sort_direction = ( $this->sort_direction == 'asc' ) ? 'desc' : 'asc';
        } else {
            $this->sort_direction = 'asc';
            $this->order_by = $order_by_parameter;
        }
    }

    public function change_ticket_status( $ticket_id )
    {
        $ticket = Ticket::where( 'id', $ticket_id )->first();
        $this->ticket_id = $ticket_id;

        if( $ticket->status == 'pending' ) {
            $ticket->status = 'in process';
            $ticket->save();
            $this->alert('success', 'Ticket status chenged successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);

        } else if( $ticket->status == 'in process' ) {
            $ticket->status = 'solved';
            $ticket->save();
            $this->alert('question', 'The ticket has been solved...   Do you want to notify the user?', [
                'showConfirmButton' => true,
                'showDenyButton' => true,
                'confirmButtonText' => 'Yes',
                'denyButtonText' => 'No',
                'onConfirmed' => 'confirmed', 
                'onDenied' => 'denied',
                'position' => 'center', 
                'timer' => null
            ]);

        } else {
            $ticket->status = 'pending';
            $ticket->save();
            $this->alert('success', 'Ticket status chenged successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);

        }
        
    }

    public function create_notification()
    {
        Notification::create([
            'type' => 'action', 
            'message' => 'the ticket has been solved', 
            'is_read' => false, 
            'ticket_id' => $this->ticket_id
        ]);
    }

    public function change_priority( $ticket_id )
    {
        $ticket = Ticket::where( 'id', $ticket_id )->first();
        if( $ticket->priority == 'low' ) {
            $ticket->priority = 'medium';
        } else if( $ticket->priority == 'medium' ) {
            $ticket->priority = 'high';
        } else {
            $ticket->priority = 'low';
        }
        
        $ticket->save();
        $this->alert('success', 'Ticket priority chenged successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

}
