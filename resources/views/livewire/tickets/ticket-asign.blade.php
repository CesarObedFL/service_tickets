<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="card z-index-0">
                <h3 class="card-header font-weight-bolder text-uppercase opacity-4">Asign Ticket to a Support User</h3>
                <hr>
                <div class="card-body">
                    <form wire:submit.prevent="save" action="#" method="POST" role="form text-left">
                        <div class="mb-3">
                            <div class="@error('support_user') border border-danger rounded-3 @enderror">
                                <select wire:model="support_user"  class="form-control" aria-label="support user" aria-describedby="support-user-addon">
                                    <option>Choose a support user...</option>
                                    @foreach ( $support_users as $user )
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('support_user') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-center row">
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">asign</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div wire:loading wire:target="store">
                        <div class="d-flex align-items-center ms-5 me-5 mb-3">
                            <strong>Loading...</strong>
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
