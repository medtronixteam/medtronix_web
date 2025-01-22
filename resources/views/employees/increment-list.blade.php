



@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">
    <h3 class="text-white p-4 bg-primary">List of Increments</h3>
    <div class="card p-4 ">

        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <td>Name</td>
                        <th>Increment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($user->increments as $increment)
                    <tr>
                        <td>{{ $increment->id }}</td>
                        <td>{{ $increment->created_at->toDateString() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $increment->increment }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-light " type="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">


                                    <a class="dropdown-item" href="{{ route('edit.increment',$increment->id) }}">Edit</a>






                                    <form method="POST" action="{{ route('increment.delete', $increment->id) }}" class="d-inline">
                                        @csrf

                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this Increment?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No increments found.</td>
                    </tr>

                @endforelse
                </tbody>
            </table>
            {{-- <div class="row">
                <div class="col-sm-12">
                     {!! $salarySlips->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div> --}}
        </div>

    </div>

</main>

@endsection
