@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h1 class="h3 mb-4 page-title">Profile</h1>
        <div class="card">
          <div class="row mt-5 align-items-center">
            <div class="col-md-3 text-center mb-5">
              <div class="avatar avatar-xl p-0 mt-3">
                <img src="{{ asset('storage/'.$user->picture) }}" alt="..." class="avatar-img" style="width: 200px; height: 200px">
              </div>
            </div>
            <div class="col-md-9">
              <table class="table table-bordered">
                <tr>
                  <th>Name</th>
                  <td>{{ $user->name ?? 'Name Not Added' }}</td>
                </tr>
                <tr>
                  <th>Designation</th>
                  <td>{{ $user->designation ?? 'Designation Not Added' }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{ $user->email ?? 'Email Not Added' }}</td>
                </tr>
                <tr>
                  <th>Basic Salary</th>
                  <td>{{ $user->basic_salary ?? 'Basic Salary Not Added' }}</td>
                </tr>
                <tr>
                  <th>About</th>
                  <td>{{ $user->about ?? 'About Not Added' }}</td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td>{{ $user->address ?? 'Address Not Added' }}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>{{ $user->phone ?? 'Phone Not Added' }}</td>
                </tr>
                <!-- Employee ID -->
                <tr>
                  <th>Employee ID</th>
                  <td>{{ $user->employee_id ?? 'Employee ID Not Added' }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- Social Links Section -->
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="d-flex align-items-center mx-3 mb-3">
              <div class="flex-fill">
                <h1 class="h4 pt-5">Social Links</h1>
              </div>
            </div>
            <table class="table table-striped table-borderless mb-4">
              <thead>
                <tr>
                  <th style="color: black">Social</th>
                  <th style="color: black">Links</th>
                </tr>
              </thead>
              <tbody>
                <!-- LinkedIn -->
                <tr>
                  <td><span class="fab fa-linkedin fe-24"></span><br> LinkedIn</td>
                  <td>
                    {{ $user->linkedin ?? 'linkedin Link Not Added' }}
                  </td>
                </tr>
                <!-- Other Social Links -->
                <tr>
                  <td><span class="fab fa-skype fe-24"></span><br> Skype</td>
                  <td>{{ $user->skype ?? 'Skype Link Not Added' }}</td>
                </tr>
                <tr>
                  <td><span class="fab fa-facebook fe-24"></span><br> Facebook</td>
                  <td>{{ $user->facebook ?? 'Facebook Link Not Added' }}</td>
                </tr>
                <tr>
                  <td><span class="fab fa-twitter fe-24"></span><br> Twitter</td>
                  <td>{{ $user->twitter ?? 'Twitter Link Not Added' }}</td>
                </tr>
                <tr>
                  <td><span class="fab fa-instagram fe-24"></span><br> Instagram</td>
                  <td>{{ $user->instagram ?? 'Instagram Link Not Added' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Previous Salary Slips Section -->
        <div class="row bg-white mt-3">
            <div class="col-md-12">
                <h2 class="h4 pt-5">Previous Salary Slips</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th style="color:black">Month</th>
                                <th style="color:black">Year</th>
                                <th style="color:black">Amount</th>
                                {{-- <th style="color:black">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->salarySlips as $slip)
                                <tr>
                                    <td>{{ $slip->salary_month }}</td>
                                    <td>{{ $slip->salary_year }}</td>
                                    <td>{{ $slip->total_salary }}</td>
                                    {{-- <td>
                                        <a href="{{ asset('storage/salary-slips/'.$slip->file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
</main>
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="card my-4 shadow-sm">
        <div class="card-header h2 text-center">
          <h2>Request List</h2>
        </div>
        <div class="table-responsive">
          <table id="requestTable" class="table table-striped text-dark">
            <thead>
              <tr class="text-dark text-center">
                <th>#</th>
                <th>Title</th>
                <th>Create By</th>
                <th>Details</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->title }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{!! Illuminate\Support\Str::limit($request->details, 30, '...') !!}</td>
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
                    {{-- <td class="text-center">
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
                    </td> --}}
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
{{-- @push('scripts')
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
@endpush --}}
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
