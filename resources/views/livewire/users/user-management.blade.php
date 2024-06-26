<div class="main-content">

    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">

                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h2 class="mb-0 font-weight-bolder opacity-4">USERS</h2>
                        </div>
                        <button class="btn bg-gradient-info btn-sm mb-0" wire:click="$dispatch('openModal', { component: 'users.user-form', arguments: { user_id: {{ 0 }}, mode: 'create' }})">+&nbsp; New User</button>
                    </div> <!-- /. div d-flex flex-row justify-content-between -->
                    <br>
                    <div class="d-flex flex-row justify-content">
                        <div class="col-md-1">
                            <!-- <select class="custom-select" wire:model="per_page"> -->
                            <select wire:model.live="per_page" class="block w-sm text-sm font-medium transition duration-75 border border-gray-800 rounded-lg h-10 focus:border-blue-600 focus:ring-1 focus:ring-inset focus:ring-blue-600 bg-white">
                                <option value="10">10 per page</option>
                                <option value="25">25 per page</option>
                                <option value="50">50 per page</option>
                            </select>
                        </div>
                        <div class="col-md-11">
                            <input wire:model.live="search" type="text" class="form-control" placeholder="search user by name or email...">
                        </div>
                    </div> <!-- /. div d-flex flex-row justify-content -->
                </div> <!-- /. div card-header pb-0 -->

                <br> <hr> <br>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" role="button" wire:click="order('id')"> ID 
                                        @if ( $order_by == 'id' )
                                            @if ( $sort_direction == 'asc' ) <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> @else <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i> @endif
                                        @else 
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" role="button" wire:click="order('name')"> Name 
                                        @if ( $order_by == 'name' )
                                            @if ( $sort_direction == 'asc' ) <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> @else <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i> @endif
                                        @else 
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" role="button" wire:click="order('email')"> Email 
                                        @if ( $order_by == 'email' )
                                            @if ( $sort_direction == 'asc' ) <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> @else <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i> @endif
                                        @else 
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" role="button" wire:click="order('role')"> Role 
                                        @if ( $order_by == 'role' )
                                            @if ( $sort_direction == 'asc' ) <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> @else <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i> @endif
                                        @else 
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" role="button" wire:click="order('status')"> Status 
                                        @if ( $order_by == 'status' )
                                            @if ( $sort_direction == 'asc' ) <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> @else <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i> @endif
                                        @else 
                                            <i class="fas fa-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( $users )
                                    @foreach( $users as $user )
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold text-uppercase mb-0">{{ $user->role }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0"> @if( $user->status ) <span class="badge badge-sm bg-gradient-success">{{ __('Active') }}</span> @else <span class="badge badge-sm bg-gradient-danger">{{ __('Inactive') }}</span> @endif </p>
                                            </td>
                                            <td class="text-center">
                                                <span role="button" data-bs-toggle="tooltip" data-bs-original-title="Edit user" wire:click="$dispatch('openModal', { component: 'users.user-form', arguments: { user_id: {{ $user->id }}, mode: 'update' }})">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </span>
                                                <span role="button" wire:click="change_status({{ $user->id }})" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="@if( $user->status ) Deactivate user @else Activate user @endif">
                                                    <i class="cursor-pointer @if( $user->status ) fas fa-user-times @else fas fa-user-check @endif text-secondary"></i>
                                                </span>
                                                <a class="mb-0 px-0 py-1" role="button" data-bs-toggle="tooltip" data-bs-original-title="reset password" wire:click="$dispatch('openModal', { component: 'users.reset-password', arguments: { user_id: {{ $user->id }} }})">
                                                    <span class="ms-1 fas fa-key text-secondary"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- /. div table-responsive p-0 -->
                </div> <!-- /. div card-body px-0 pt-0 pb-2 -->

                <br>
                <div class="card-footer">
                    @if ( $users->count() )
                        {{ $users->links() }}
                    @else
                        <p>There isn't results searching "{{ $search }}" in the page {{ $page }} showing {{ $per_page }} per page...</p>
                    @endif
                </div> <!-- /. div card-footer -->

                <div wire:loading.table>
                    <div class="d-flex align-items-center ms-5 me-5 mb-3">
                        <strong>Loading...</strong>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div> <!-- /. div wire.loading.table -->

            </div> <!-- /. div card mb-4 mx-4 -->
        </div> <!-- /. div col-12 -->
    </div> <!-- /. div row -->

    

</div>

