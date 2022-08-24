<div class="main-content">

    <div class="container">
        <div class="row">
            <div class="card z-index-0">

                <h3 class="card-header font-weight-bolder text-uppercase opacity-4">Write a Reply</h3>

                <hr>

                <div class="card-body">
                    <form wire:submit.prevent="store" action="#" method="POST" role="form text-left" enctype="miltipart/form-data">
                        
                        <div class="mb-3">
                            <div class="@error('message_input') border border-danger rounded-3 @enderror">
                                <textarea wire:model="message_input" class="form-control" cols="30" rows="5" placeholder="Message..."></textarea>
                            </div>
                            @error('message_input') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="@error('files') border border-danger rounded-3 @enderror">
                                <input wire:model="files" type="file" class="form-control" accept="image/*" multiple>
                            </div>
                            @error('files.*') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="text-center row"> <!-- action buttons -->
                            <div class="col-md-6">
                                <button type="button" wire:click="close" class="btn bg-gradient-danger w-100 my-4 mb-2">cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">write</button>
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
