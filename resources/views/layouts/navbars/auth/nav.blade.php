<main class="main-content mt-1 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-md">
                        <a class="opacity-5 text-dark" href="javascript:;">Page</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        {{ str_replace('-', ' ', Route::currentRouteName()) }}
                    </li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
                
                <ul class="navbar-nav justify-content-end">

                    <li class="nav-item d-flex align-items-center">
                        {{ auth()->user()->name . ' : ' . auth()->user()->role }}
                    </li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0 icon-move-right">
                            <livewire:auth.logout />
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0 icon-move-right" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (auth()->user()->count_unreaded_notifications() > 0 ) 
                                <i class="fa fa-bell cursor-pointer"><span class="position-absolute top-70 start-50 badge rounded-pill bg-danger">{{ auth()->user()->count_unreaded_notifications() }}</span></i>
                            @else
                                <i class="fa fa-bell cursor-pointer"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            @foreach( auth()->user()->unreaded_notifications() as $notification )
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('ticket-show', [ 'id' => $notification->ticket->id ]) }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="@if( $notification->type == 'action') ni ni-bell-55 text-primary @else fas fa-comment text-success @endif avatar avatar-sm"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-0">
                                                @if ( $notification->type == 'message' ) 
                                                    <span class="font-weight-bold"> Message </span> from {{ explode(" : ", $notification->message)[0] }}
                                                @else
                                                    <span class="font-weight-bold"> Action : </span> {{ $notification->message }}
                                                @endif
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $notification->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

