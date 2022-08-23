<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="card z-index-0">
                <h3 class="card-header font-weight-bolder text-uppercase opacity-4">Create Ticket</h3>
                <hr>
                <div class="card-body">
                    <form wire:submit.prevent="store" action="#" method="POST" role="form text-left">
                        <div class="mb-3">
                            <div class="@error('problem') border border-danger rounded-3 @enderror">
                                <input wire:model="problem" type="text" class="form-control" placeholder="Problem" aria-label="Problem" aria-describedby="problem-addon">
                            </div>
                            @error('problem') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('description') border border-danger rounded-3 @enderror">
                                <textarea wire:model="description" class="form-control" cols="30" rows="5" placeholder="Write the problem description..."></textarea>
                            </div>
                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-center row">
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">create</button>
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
