@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">

  <div class="card p-4 my-4">
    <div class="row">
      <div class="col-6">
        <h4 class="py-4">Change Your Profile Picture</h4>
        <form action="{{ route('update.profile.picture') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="picture">Select Image File</label>
              <input type="file" class="form-control-file" id="picture" accept="images/*" name="picture" value="{{ $user->address ?? '' }}">
          </div>

          @error('picture')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
      <div class="col-6">
        <h4 class="py-4">Reset Password</h4>
        <form action="{{ route('reset.password.post') }}" method="post" >
          @csrf
          <div class="form-group">
              <label for="picture">New Password</label>
              <input type="text" name="password" class="form-control">
              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="form-group">
            <label for="picture">Confirm Password</label>
            <input type="text" name="password_confirmation" class="form-control">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



          <button type="submit" class="btn btn-dark ">Submit</button>
      </form>
      </div>
    </div>
  </div>

  <div class="card p-4 my-4">
    <div class="row">
      <div class="col-12">
        <h4 class="py-4">Edit Your Profile Info</h4>

        <form action="{{ route('update.profile.info') }}" method="post">
          @csrf
          <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $user->address ?? '' }}">
          </div>
          @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone ?? '' }}">
        </div>
         @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

          <div class="form-group">
              <label for="user_skills">User Skills</label>
              <input type="text" class="form-control" id="user_skills" name="user_skills" placeholder="python, java, c++, Kotlin" value="{{ $user->user_skills ?? '' }}">
          </div>
           @error('user_skills')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="about">About</label>
              <textarea class="form-control" id="about" name="about" placeholder="Describe your strengths and qualities, be clear about your expertise, explain what you're passionate about, and talk about the work you do." rows="4">{{ $user->about ?? '' }}</textarea>
          </div>
           @error('about')

          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="designation">Designation</label>
              <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="{{ $user->designation ?? '' }}">
          </div>
           @error('designation')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
  <div class="card p-4 my-4">
    <div class="row">
      <div class="col-12">
        <h4 class="py-4">Edit Your Scoial Links</h4>
        <form action="{{ route('update.profile.links') }}" method="post">
          @csrf
          <div class="form-group">
              <label for="github">Github</label>
              <input type="text" class="form-control" id="github" name="github" placeholder="Github" value="{{ $user->github ?? '' }}">
          </div>
           @error('github')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="skype">Skype</label>
              <input type="text" class="form-control" id="skype" name="skype" placeholder="Skype" value="{{ $user->skype ?? '' }}">
          </div>
           @error('skype')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="facebook">Facebook</label>
              <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="{{ $user->facebook ?? '' }}">
          </div>
           @error('facebook')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="linkedin">LinkedIn</label>
              <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn" value="{{ $user->linkedin ?? '' }}">
          </div>
           @error('linkedin')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="instagram">Instagram</label>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="{{ $user->instagram ?? '' }}">
          </div>
           @error('instagram')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="form-group">
              <label for="twitter">Twitter</label>
              <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="{{ $user->twitter ?? '' }}">
          </div>
           @error('twitter')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror

          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>


  </main>

@endsection
