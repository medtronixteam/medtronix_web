@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">

                <h3>Add Employee</h3>
                <hr>

                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $error)
                  <div class="alert alert-primary my-1">{{ $error }}</div>
                @endforeach

                    <div class="col-12">
                        <h5 class="">Authentication  <span class="text-info h4">(Required)</span></h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                                   <!-- Name -->
                                   <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                 <!-- Phone -->
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="doj">Show in Attendance</label>
                                        <select name="show_in_attendence" id="" class="form-control" >
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="doj">Show in Website</label>
                                        <select name="show_in_website" id="" class="form-control" >
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                                <!-- Designation -->
                            <div class="form-group">
                                <label for="designation " class="w-100">Designation  <span class="text-warning float-right">Visible in Website</span></label>
                                <input type="text" class="form-control" id="designation" name="designation">

                            </div>
                            @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <!-- end of row -->
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">

                                        <label for="email " class="w-100">Email  <span class="text-warning float-right">Employee Actual Mail</span></label>

                                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="A verification mail will be sent to employee for verification" required>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="password" class="w-100">Password
                                        <span class="text-warning float-right">Employee portal Password</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="doj">Ip Required</label>
                                        <select name="ip_required" id="" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      {{-- Order --}}
                             <div class="form-group">

                                <label for="Order " class="w-100">Order  <span class="text-warning float-right"> Sorting Employee  </span> </label>
                                <select name="order" id="order" class="form-control">
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                </select>

                            </div>
                            @error('order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                </div>
                            </div>
                              <!-- Designation -->
                              <div class="form-group">
                                <label for="designation " class="w-100">Portal Role  <span class="text-warning float-right">Not Visible in Website</span></label>
                               <select name="role" id="role" class="form-control">
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                                <option value="team_lead">Team Leader</option>
                                <option value="finance">Finance Manager</option>
                                <option value="social_manager">Social Manager</option>
                                <option value="seo">SEO</option>
                               </select>

                            </div>
                            @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <!-- end of row -->
                        <div class="col-sm-4">
                            <!-- Email -->

                    </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h5 class="">Basic Information </h5>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Whatsapp Number -->
                            <div class="form-group">
                                <label for="whatsapp_number">whatsapp Number <span class="text-info">(Optional)</span></label>
                                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number">
                            </div>

                            @error('whatsapp_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <!-- Address -->
                            <div class="form-group">
                                <label for="address">Address <span class="text-info">(Optional)</span></label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <!-- Picture -->
                            <div class="form-group">
                                <label for="picture">Profile Picture <span class="text-info">(Optional)</span></label>
                                <input type="file" class="form-control-file" id="picture" name="picture">
                            </div>
                            @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!--  basic_salary -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basic_salary"> Basic Salary</label>
                                        <input type="number" class="form-control-file form-control" id="basic_salary" name="basic_salary">
                                    </div>
                                    @error('basic_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                                  <!--  current_salary -->
                            <div class="form-group">
                                <label for="current_salary"> Current Salary</label>
                                <input type="number" class="form-control-file form-control" id="current_salary" name="current_salary">
                            </div>
                            @error('current_salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                </div>
                            </div>




                        </div>
                        <div class="col-lg-6">
                            <!-- CNIC -->
                            <div class="form-group">
                                <label for="cnic">CNIC <span class="text-info">(Optional)</span></label>
                                <input type="text" class="form-control" id="cnic" name="cnic">
                            </div>
                            @error('cnic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!-- About -->
                            <div class="form-group">
                                <label for="about">About <span class="text-info">(Optional)</span></label>
                                <textarea class="form-control" id="about" name="about" rows="3"></textarea>
                            </div>
                            @error('about')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!-- User Skills -->
                            <div class="form-group">
                                <label for="user_skills">User Skills <span class="text-info">(Visible in Website)</span></label>
                                <input type="text" class="form-control" id="user_skills" name="user_skills">
                            </div>
                            @error('user_skills')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          <div class="row">
                            <div class="col-6">
                                  <!-- Date of Birth (DOB) -->
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="col-6">
                                             <!-- Date of Joining (DOJ) -->
                            <div class="form-group">
                                <label for="doj">Date of Joining</label>
                                <input type="date" class="form-control" id="doj" name="doj">
                            </div>
                            @error('doj')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                          </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="py-4 pt-5">Social Links <span class="text-info h4">(Optional)</span></h5>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram">
                            </div>
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- GitHub -->
                            <div class="form-group">
                                <label for="github">GitHub</label>
                                <input type="text" class="form-control" id="github" name="github">
                            </div>

                            <!-- Skype -->
                            <div class="form-group">
                                <label for="skype">Skype</label>
                                <input type="text" class="form-control" id="skype" name="skype">
                            </div>

                            <!-- Social Links -->
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye / eye slash icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>
@endpush

