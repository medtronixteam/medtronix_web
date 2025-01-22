

@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h1 class="py-4">Appointment</h1>

        <div class="table-responsive">
            <table id="" class="table table-striped text-dark table-hover dataTable">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Desc</th>
                        <th>Action</th>

                        <!-- Add other table headers for the fields you need -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->department }}</td>
                        <td style="max-width: 100px !important; overflow: hidden !important; white-space: nowrap !important; text-overflow: ellipsis !important;">{{ $appointment->message }}</td>
                        {{-- <td>{{ $appointment->message }}</td> --}}
                        <td><a class="btn btn-primary" href="{{ route('appointment.view',$appointment->id) }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p><strong>Name:</strong> <span id="appointmentName"></span></p>
                    <p><strong>Email:</strong> <span id="appointmentEmail"></span></p>
                    <p><strong>Department:</strong> <span id="appointmentDepartment"></span></p>
                    <p><strong>Description:</strong> <span id="appointmentMessage"></span></p>
                    <!-- Add other fields as necessary --->
                </div>

            </div>
        </div>
    </div>


</main>

@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.view-appointment').on('click', function () {
            var appointmentId = $(this).data('id');
            // Fetch the appointment details using AJAX
            $.ajax({
                url: '{{ url("appointment/view") }}/' + appointmentId,
                method: 'GET',
                success: function (data) {
                    // Populate the modal with the data
                    $('#appointmentName').text(data.name);
                    $('#appointmentEmail').text(data.email);
                    $('#appointmentDepartment').text(data.department);
                    $('#appointmentMessage').text(data.message);
                    // Show the modal
                    $('#appointmentModal').modal('show');
                },
                error: function (error) {
                    console.error('Error fetching appointment details:', error);
                }
            });
        });
    });
</script>


@endpush
