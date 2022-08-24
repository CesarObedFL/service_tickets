<?php

namespace App\Http\Livewire\Notifications;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Auth;
use App\Models\Notification;
use App\Models\Image;

class MessageForm extends ModalComponent
{
    use WithFileUploads, LivewireAlert;

    public $message_input = '';
    public $ticket_id;
    public $files = [];
    public $message_readed_by_user;

    public function mount( $ticket_id )
    {
        // if the message will be create by admin or user, it's 'is_read' flag is set in false
        if( auth()->user()->role == 'admin' || auth()->user()->role == 'support' ) {
            $this->message_readed_by_user = false;

        // if the message will be create by user, it's 'is_read' flad is set in true
        } else {
            $this->message_readed_by_user = true;
        }

        $this->ticket_id = $ticket_id;
    }

    public function render()
    {
        return view('livewire.notifications.message-form');
    }

    public function store()
    {
        $validated_data = $this->validate([
            'message_input' => 'required|min:6',
            'files.*' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $notification = Notification::create([
            'type' => 'message', 
            'message' => auth()->user()->name .' : '. $validated_data['message_input'], 
            'is_read' => $this->message_readed_by_user, 
            'ticket_id' => $this->ticket_id
        ]);

        // images store
        foreach( $this->files as $file ) {
            $image_path = $file->storeAs('public\images\ticket_'.$this->ticket_id.'\notification_'.$notification->id, $file->getClientOriginalName());
            Image::create([
                'url' => Storage::url( $image_path), 
                'name' => $file->getClientOriginalName(), 
                'notification_id' => $notification->id
            ]);
        }

        $this->emit('add_notification');
        $this->close();
        $this->alert('success', 'Message writed successfully!...', [ 'position' => 'center', 'timer' => 2500 ]);
    }

    public function close()
    {
        $this->message_input = '';
        $this->files = [];
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
