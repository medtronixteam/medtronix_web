@extends('layouts.dashboard')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="card my-4 shadow-sm">
      <div class="card-header h2 text-center">
        <h3>Job Request</h3>
      </div>
      <div class="p-3 table-responsive">
        <table id="requestTable" class="table table-striped text-dark table-hover dataTable">
          <thead>
            <tr class="text-dark text-center">
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Experience</th>
              <th>Position applied</th>
              <th>Apply at</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($requests as $request)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $request->first_name }} {{ $request->last_name }}</td>
              <td>{{ $request->email }} </td>
              <td>{{ $request->experience }} </td>
              <td>{{ $request->position_applied }} </td>

              {{-- <td>{!! Illuminate\Support\Str::limit($request->details, 30, '...') !!}</td> --}}
              <td>{{ $request->created_at}}</td>



            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
  </div>
</main>
@endsection

