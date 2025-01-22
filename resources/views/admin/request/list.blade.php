@extends('layouts.dashboard')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="card my-4 shadow-sm">
      <div class="card-header h2 text-center">
        <h3>Request List</h3>
      </div>
      <div class="p-3 table-responsive">
        <table id="requestTable" class="table table-striped text-dark table-hover dataTable">
          <thead>
            <tr class="text-dark text-center">
              <th>#</th>
              <th>Title</th>
              <th>Create By</th>
              {{-- <th>Details</th> --}}
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($requests->sortByDesc('created_at') as $request)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $request->title }}</td>
              <td>
                @php
                $user = App\Models\User::find($request->user_id);
                @endphp
                @if($user)
                {{ $user->name }}
                @else
                User not found
                @endif
              </td>
              {{-- <td>{!! Illuminate\Support\Str::limit($request->details, 30, '...') !!}</td> --}}
              <td>{{ $request->created_at->format('d M Y') }}</td>


              <td>
                @php
                $statusClass = '';
                $statusText = ucfirst($request->status);
                switch ($request->status) {
                case 'pending':
                $statusClass = 'badge-warning';
                break;
                case 'approved':
                $statusClass = 'badge-primary';
                break;
                case 'rejected':
                $statusClass = 'badge-danger';
                break;
                }
                @endphp
                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
              </td>
              <td class="text-center">
                <div class="btn-group">
                  <a type="button" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                  </a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('requests.show', $request->id) }}">View</a>
                    @if ($request->status === 'pending')
                    <form action="{{ route('request.approve', $request->id) }}" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item badge-primary">Approve</button>
                    </form>
                    <form action="{{ route('request.reject', $request->id) }}" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item badge-danger mt-2">Reject</button>
                    </form>
                    @elseif ($request->status === 'approved')
                    <form action="{{ route('request.reject', $request->id) }}" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item badge-danger mt-2">Reject</button>
                    </form>
                    @elseif ($request->status === 'rejected')
                    <form action="{{ route('request.approve', $request->id) }}" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item badge-primary">Approve</button>
                    </form>
                    @endif
                  </div>


                </div>
              </td>
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

@push('scripts')


<script>
  $(document).ready(function() {
      $('.approve-btn').click(function(e) {
          e.preventDefault();
          var requestId = $(this).data('id');
          $.ajax({
              type: 'POST',
              url: '/admin/approve/' + requestId,
              success: function(data) {
                  // Optionally, update the UI to reflect the change in status
              },
              error: function(xhr, status, error) {
                  // Handle errors
              }
          });
      });

      $('.reject-btn').click(function(e) {
          e.preventDefault();
          var requestId = $(this).data('id');
          $.ajax({
              type: 'POST',
              url: '/admin/reject/' + requestId,
              success: function(data) {
                  // Optionally, update the UI to reflect the change in status
              },
              error: function(xhr, status, error) {
                  // Handle errors
              }
          });
      });
  });
</script>
@endpush

@push('css')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<style scoped>
  .table thead th {
    color: black;
    font-size: 15px;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
    display: table-cell;
    vertical-align: middle;
    font-size: 1.3rem;
    font-weight: 500;
    font-family: Roboto;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title {
    display: table;
    table-layout: fixed;
    height: 100%;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption {
    display: table-cell;
    vertical-align: middle;
    text-align: left;
  }

  .m-portlet .m-portlet__head {
    display: table;
    padding: 0;
    width: 100%;
    padding: 0 2.2rem;
    height: 5.1rem;
  }

  .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
    display: table-cell;
    vertical-align: middle;
    font-size: 1.3rem;
    font-weight: 500;
    font-family: Roboto;
  }

  .m-portlet .m-portlet__body {
    padding: 2.2rem 2.2rem;
  }

  .mCSB_container {
    overflow: hidden;
    width: auto;
    height: auto;
  }

  .mCustomScrollBox {
    position: relative;
    overflow-y: hidden;
    height: 100%;

    max-height: 100% max-width: 100%;
    outline: none;
    direction: ltr;
  }

  .m-portlet .m-portlet__body {
    color: black;
  }

  .m-timeline-3 .m-timeline-3__item {
    disply: table;
    margin-bottom: 2rem;
    position: relative;
  }

  .m-timeline-3__item.m-timeline-3__item--success:before {
    background: #34bfa3;
  }

  .m-timeline-3 .m-timeline-3__item:before {
    position: absolute;
    display: block;
    width: 0.28rem;
    -webkit-border-radius: 0.3rem;
    -moz-border-radius: 0.3rem;
    -ms-border-radius: 0.3rem;
    -o-border-radius: 0.3rem;
    border-radius: 0.3rem;
    height: 70%;
    left: 0.1rem;
    top: 0.46rem;
    content: "";
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-time {
    display: table-cell;
    vertical-align: top;
    /* padding-top: 0.6rem; */
    font-weight: 500;
    font-size: 16px;
    position: absolute;
    text-align: right;
    width: 3.57rem;
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
    display: table-cell;
    width: 100%;
    vertical-align: top;
    font-size: 1rem;
    padding-left: 1rem;
  }



  .m-link.m-link--metal {
    color: #c4c5d6;
  }

  .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc .m-timeline-3__item-user-name .m-timeline-3__item-link {
    font-size: 0.85rem;
    text-decoration: none;
  }

  .newstext {
    color: black !important;
    cursor: pointer;
  }

  /* Modify the scrollbar styles */
  .mCustomScrollBox::-webkit-scrollbar {
    width: 6px;
  }

  /* Track */
  .mCustomScrollBox::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  /* Handle */
  .mCustomScrollBox::-webkit-scrollbar-thumb {
    background: #888;
  }

  /* Handle on hover */
  .mCustomScrollBox::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  .btn.btn-secondary {
    background: white;
    border-color: #ebedf2;
    color: #212529;
  }

  .btn-secondary {
    color: #212529;
    background-color: #ebedf2;
    border-color: #ebedf2;
    font-size: 14px;
    padding: 10px;
    border-radius: 15px;
  }

  .btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.65rem 1rem;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
