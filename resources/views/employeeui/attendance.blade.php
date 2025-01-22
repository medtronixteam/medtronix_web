@push('js')
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('522eece01cd7e27ffc66', {
            cluster: 'ap2'
        });
        //showPushNotification('Test Notification', 'This is a test notification!');
        var channel = pusher.subscribe('checkChannel');
        channel.bind('CheckNotify', function(data) {
            console.log(data);
            showPushNotification('Medtronix System', data.message);
        });

        $(document).ready(function() {
            // Attach change event listener to the month input field
            $('#month').change(function() {
                // Submit the form when a month is selected
                $('#filterForm').submit();
            });
        });
    </script>
@endpush

@extends('layouts.ui')
@section('content')
    <main role="main" class="main-content mt-4">

        <div class="card p-4 my-4">
            <div class="row justify-content-between align-items-center">
                @if (!empty($monthData) && isset($monthData[0]))
                    <h1 class="py-4 col-sm-4"> {{ \Carbon\Carbon::parse($monthData[0]['attendance_date'])->format('M,Y') }}
                        Attendances <p class="h3">({{ $monthData[0]->employee->name }})</p>
                    </h1>
                @else
                    <h3 class="py-4 col-sm-4">No Attendance Data Available</h3>
                @endif
                <div class="col-sm-6 d-print-none">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="month">Month</label>
                            <!-- Use a single input field for month and year -->
                            <form id="filterForm" method="GET" action="">
                                <input type="month" value="{{ $year }}-{{ $month }}" class="form-control"
                                    id="month" name="month">
                            </form>
                        </div>
                    </div>

                </div>
                <button style="width: 100px;" onclick="window.print()" type="button" class="btn btn-dark d-print-none ml-auto ">Print</button>
            </div>
            <div class="row">
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Presents: <span class="badge badge-success">{{ $presentCount }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Absents: <span class="badge badge-danger">{{ $absentCount }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Leaves: <span class="badge badge-info">{{ $leaveCount }}</span></h5>
                </div>
            </div>

            <div class="row mb-4">
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Work from Home: <span class="badge badge-warning">{{ $workFromHomeCount }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    {{-- {{ dd($holidayCount) }} --}}
                    <h5>Holidays: <span class="badge badge-primary">{{ $holidayCount }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Remotely: <span class="badge badge-secondary">{{ $remotelyCount }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Half Leave: <span class="badge badge-info">{{ $halfLeaves }}</span></h5>
                </div>

                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Total Hours: <span class="badge badge-info">{{ $presentDaysCount * 8 }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Working Hours: <span class="badge badge-info">{{ $formattedTotalHours }}</span></h5>
                </div>
                <div class="card m-2 col-sm-3 pt-2 border-1">
                    <h5>Extra Hours: <span class="badge  badge-secondary text-white">{{ $totalExtraHours }}</span></h5>
                </div>

                <div class="card m-2 col-sm-4 pt-2 border-1">
                    <h5>Yearly leaves available: <span class="badge badge-info">{{ $yearlyLeavesAvailable }}</span></h5>
                </div>
            </div>

            <div class="row">
                @foreach ($monthData as $day)
                    <div class="col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-header ">
                                {{ \Carbon\Carbon::parse($day['attendance_date'])->format('l, jS') }}

                            </div>
                            <div class="card-body">
                                @php
                                    $checkin = '';
                                    $time = \Carbon\Carbon::parse($day['check_in']);
                                    $totalHours = 0;
                                    if ($day['check_out'] !== null && $day['check_in'] != null) {
                                        $checkin = \Carbon\Carbon::parse($day['check_in'])->format('h:i A'); // AM/PM format
                                        $checkout = \Carbon\Carbon::parse($day['check_out'])->format('h:i A'); // AM/PM format

                                        // Calculate total hours
                                        $checkinTime = \Carbon\Carbon::parse($day['check_in']);
                                        $checkoutTime = \Carbon\Carbon::parse($day['check_out']);

                                        $totalHours = $checkoutTime->diffInHours($checkinTime);
                                        // Check if checkout is the next day
                                        if ($checkoutTime->lt($checkinTime)) {
                                            $checkoutTime->addDay();
                                        }

                                        $difference = $checkoutTime->diff($checkinTime);
                                        $totol_working_in_hours = $difference->h * 60 + $difference->i;
                                        $hours = intdiv($totol_working_in_hours, 60);
                                        $minutes = $totol_working_in_hours % 60;
                                        $totalHours = $hours . ':' . $minutes;
                                    } else {
                                        if ($day['status'] === 'present'):
                                            $checkin = \Carbon\Carbon::parse($day['check_in'])->format('h:i A'); // AM/PM format
                                        endif;
                                    }
                                @endphp

                                @if ($day['status'] === 'present')
                                    @if ($time->greaterThan(\Carbon\Carbon::parse('09:59:00')))
                                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-danger h5">Check
                                            in : <b>{{ $checkin }}</b></span>
                                    @else
                                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-success h5">Check
                                            in : <b>{{ $checkin }}</b></span>
                                    @endif
                                    <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-success h5">Check out
                                        :
                                        @if (!is_null($day['check_out']))
                                            <b>{{ $checkout }}</b>
                                        @else
                                            <b>N/A</b> <!-- Display "N/A" if check-out time is not available -->
                                        @endif
                                    </span>
                                    <!-- Display Extra Hours -->
                                    <span style="width: 100%; font-size: 15px;"
                                        class="p-2 badge badge-dark text-white h5">Total Hours:
                                        <b>{{ $totalHours }}</b></span>

                                    <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-info h5">Extra Hours:
                                        <b>{{ $day['extra_hours'] }}</b></span>
                                @elseif($day['status'] === 'absent')
                                    <span class="py-2 badge badge-warning"
                                        style="width: 100%; font-size: 15px;">Absent</span>
                                    <br>
                                @elseif($day['status'] === 'leave')
                                    <span class="py-2 badge badge-secondary"
                                        style="width: 100%; font-size: 15px;">Leave</span>
                                    <br>
                                @elseif($day['status'] === 'work_from_home')
                                    <span class="py-2 badge badge-primary" style="width: 100%; font-size: 15px;">Work from
                                        home</span>
                                    <br>
                                @elseif($day['status'] === 'remotely')
                                    <span class="py-2 badge badge-dark" style="width: 100%; font-size: 15px;">Remotly</span>
                                    <br>
                                @elseif($day['status'] === 'holiday')
                                    <span class="py-2 badge badge-info" style="width: 100%; font-size: 15px;">Holiday</span>
                                    <br>
                                @else
                                    <span class="py-2 badge badge-success" style="width: 100%; font-size: 15px;">Half
                                        Leave</span>
                                    <br>
                                @endif
                                {{ $day['remarks'] }}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
