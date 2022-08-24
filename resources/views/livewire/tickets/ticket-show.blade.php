<main class="main-content">

    <div class="container-fluid py-4">
        @if ( !$ticket )
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="icon fa fa-ban"></i> Ticket did not find...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('my-tickets') }}">
                Go to my tickets
                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
            </a>
        @else

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h2 class="mb-0 font-weight-bolder opacity-4"> {{ $ticket->problem }}</h2>
                                </div>
                                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('my-tickets') }}">
                                    <i class="fas fa-list text-dark me-2" aria-hidden="true"></i>go to my tickets
                                </a>
                                <button class="btn btn-sm @if( $ticket->status == 'solved' ) bg-gradient-warning @else bg-gradient-success @endif"
                                    wire:click="open_or_close_ticket">
                                    @if( $ticket->status == 'solved' ) open @else close @endif
                                </button>
                            </div> <!-- /. div d-flex flex-row justify-content-between -->
                        </div> <!-- /. div card-header pb-0 -->
                        <br> <hr> <br>
                        <div class="card-body p-4 pt-0 pb-2">
                            <div class="d-flex flex-column h-100">
                                <p class="mb-2">{{ $ticket->description }}</p>
                            </div>
                        </div> <!-- /. div card-body p-4 pt-0 pb-2 -->
                        <div class="card-footer">
                            <div class="d-flex flex-row justify-content-between">
                                <h3 class="mb-0 opacity-4"><small>asigned to : </small> &nbsp;&nbsp; {{ $ticket->asignedTo->name ?? 'unasigned' }}</h3>
                                <span class="badge badge-sm @if( $ticket->status == 'solved' ) bg-gradient-success @elseif( $ticket->status == 'pending' ) bg-gradient-danger @else bg-gradient-info @endif">
                                    {{ $ticket->status }}
                                </span>
                                <h3 class="mb-0 opacity-4"><small>created at : </small> &nbsp;&nbsp; {{ $ticket->created_at }}</h3>
                            </div>
                        </div> <!-- /. div card-footer -->
                    </div> <!-- /. div card mb-4 -->
                </div> <!-- /. div col-12 -->
            </div> <!-- /. div row -->

            <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h2 class="mb-0 font-weight-bolder opacity-4">Messages & Notifications</h2>
                                </div>
                                <button class="float-end text-secondary icon-move-right" role="button" data-bs-toggle="tooltip" data-bs-original-title="write a message"
                                    onclick="Livewire.emit('openModal', 'notifications.message-form', {{ json_encode(['ticket_id' => $ticket->id]) }} )"> 
                                    <i class="fas fa-reply"> reply</i> 
                                </button>
                            </div> <!-- /. div d-flex flex-row justify-content-between -->
                        </div> <!-- /. div card-header pb-0 -->

                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                @foreach( $ticket->notifications as $notification )
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="@if( $notification->type == 'action') ni ni-bell-55 text-primary @else fas fa-comment text-success @endif text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $notification->message }}</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">at {{ $notification->created_at }}</p>
                                            <br>
                                            @foreach( $notification->images as $image )
                                                <img class="d-block w-100 h-50 rounded-3" src="{{ asset('storage/images/ticket_'.$ticket->id.'/notification_'.$notification->id.'/'.$image->name) }}" alt="{{ $image->name }}">
                                                <br>
                                            @endforeach
                                        </div> <!-- /. div timeline-content -->
                                    </div> <!-- /. div timeline-block mb-3 -->
                                @endforeach
                            </div> <!-- /. div timeline timeline-one-side -->
                        </div> <!-- /. div card-body p-3 -->

                        <div class="card-footer">
                            <button class="float-end text-secondary icon-move-right" role="button" data-bs-toggle="tooltip" data-bs-original-title="write a message"
                                onclick="Livewire.emit('openModal', 'notifications.message-form', {{ json_encode(['ticket_id' => $ticket->id]) }} )"> 
                                <i class="fas fa-reply"> reply</i> 
                            </button>
                        </div> <!-- /. div card-footer -->

                        <div wire:loading>
                            <div class="d-flex align-items-center ms-5 me-5 mb-3 ">
                                <strong>Loading...</strong>
                                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </div> <!-- div wire:loading -->

                    </div> <!-- /. div card h-100 -->
                </div> <!-- /. div col-lg-12 col-md-6 mb-md-0 mb-4 -->
            </div> <!-- /. div row my-4 -->

        @endif
    </div> <!-- /. div container-fluid py-4 -->

</main>
