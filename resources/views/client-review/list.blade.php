@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h3 class="py-4">List of Reviews</h3>

        <div class="table-responsive">
            <table class="table table-striped text-dark table-hover dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>category</th>
                        <th>Client message</th>
                        <th>status</th>
                        <td>Action</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>
                            @if($review->picture)
                            <img src="{{ asset('storage/' . $review->picture) }}" alt="Review Picture" width="50">
                            @else
                            No Picture
                            @endif
                        </td>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->category }}</td>

                        <td>{{  Str::limit($review->client_message, $limit = 50, $end = '...') }}</td>
                        <td>{{ $review->status == 1 ? 'Active' : 'Inactive' }}</td>

                        <td class="text-center">
                            <div class="btn-group">
                                <a type="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('review.edit',$review->id) }}">Edit</a>

                                    <form method="POST" action="{{ route('review.delete',$review->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this Review?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>



                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</main>

@endsection
