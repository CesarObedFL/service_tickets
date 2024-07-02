<div>

    <div class="container-fluid">
        <div class="page-header min-height-200 border-radius-xl mt-4"
            style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->role }}
                        </p>
                    </div> <!-- /. div h-100 -->
                </div> <!-- /. div col-auto my-auto -->
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-fill p-1 bg-transparent">
                            <li class="nav-item">
                                <a class="mb-0 px-0 py-1" data-bs-toggle="tooltip" data-bs-original-title="go to my tickets" href="{{ route('my-tickets') }}">
                                    <span class="ms-1">{{ __('My Tickets') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="mb-0 px-0 py-1" role="button" data-bs-toggle="tooltip" data-bs-original-title="reset password" wire:click="$dispatch('openModal', { component: 'users.reset-password', arguments: { user_id: {{ $user->id }} }})">
                                    <span class="ms-1">{{ __('Password') }}</span>
                                </a>
                            </li>
                        </ul> <!-- /. div nav nav-fill p-1 bg-transparent  -->
                    </div> <!-- /. div nav-wrapper position-relative end-0 -->
                </div> <!-- /. div col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 -->
            </div> <!-- /. div row -->
        </div> <!-- /. div card card-body -->
    </div> <!-- /. div container-fluid -->

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">

                <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">

                    <div class="form-group">
                        <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input wire:model="user.name" class="form-control" type="text" placeholder="Name" id="user-name">
                        </div>
                        @error('user.name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                        <div class="@error('user.email')border border-danger rounded-3 @enderror">
                            <input wire:model="user.email" class="form-control" type="email" placeholder="@example.com" id="user-email">
                        </div>
                        @error('user.email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                        <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                            <input wire:model="user.phone" class="form-control" type="tel" placeholder="40770888444" id="phone">
                        </div>
                        @error('user.phone') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

                <div wire:loading wire:target="save">
                    <div class="d-flex align-items-center ms-5 me-5 mb-3">
                        <strong>Loading...</strong>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>

            </div> <!-- /. div card-body pt-4 p-3 -->
        </div> <!-- /. div card -->
    </div> <!-- /. div container-fluid py-4 -->
    
</div>
