<div class="main-content">

    <div class="container">
        <div class="row">
            <div class="card z-index-0">

                <h3 class="card-header font-weight-bolder text-uppercase opacity-4">reset password</h3>

                <hr>

                <div class="card-body">
                    <form wire:submit.prevent="store" action="#" method="POST" role="form text-left">

                        <div class="mb-3">
                            <div class="input-group @error('password') border border-danger rounded-3 @enderror">
                                <span class="input-group-text" role="button" wire:click="show_password">@if( $input_password_type == 'password' ) <i class="fa fa-eye"></i> @else <i class="fa fa-eye-slash"></i> @endif </span>
                                <input wire:model="password" type="{{ $input_password_type }}" class="form-control ms-3" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                            </div>
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group @error('password') border border-danger rounded-3 @enderror">
                                <span class="input-group-text" role="button" wire:click="show_confirm_password"><i class="fa fa-eye"></i></span>
                                <input wire:model="confirm_password" type="{{ $input_confirm_password_type }}" class="form-control ms-3" placeholder="Confirm password" aria-label="Confirm Password" aria-describedby="confirm-password-addon">
                            </div>
                            @error('confirm_password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-center row"> <!-- action buttons -->
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">update</button>
                            </div>
                        </div> <!-- /. div action buttons -->

                    </form>
                </div> <!-- /. div card-body -->

                <div class="card-footer">
                    <div wire:loading wire:target="store">
                        <div class="d-flex align-items-center ms-5 me-5 mb-3">
                            <strong>Loading...</strong>
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                </div> <!-- /. div card-footer -->

            </div> <!-- /. div card z-index-0 -->
        </div> <!-- /. div row -->
    </div> <!-- /. div container -->

</div>

