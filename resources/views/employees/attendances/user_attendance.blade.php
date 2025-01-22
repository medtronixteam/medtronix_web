@push('js')
<script>
    $(document).ready(function() {
        // Attach change event listener to the month input field
        $('#month').change(function() {
            // Submit the form when a month is selected
            $('#filterForm').submit();
        });
    });

</script>
@endpush

@extends('layouts.dashboard')
@section('content')
<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row justify-content-between align-items-center">
            @if (!empty($monthData) && isset($monthData[0]))
            <h1 class="py-4 col-sm-4"> {{ \Carbon\Carbon::parse($monthData[0]['attendance_date'])->format('M,Y') }}
                Attendances <p class="h3">({{ $monthData[0]->employee->name }})</p>
            </h1>
            @else
            <h3 class="py-4 col-sm-6">No Attendance Data Available</h3>
            @endif
            <div class="col-sm-4 d-print-none">
                    <div class="form-group">
                        <label for="month">Month</label>
                        <!-- Use a single input field for month and year -->
                        <form id="filterForm" method="GET" action="">
                            <input type="month" value="{{ $year }}-{{ $month }}" class="form-control" id="month" name="month">
                        </form>
                </div>

            </div>
            <div class="d-flex justify-content-end mb-2">
                <button onclick="window.print()" type="button" class="btn btn-dark d-print-none w-md-25">Print</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h4>Presents: <span class="badge badge-success">{{ $presentCount }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Absents: <span class="badge badge-danger">{{ $absentCount }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Leaves: <span class="badge badge-info">{{ $leaveCount }}</span></h4>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-4">
                <h4>Work from Home: <span class="badge badge-warning">{{ $workFromHomeCount }}</span></h4>
            </div>
            <div class="col-sm-4">
                {{-- {{ dd($holidayCount) }} --}}
                <h4>Holidays: <span class="badge badge-primary">{{ $holidayCount }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Remotely: <span class="badge badge-secondary">{{ $remotelyCount }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Half Leave: <span class="badge badge-info">{{ $halfLeaves }}</span></h4>
            </div>

            <div class="col-sm-4">
                <h4>Total Hours: <span class="badge badge-info">{{ $presentDaysCount*8 }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Working Hours: <span class="badge badge-info">{{ $formattedTotalHours }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Extra Hours: <span class="badge  badge-secondary text-white">{{ $totalExtraHours }}</span></h4>
            </div>
            <div class="col-sm-4">
                <h4>Left Leave: <span class="badge badge-warning ">{{ $leftLeave }}</span></h4>
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
                        $time = \Carbon\Carbon::parse($day['check_in']);
                        $checkin = \Carbon\Carbon::parse($day['check_in'])->format('h:i A'); // AM/PM format
                        $checkout = \Carbon\Carbon::parse($day['check_out'])->format('h:i A'); // AM/PM format

                        // Calculate total hours
                        $checkinTime = \Carbon\Carbon::parse($checkin);
                        $checkoutTime = \Carbon\Carbon::parse($checkout);

                        $totalHours = $checkoutTime->diffInHours($checkinTime);

                        @endphp

                        {{-- start total hours and minutes count 👇👇💢 --}}

                        @php
                        $totalHours = 0;
                        $totalMinutes = 0;
                        $checkinCount = \Carbon\Carbon::parse($day['check_in']);
                        $checkoutCount = \Carbon\Carbon::parse($day['check_out']);

                        // Calculate the difference in minutes
                        $totalMinutes = $checkoutCount->diffInMinutes($checkinCount);

                        // Calculate hours and remaining minutes
                        $hours = floor($totalMinutes / 60);
                        $minutes = $totalMinutes % 60;

                        // Format the total time
                        $formattedTotalTimeCount = sprintf("%02d:%02d", $hours, $minutes);
                        @endphp
                        {{-- end total hours and minutes count 👆 --}}

                        @if ($day['status'] === 'present')
                        @if ($time->greaterThan(\Carbon\Carbon::parse('09:59:00')))
                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-danger h5">Check in :
                            <b>{{ $checkin }}</b></span>
                        @else
                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-success h5">Check in :
                            <b>{{ $checkin }}</b></span>
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
                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-dark text-white h5">Total
                            Time: <b>{{ $formattedTotalTimeCount}}</b></span>

                        <span style="width: 100%; font-size: 15px;" class="p-2 badge badge-info h5">Extra Hours:
                            <b>{{ $day['extra_hours'] }}</b></span>

                        @elseif($day['status'] === 'absent')
                        <span class="py-2 badge badge-warning" style="width: 100%; font-size: 15px;">Absent</span>
                        <br>

                        @elseif($day['status'] === 'leave')
                        <span class="py-2 badge badge-secondary" style="width: 100%; font-size: 15px;">Leave</span>
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
                        <span class="py-2 badge badge-success" style="width: 100%; font-size: 15px;">Half Leave</span>
                        <br>
                        @endif
                        {{$day['remarks']}}

                    </div>
                </div>
            </div>
            @endforeach


        </div>

    </div>

</main>
@endsection
