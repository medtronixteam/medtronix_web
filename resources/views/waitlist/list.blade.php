

@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h3 class="py-4">Waitlist</h3>

        <div class="table-responsive">
            <table id="" class="table table-striped text-dark table-hover dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Industry</th>
                        <th>Country</th>
                        <th>Registered At</th>
                        {{-- <th>Action</th> --}}

                        <!-- Add other table headers for the fields you need -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($waitlist as $waitlist)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $waitlist->name }}</td>
                        <td>{{ $waitlist->email }}
                        <br>{{ $waitlist->number }}</td>
                        <td>{{ $waitlist->company_name }}</td>
                        <td>{{ $waitlist->industry }}</td>
                        <td>{{ $waitlist->country }}</td>
                        <td>{{ $waitlist->created_at }}</td>
                        {{-- <td><a class="btn btn-primary" href="{{ route('appointment.view',$appointment->id) }}">View</a></td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</main>
@endsection

