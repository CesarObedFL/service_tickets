<section>
    <div class="page-header section-height-75">
        <div class="container">
            <br><br><br>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-center bg-transparent">
                            <h1 class="font-weight-bolder text-info text-gradient">{{ __('Welcome!!!') }}</h1>
                            <br>
                        </div> <!-- /. div card-header pb-0 text-center bg-transparent -->
                        <div class="card-body">
                            <form wire:submit.prevent="login" action="#" method="POST" role="form text-left">
                                @csrf
                                <div class="mb-3">
                                    <label for="email">{{ __('Email') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input wire:model="email" id="email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="@error('password')border border-danger rounded-3 @enderror">
                                        <input wire:model="password" id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('Login') }}</button>
                                </div>
                            </form>
                        </div> <!-- /. div card-body -->

                    </div> <!-- /. div card card-plain mt-8 -->
                </div> <!-- /. div col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto -->
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                             style="background-image:url('../assets/img/curved-images/curved6.jpg')">
                        </div>
                    </div>
                </div> <!-- /. div col-md-6 -->
            </div> <!-- /. div row -->
            <br>
        </div> <!-- /. div container -->
    </div> <!-- /. div page-header section-height-75 -->
</section>
