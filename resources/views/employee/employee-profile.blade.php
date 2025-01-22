@extends('layouts.employee')
@section('content')
<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4">Edit Your Profile Picture</h4>
                <form action="{{ route('mobile.updatePicture') }}" method="post"
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

                    <button type="submit" class="btn btn-primary">Update Picture</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card p-4 my-4">

        <form action="{{ route('mobile.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h4 class="py-4">Edit Your Profile Info</h4>
                </div>
                <div class="col-6">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name ?? old('phone') }}" required>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-6">
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
                </div>

                <div class="col-6">
                    <!-- Whatsapp Number -->
                    <div class="form-group">
                        <label for="whatsapp_number">whatsapp Number </span></label>
                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                            value="{{ $user->whatsapp_number ?? old('whatsapp_number') }}">
                    </div>
                    @error('whatsapp_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-6">
                    <!-- CNIC -->
                    <div class="form-group">
                        <label for="cnic">CNIC </span></label>
                        <input type="text" class="form-control" id="cnic" name="cnic"
                            value="{{ $user->cnic ?? old('cnic') }}">
                    </div>
                    @error('cnic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-6">
                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">Address </span></label>
                        <textarea class="form-control" id="address" name="address"
                            rows="3">{{ $user->address ?? old('address') }}</textarea>
                    </div>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-6">
                    <!-- About -->
                    <div class="form-group">
                        <label for="about">About </span></label>
                        <textarea class="form-control" id="about" name="about"
                            rows="3">{{ $user->about ?? old('about') }}</textarea>
                    </div>
                    @error('about')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4">Edit Your Scoial Links</h4>
                <form action="{{ route('mobile.profile.link') }}" method="post">
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

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card p-4 my-4 m-card">

        <form action="{{ route('mobile.reset.password') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h4 class="py-4">Reset Your Password</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="old_password" placeholder="Enter your password" name="old_password" required>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" data-target="#old_password"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" data-target="#new_password"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        @error('new_password')
                        <div class="alert alert-danger my-2" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>


    </div>

    <!-- .container-fluid -->
</main> <!-- main -->


@endsection
@push('js')

<script>
    const togglePassword = document.querySelectorAll('.toggle-password');

    togglePassword.forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('data-target'));
            const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
            target.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>

@endpush

<style>
    .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
        display: table-cell;
        vertical-align: middle;
        font-size: 1.3rem;
        font-weight: 500;
        font-family: Roboto;
    }

    .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title {
        display: table;
        table-layout: fixed;
        height: 100%;
    }

    .m-portlet .m-portlet__head .m-portlet__head-caption {
        display: table-cell;
        vertical-align: middle;
        text-align: left;
    }

    .m-portlet .m-portlet__head {
        display: table;
        padding: 0;
        width: 100%;
        padding: 0 2.2rem;
        height: 5.1rem;
    }

    .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
        display: table-cell;
        vertical-align: middle;
        font-size: 1.3rem;
        font-weight: 500;
        font-family: Roboto;
    }

    .m-portlet .m-portlet__body {
        padding: 2.2rem 2.2rem;
    }

    .mCSB_container {
        overflow: hidden;
        width: auto;
        height: auto;
    }

    .mCustomScrollBox {
        position: relative;
        overflow-y: scroll;
        height: 70%;
        max-height: 100% max-width: 100%;
        outline: none;
        direction: ltr;
    }

    .m-portlet .m-portlet__body {
        color: black;
    }

    .m-timeline-3 .m-timeline-3__item {
        disply: table;
        margin-bottom: 1rem;
        position: relative;
    }

    .m-timeline-3__item.m-timeline-3__item--success:before {
        background: #34bfa3;
    }

    .m-timeline-3 .m-timeline-3__item:before {
        position: absolute;
        display: block;
        width: 0.28rem;
        -webkit-border-radius: 0.3rem;
        -moz-border-radius: 0.3rem;
        -ms-border-radius: 0.3rem;
        -o-border-radius: 0.3rem;
        border-radius: 0.3rem;
        height: 70%;
        left: 5.1rem;
        top: 0.46rem;
        content: "";
    }

    .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-time {
        display: table-cell;
        vertical-align: top;
        padding-top: 0.6rem;
        font-weight: 500;
        font-size: 16px;
        position: absolute;
        text-align: right;
        width: 3.57rem;
    }

    .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
        display: table-cell;
        width: 100%;
        vertical-align: top;
        font-size: 1rem;
        padding-left: 7rem;
    }

    .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
        display: table-cell;
        width: 100%;
        vertical-align: top;
        font-size: 1rem;
        padding-left: 7rem;
    }

    .m-link.m-link--metal {
        color: #c4c5d6;
    }

    .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc .m-timeline-3__item-user-name .m-timeline-3__item-link {
        font-size: 0.85rem;
        text-decoration: none;
    }

    .newstext {
        color: black !important;
        cursor: pointer;
    }

    /* Modify the scrollbar styles */
    .mCustomScrollBox::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    .mCustomScrollBox::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .mCustomScrollBox::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .mCustomScrollBox::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .btn.btn-secondary {
        background: white;
        border-color: #ebedf2;
        color: #212529;
    }

    .btn-secondary {
        color: #212529;
        background-color: #ebedf2;
        border-color: #ebedf2;
        font-size: 14px;
        padding: 10px;
        border-radius: 15px;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.65rem 1rem;
        font-size: 1rem;
        line-height: 1.25;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
