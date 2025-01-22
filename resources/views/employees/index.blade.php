@extends('layouts.dashboard')
<style>
    .employee:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px !important;
    }

</style>
@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h3 class="py-4">List of Employees</h3>


        <div class="row">
            @foreach($employees as $employee)
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 my-2">
                <div class="card employee border-0 p-0" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;">
                    @if ($employee->picture)
                    <div class="text-center">
                        <img class="img-fluid rounded mt-2" style=" width:180px; height:150px; " src="{{ asset('storage/' . $employee->picture) }}" alt="User Profile Picture">

                    </div>
                    @else
                    <div class="text-center">
                        <img class="img-fluid rounded mt-2"
                             style="width:180px; height:150px;"
                             src="{{ asset('storage/' . $employee->picture) }}"
                             onerror="this.onerror=null; this.src='{{ asset('assets/images/placeholder.jpg') }}';"
                             alt="User Profile Picture">
                    </div>

                    @endif
                    <div class="card-body pl-3 ">
                        <h6 style="height:35px;" class="card-title mb-0">
                            {{ $employee->name }}
                            @if ($employee->email_verified_at)
                                <span style="color: green; font-size: 18px;">✔️</span>
                            @else
                                <span style="color: red; font-size: 14px;">(Not Verified)</span>
                            @endif
                        </h6>
                        <p style="height:35px;" class="card-text ">{{ $employee->designation }}</p>
                    </div>




                    <div class="px-2 d-flex justify-content-between align-items-center">
                        <a class="btn btn-info" href="{{ route('employees.show', $employee->id) }}">Info</a>
                        <a class="btn btn-primary" href="{{ route('work.detail',$employee->id) }}">Work History</a>
                        <div class="btn-group">
                            <a class="btn btn-light " type="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('attendances.user',$employee->id) }}" class="dropdown-item">View Attendance</a>

                                @if (!$employee->has_salary_slip)
                                <a class="dropdown-item" href="{{ route('salary_slips.create', $employee->id) }}">Create
                                    Salary</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}" data-toggle="modal" data-target="#resetPasswordModal" data-whatever="{{ $employee->id }}" data-email="{{ $employee->email }}">Reset Password</a>
                                <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                <!-- Button trigger modal -->
                                <a type="button" onclick="addIncrement(` {{ $employee->name }}` ,`{{ $employee->id }}`)" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                    Add Increment
                                </a>
                                <a href="{{ route('incrementList',$employee->id) }}" class="dropdown-item">
                                    Increment list
                                </a>

                                <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                                <form method="POST" action="{{ route('employees.toggle', $employee->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="{{ $employee->is_disabled === 'yes' ? 'enable' : 'disable' }}">
                                    <button type="submit" class="dropdown-item {{ $employee->is_disabled === 'yes' ? 'text-primary' : 'text-danger' }}">
                                        {{ $employee->is_disabled === 'yes' ? 'Enable User' : 'Disable User' }}
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Increment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>Employee Name</h5>
                            <p id="empName"></p>
                        </div>
                        <div class="col-12">
                            <form id="addIncrementForm"  action="{{ route('add.increment') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <input type="text" name="employee_id" id="empId" value="" hidden >
                                    <h6 >Add Amount </h6>
                                    <input type="number" name="increment" class="form-control" placeholder="Add Increment" required>
                                    <button id="submitForm" type="submit" class="btn mt-2 btn-info">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{route('employee.password.reset')}}">
                @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="employee_id" id="employee_idi">
            <h5 id="employeeEmail">Email Not Added</h5>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password:</label>
                <input type="text" name="password" class="form-control" >
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Confirm Password:</label>
                <input type="text" name="password_confirm" class="form-control" >
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Change Password</button>
          </div>
        </form>
        </div>
      </div>
    </div>
</main>

@endsection

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function addIncrement(name, id) {
        $('#empName').text(name);
        $('#empId').val(id);
        $('#exampleModal').modal('show');
    }

    function showFlashMessage() {
        var flashMessage = $('<div>').addClass('flashy').text('Stock updated');

        // Append the flash message to the body
        $('body').append(flashMessage);
        setTimeout(function() {
            flashMessage.remove();
        }, 3000);
    }
    </script>
    <script>

    $(document).ready(function() {
        $('#addIncrementForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            var formData = $(this).serialize(); // Serialize form data
            var url = $(this).attr('action'); // Get form action URL

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success) {

                        $('#exampleModal').modal('hide');

                        showFlashMessage();

                    } else {
                        // Show error message
                        alert('Error: ' + response.error);
                    }
                },
                error: function(error) {
                    // Handle AJAX errors
                    console.error('AJAX request failed:', error);
                }
            });
        });
    });

    // Function to show flash message
    function showFlashMessage() {
        var flashMessage = $('<div>').addClass('flashy').text('Increment added');
        $('body').append(flashMessage);
        setTimeout(function() {
            flashMessage.remove();
        }, 3000);
    }

    $('#resetPasswordModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('whatever'); // Extract info from data-* attributes
    var email = button.data('email'); // Extract email from data-* attributes
    var modal = $(this);

    modal.find('.modal-body #employee_idi').val(recipient);
    modal.find('.modal-body #employeeEmail').text(email || 'Email Not Added'); // Set the email or a default message
});

    </script>
    @endpush

