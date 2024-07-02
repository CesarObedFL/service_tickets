<?php

namespace App\Http\Livewire\Tickets;

use App\Http\Livewire\Auth;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Ticket;

class TicketCreate extends ModalComponent
{
    use LivewireAlert;

    public $problem;
    public $description;

    protected $rules = [
        'problem' => 'required|max:30|min:5',
        'description' => 'required|min:30|max:255'
    ];

    public function render()
    {
        return view('livewire.tickets.ticket-create');
    }

    public function store()
    {
        $this->validate();

        Ticket::create([
            'problem' => $this->problem,
            'description' => $this->description,
            'user_id' => auth()->user()->id
        ]);

        $this->dispatch('ticket_created');
        $this->close();
        $this->alert('success', 'Ticket created successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function reset_fields()
    {
        $this->problem = '';
        $this->description = '';
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
