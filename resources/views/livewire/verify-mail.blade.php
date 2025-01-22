<div>
    <div class="card p-3 bg-white mb-4">
        <div wire:loading.remove>
            @if ($verificationMail)
                <h4 class="text-danger">A Verification link has been sent to <a
                        href="">{{ auth()->user()->email }}</a>
                </h4>
            @else
                <h4 class="text-danger">Your Email <a class="text-dark" href="">{{ auth()->user()->email }}</a>
                    has
                    not Verified. Please Verify your Email </h4>
                    <p>A verification link will be send to your email address and open that link in your current windows. </p>
                <input type="text" class="form-control my-1" wire:model='email' value="{{ auth()->user()->email }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="button" wire:click='verify' class="mt-2 btn btn-primary">Verify </button>
            @endif
        </div>
        <div wire:loading>
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>

                </div>
            </div>
        </div>


    </div>

</div>
