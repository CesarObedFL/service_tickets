<div class="main-content">
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="card z-index-0">
                <div class="card-body">
                    <form wire:submit.prevent="register" action="#" method="POST" role="form text-left">
                        <div class="mb-3">
                            <div class="@error('name') border border-danger rounded-3  @enderror">
                                <input wire:model="name" type="text" class="form-control" placeholder="Name"
                                    aria-label="Name" aria-describedby="email-addon">
                            </div>
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('email') border border-danger rounded-3 @enderror">
                                <input wire:model="email" type="email" class="form-control" placeholder="Email"
                                    aria-label="Email" aria-describedby="email-addon">
                            </div>
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="@error('password') border border-danger rounded-3 @enderror">
                                <input wire:model="password" type="password" class="form-control"
                                    placeholder="Password" aria-label="Password"
                                    aria-describedby="password-addon">
                            </div>
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-center row">
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">Cancelar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
