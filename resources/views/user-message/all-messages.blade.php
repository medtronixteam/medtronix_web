@extends('layouts.dashboard')
@section('content')
<main role="main" class="main-content ">

    <div class="card p-4 my-4">
        <h3 class="py-4">Contact Us Messages</h3>

        <div class="table-responsive">
            <table id="employeeTable" class="table table-striped text-dark table-hover dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>More</th>

                        <!-- Add other table headers for the fields you need -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $messages)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{ $messages->name }}</td>
                        <td>{{ $messages->email }}</td>
                        <td>{{ Str::limit($messages->message, 10) }}</td>
                        <td>
                            <a href="{{ route('message.delete',$messages->id) }}" class="btn btn-danger p-2">Delete</a>
                            <a href="{{ route('message.view',$messages->id) }}" class="btn btn-success p-2  ">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</main>

@endsection
