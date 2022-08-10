<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="card z-index-0">
                <h3 class="card-header font-weight-bolder text-uppercase opacity-4">{{ ($mode == 'create') ? 'create user' : 'update user' }}</h3>
                <hr>
                <div class="card-body">
                    <form @if( $mode == 'create' ) wire:submit.prevent="store" @else wire:submit.prevent="update" @endif action="#" method="POST" role="form text-left">
                        <div class="mb-3">
                            <div class="@error('name') border border-danger rounded-3  @enderror">
                                <input wire:model="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                            </div>
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('email') border border-danger rounded-3 @enderror">
                                <input wire:model="email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="input-group @error('password') border border-danger rounded-3 @enderror">
                                <span class="input-group-text" role="button" wire:click="show_password">@if( $input_password_type == 'password' ) <i class="fa fa-eye"></i> @else <i class="fa fa-eye-slash"></i> @endif </span>
                                <input wire:model="password" type="{{ $input_password_type }}" class="form-control ms-1" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                            </div>
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('phone') border border-danger rounded-3 @enderror">
                                <input wire:model="phone" type="number" class="form-control" placeholder="Phone" aria-label="phone" aria-describedby="phone-addon">
                            </div>
                            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('role') border border-danger rounded-3 @enderror">
                                <!-- <input wire:model="role" type="text" class="form-control" placeholder="Rol" aria-label="role" aria-describedby="role-addon"> -->
                                <select wire:model="role" class="form-select" aria-label="role" aria-describedby="role-addon">
                                    <option selected class="font-weight-bolder opacity-7">Pick a role...</option>
                                    <option @if( $role == 'user' ) selected @endif value="user">User</option>
                                    <option @if( $role == 'support' ) selected @endif value="support">Support</option>
                                    <option @if( $role == 'admin' ) selected @endif value="admin">Admin</option>
                                </select>
                            </div>
                            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-center row">
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">{{ ($mode == 'create') ? 'create' : 'update' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
