@extends('layouts.dashboard')
@section('content')
<main role="main" class="main-content ">

    <div class="card p-4 my-4">
        <h1 class="py-4">View Message</h1>
        <div class="card p-4">
            <div class="row">
                <div class="col-3">
                    <h4> Name:</h4>
                </div>
                <div class="col-3">
                <p style="font-size: 17px">    {{ $view->name }}</p>
                </div>
                <div class="col-3">
                    <h4> Email: </h4>
                </div>
                <div class="col-3">
                 <p style="font-size: 17px">   {{ $view->email }}</p>
                </div>
                <div class="col-3 mt-3">
                    <h4>Message:</h4>
                </div>
                <div class="col-9 mt-3">
                   <p style="font-size: 17px"> {{ $view->message }}</p>
                </div>

            </div>
        </div>
        {{-- <div class="table-responsive">
            <table class="table table-striped text-dark table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>

                        <!-- Add other table headers for the fields you need -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($view as $messages)
                    <tr>
                        <td>{{$messages->id }}</td>
                        <td>{{ $messages->name }}</td>
                        <td>{{ $messages->email }}</td>
                        <td>{{ $messages->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}

    </div>

</main>

@endsection
