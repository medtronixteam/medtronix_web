@extends('layouts.ui')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    {{-- <div class="col">
                        <h2 class="h5 page-title">Welcome!</h2>
                    </div> --}}
                    {{-- <div class="col-auto">
                        <form class="form-inline">
                            <div class="form-group d-none d-lg-inline">
                                <label for="reportrange" class="sr-only">Date Ranges</label>
                                <div id="reportrange" class="px-2 py-2 text-muted">
                                    <span class="small"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                                <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                            </div>
                        </form>
                    </div> --}}
                </div>

            </div>
            <div class="col-6 dashboard-card-set">
                <div class="row">
                    {{-- Total Employee🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-info">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Total Employee</small>
                                        <h3 class="card-title text-white mb-0">{{$totalEmployee}}</h3>
                                        <br>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlineline"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div> <!-- /. card-body -->
                        </div> <!-- /. card -->
                    </div>
                    {{-- Today Present🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-success">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Today Present</small>
                                        <h3 class="card-title mb-0 text-white">{{ $presentAttendanceCount }}</h3>
                                        {{-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-warning"></span><span>10 Last
                                                Day</span></p> --}}
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinepie"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div> <!-- /. card-body -->
                        </div> <!-- /. card -->
                    </div>
                    {{-- Today Absents🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-danger">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Today Absents</small>
                                        <h3 class="card-title text-white mb-0">{{ $absentAttendanceCount }}</h3>
                                        {{-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>3 Last Day</span> --}}
                                        </p>
                                    </div>
                                    <div class="col-4 text-right ">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div> <!-- /. card-body -->
                        </div> <!-- /. card -->
                    </div>
                    {{-- Today Requests 🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-nuted mb-1"> Today Requests</small>
                                        <h3 class="card-title mb-0">{{ $totalRequest }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div>
                        </div>
                    </div>
                    {{-- Today Requests 🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-primary">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1"> Today Pending Tasks</small>
                                        <h3 class="card-title text-white mb-0">{{$todayPendingTaskCount }} </h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div>
                        </div>
                    </div>
                    {{-- Pending Tasks  🛑 --}}
                    {{-- Today Appiontments  🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-secondary">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Today Appiontments </small>
                                        <h3 class="card-title text-white mb-0">{{ $todayAppointment }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div>
                        </div>
                    </div>
                    {{-- Wait List  🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-warning">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Wait List </small>
                                        <h3 class="card-title text-white mb-0">{{ $wait }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div>
                        </div>
                    </div>
                    {{-- Cotact Messages  🛑 --}}
                    <div class="col-md-6">
                        <div class="card shadow mb-4 bg-info">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-white mb-1">Contact Messages </small>

                                        <h3 class="card-title text-white mb-0">{{ $message }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="sparkline inlinebar"></span>
                                    </div>
                                </div> <!-- /. row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                {{-- system notification --}}
                <div class="card shadow mb-4">
                    <div class="card-header h5">
                        System Notifications
                    </div>
                    <div class="card-body">
                        <table class="table">
                            @foreach ($notifications as $noti)
                            <tr>
                                <td style="width: 100%; overflow:auto;">{{ \Illuminate\Support\Str::limit($noti->heading, 50) }}</td>
                                <td>{{$noti->date}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{-- Upcoming Msg notification --}}
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Upcoming Events</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Event</th>
                                    <th>Birthday/Date</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Danish</td>
                                    <td>18-04-2006</td>
                                    <td>30-10-2024</td>
                                </tr>
                            </tbody> --}}
                            <tbody>
                            @forelse ($upcomingEvents as $index => $employee)
                            @if (!empty($employee->dob) && \Carbon\Carbon::parse($employee->dob)->format('m') ==
                            now()->format('m'))
                            <tr>
                                <td>{{ $index + 1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>Birthday</td>
                            <td>
                                {{ \Carbon\Carbon::parse($employee->dob)->format('M d, Y') }}

                            </td>
                            </tr>
                            @endif

                            @if (!empty($employee->doj) && \Carbon\Carbon::parse($employee->doj)->format('m') ==
                            now()->format('m'))
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>Joining</td>
                                <td>

                                    {{ \Carbon\Carbon::parse($employee->doj)->format('M d, Y') }}

                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="4">No upcoming events found.</td>
                            </tr>
                            @endforelse
                            </tbody>


                        </table>
                    </div> <!-- / .card-body -->
                </div>
            </div>
        </div>
    </div> <!-- .row -->
    </div> <!-- .container-fluid -->

</main> <!-- main -->

@endsection
