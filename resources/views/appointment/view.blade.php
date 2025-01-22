@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h1>Appointment View</h1>
                <div>
                    <a class="btn btn-dark" href="{{ route('appointment.list') }}">Back</a>
                </div>
                </div>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td>{{ $appointments->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $appointments->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $appointments->phone }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $appointments->department }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{ $appointments->message }}</td>
                    </tr>
                </table>


            </div>
        </div>
    </div>
</main>

@endsection
