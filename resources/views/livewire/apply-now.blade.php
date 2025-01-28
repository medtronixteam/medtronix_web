<div class="card-body">
    <div class="d-flex justify-content-center" style="gap: 5px">
        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $step == 1 ? '#02fff0' : '#fff' }}; border: 1px solid #02fff0;"></div>
        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $step == 2 ? '#02fff0' : '#fff' }}; border: 1px solid #02fff0;"></div>
    </div>
    <hr>
    <form wire:submit.prevent='submit' method="POST">
        @if ($step == 1)
            <div class="row form-group">
                <div class="col-sm-12 col-md-6">
                    <label>First Name *</label>
                    <input type="text" wire:model="first_name" class="form-control">
                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 col-sm-12">
                    <label>Last Name *</label>
                    <input type="text" wire:model="last_name" class="form-control">
                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label>Email Address *</label>
                    <input type="email" wire:model="email" class="form-control">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label>Apply to Position *</label>
                    <input type="text" wire:model="position_applied" class="form-control">
                    @error('position_applied') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <button type="button" wire:click="nextStep" class="btn btn-primary float-end">Next</button>
        @elseif ($step == 2)
            <div class="row form-group">
                <div class="col-12">
                    <label>Experience *</label>
                    <select wire:model="experience" class="form-control">
                        <option value="">Select</option>
                        <option value="new">New</option>
                        <option value="6m">6 Months+</option>
                        <option value="1y">1 Year+</option>
                        <option value="2y">2 Years+</option>
                        <option value="3y">3 Years+</option>
                        <option value="4y">4 Years+</option>
                    </select>
                    @error('experience') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label>Cover Letter</label>
                    <textarea wire:model="cover_letter" class="form-control" rows="3"></textarea>
                    @error('cover_letter') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="formbold-form-file-flex">
                        <label for="upload" class="formbold-form-label">
                          Upload Resume
                        </label>
                        <input

                          type="file" accept="application/pdf" wire:model="resume"
                          class="formbold-form-file"
                        />
                    </div>
                    @error('resume') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between ">
                <button type="button" wire:click="backStep" class="btn btn-primary">Back</button>
                <button type="submit"  class="btn btn-secondary">Apply Now</button>
            </div>
        @elseif ($step == 3)

            <div class="my-5 d-flex justify-content-center align-items-center" style="flex-direction: column">
                <h4>Thanks for Applying</h4>
                <p class="" style="  color: #04b3ab;">Our HR Team will review your application.</p>
            </div>

        @endif
    </form>
</div>
