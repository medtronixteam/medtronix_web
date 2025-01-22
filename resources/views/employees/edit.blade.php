@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4">Edit Your Profile Picture</h4>
                <form action="{{ route('updateProfilePicture', $user->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        @if ($user->picture)
                        <img class="img-fluid rounded" style="max-width:200px; max-height:200px "
                            src="{{ asset('storage/' . $user->picture) }}" alt="User Profile Picture">
                        @else
                        <p>No Profile picture add new</p>
                        <!-- You can provide a default image or message here for when profile_picture is null -->
                        <i class="fas fa-smile"></i>
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Choose New Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    </div>
                    @error('profile_picture')
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

        <form action="{{ route('employees.update', $user->id)}} " method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    <h4 class="py-4">Edit Your Profile Info</h4>
                </div>
                <div class="col-lg-6">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name ?? old('name') }}" required>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $user->email ?? old('email') }}" required>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $user->phone ?? old('phone') }}">
                    </div>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- Whatsapp Number -->
                    <div class="form-group">
                        <label for="whatsapp_number">whatsapp Number <span class="text-info">(Optional)</span></label>
                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                            value="{{ $user->whatsapp_number ?? old('whatsapp_number') }}">
                    </div>
                    @error('whatsapp_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">Address <span class="text-info">(Optional)</span></label>
                        <textarea class="form-control" id="address" name="address"
                            rows="3">{{ $user->address ?? old('address') }}</textarea>
                    </div>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- CNIC -->
                    <div class="form-group">
                        <label for="cnic">CNIC <span class="text-info">(Optional)</span></label>
                        <input type="text" class="form-control" id="cnic" name="cnic"
                            value="{{ $user->cnic ?? old('cnic') }}">
                    </div>
                    @error('cnic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!--  basic_salary -->
                    <div class="form-group">
                        <label for="basic_salary"> Basic Salary</label>
                        <input type="number" value="{{ $user->basic_salary ?? old('basic_salary') }}"
                            class="form-control-file form-control" id="basic_salary" name="basic_salary">
                    </div>
                    @error('basic_salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!--  current_salary -->
                    <div class="form-group">
                        <label for="current_salary"> Current Salary</label>
                        <input type="number" value="{{ $user->current_salary ?? old('current_salary') }}"
                            class="form-control-file form-control" id="current_salary" name="current_salary">
                    </div>
                    @error('current_salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group">
                        <label for="ip_required">Ip Required</label>
                        <select name="ip_required" id="ip_required" class="form-control">
                            <option value="1" {{ $user->ip_required == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $user->ip_required == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                </div>
                <div class="col-lg-6">

                    <!-- About -->
                    <div class="form-group">
                        <label for="about">About <span class="text-info">(Optional)</span></label>
                        <textarea class="form-control" id="about" name="about"
                            rows="3">{{ $user->about ?? old('about') }}</textarea>
                    </div>
                    @error('about')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- User Skills -->
                    <div class="form-group">
                        <label for="user_skills">User Skills</label>
                        <input type="text" class="form-control" id="user_skills" name="user_skills"
                            value="{{ $user->user_skills ?? old('user_skills') }}">
                    </div>
                    @error('user_skills')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- Designation -->
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation"
                            value="{{ $user->designation ?? old('designation') }}">
                    </div>
                    @error('user_skills')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Order --}}
                    <div class="form-group">
                        <label for="order">Order:</label>
                        <select name="order" id="order" class="form-control">
                            @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}"
                                {{ ($user->order==$i) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <!-- Date of Birth (DOB) -->
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob"
                            value="{{ $user->dob ?? old('dob') }}">
                    </div>
                    @error('dob')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!-- Date of Joining (DOJ) -->
                    <div class="form-group">
                        <label for="doj">Date of Joining</label>
                        <input type="date" class="form-control" id="doj" name="doj"
                            value="{{ $user->doj ?? old('doj') }}">
                    </div>
                    @error('doj')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group">
                        <label for="show_in_attendence">Show in Attendance</label>
                        <select name="show_in_attendence" id="" class="form-control">
                            <option {{ ($user->show_in_attendence=='1') ? 'selected' : '' }} value="1">Yes</option>
                            <option {{ ($user->show_in_attendence=='0') ? 'selected' : '' }} value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="show_in_website">Show in Website</label>
                        <select name="show_in_website" id="" class="form-control">
                            <option {{ ($user->show_in_website=='1') ? 'selected' : '' }} value="1">Yes</option>
                            <option {{ ($user->show_in_website=='0') ? 'selected' : '' }} value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="role" class="w-100">Portal Role <span class="text-warning float-right">Not Visible in Website</span></label>
                        <select name="role" id="role" class="form-control">
                            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="team_lead" {{ $user->role == 'team_lead' ? 'selected' : '' }}>Team Leader</option>
                            <option value="finance" {{ $user->role == 'finance' ? 'selected' : '' }}>Finance Manager</option>
                            <option value="social_manager" {{ $user->role == 'social_manager' ? 'selected' : '' }}>Social Manager</option>
                            <option value="seo" {{ $user->role == 'seo' ? 'selected' : '' }}>SEO</option>
                        </select>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4">Edit Your Scoial Links</h4>
                <form action="{{ route('update.profile.links') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="github">Github</label>
                                <input type="text" class="form-control" id="github" name="github" placeholder="Github"
                                    value="{{ $user->github ?? '' }}">
                            </div>
                            @error('github')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="skype">Skype</label>
                                <input type="text" class="form-control" id="skype" name="skype" placeholder="Skype"
                                    value="{{ $user->skype ?? '' }}">
                            </div>
                            @error('skype')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    placeholder="Facebook" value="{{ $user->facebook ?? '' }}">
                            </div>
                            @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    placeholder="LinkedIn" value="{{ $user->linkedin ?? '' }}">
                            </div>
                            @error('linkedin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    placeholder="Instagram" value="{{ $user->instagram ?? '' }}">
                            </div>
                            @error('instagram')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    placeholder="Twitter" value="{{ $user->twitter ?? '' }}">
                            </div>
                            @error('twitter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</main>

@endsection
