<main class="main-content">

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h2 class="mb-0 font-weight-bolder opacity-4">MY TICKETS</h2>
                            </div>
                            <button class="btn bg-gradient-success btn-sm mb-0" onclick="Livewire.dispatch('openModal', { component: 'tickets.ticket-create' })">Create Ticket</button>
                        </div> <!-- /. div d-flex flex-row justify-content-between -->
                    </div> <!-- /. div card-header pb-0 px-3 -->
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach( $tickets as $ticket )
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <button class="btn btn-icon-only btn-rounded @if( $ticket->status == 'in process' ) btn-outline-warning @elseif( $ticket->status == 'solved' ) btn-outline-success @else btn-outline-danger @endif
                                        mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" data-bs-original-title="{{ $ticket->status }}">
                                        <i class="@if( $ticket->status == 'in process' ) fas fa-exclamation @elseif( $ticket->status == 'solved' ) fas fa-check @else fas fa-times @endif"></i>
                                    </button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $ticket->problem }}</h6>
                                        <span class="mb-2 text-xs">Description: <span class="text-dark font-weight-bold ms-2">{{ $ticket->description }}</span></span>
                                        <span class="mb-2 text-xs">Asigned To: <span class="text-dark ms-2 font-weight-bold">{{ $ticket->asignedTo->name ?? 'unasigned' }}</span></span>
                                        <span class="mb-2 text-xs">Created At: <span class="text-dark ms-2 font-weight-bold">{{ $ticket->created_at }}</span></span>
                                    </div> <!-- /. div d-flex flex-column -->
                                    <div class="ms-auto">
                                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('ticket-show', [ 'id' => $ticket->id ]) }}">
                                            <i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>Show
                                        </a>
                                    </div> <!-- /. div ms-auto -->
                                </li>
                            @endforeach
                        </ul>
                    </div> <!-- /. div card-body pt-4 p-3 -->
                </div> <!-- /. div card -->
            </div> <!-- /. div col-md-12 mt-2 -->
        </div> <!-- /. div row -->
    </div> <!-- /. div container-fluid py-4 -->

</main>

