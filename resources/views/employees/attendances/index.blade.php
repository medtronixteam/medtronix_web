@extends('layouts.dashboard')
@section('content')
<style>
    .attendance-shadow {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;

    }

    .attendance-hover:hover {
        text-decoration: none !important;
    }
</style>

<main role="main" class="main-content ">

    <div class="card p-4 my-4">
        <div class="row justify-content-between align-items-center">
            <h3 class="py-4 col-md-6">Attendance</h3>
            <div class="col-md-4 text-md-right">
                <form action="" method="get">
                    <input type="date" value="{{$date}}" name="date" class="form-control">
                </form>

            </div>
            <div class="col-md-2 text-md-right">
                <a href="{{ route('attendances.index') }}" class="btn btn-dark px-4">Mark</a>
            </div>
        </div>
        <div class="row">
            @foreach($attendances as $attendance)

            <div class="col-md-3 mb-2">
                <a class="attendance-hover" href="{{ route('attendances.user',$attendance->employee->id) }}">
                    <div class="card attendance-shadow">
                        @if ($attendance->status=="present")
                        <div class="card-header bg-success">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>
                        @elseif ($attendance->status=="leave")
                        <div class="card-header bg-info">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>
                        @elseif ($attendance->status=="work_from_home")
                        <div class="card-header bg-primary">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>
                        @elseif ($attendance->status=="absent")
                        <div class="card-header bg-danger">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>

                        @elseif ($attendance->status=="holiday")
                        <div class="card-header bg-dark">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>
                        @else
                        <div class="card-header bg-secondary">
                            <h5> {{ $attendance->employee->name }}</h5>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>

                                    <h6 class="">Check In</h6>
                                    @if ($attendance->status=="present")

                                    <p style="color: gray;"> {{ $attendance->check_in }}</p>
                                    @else
                                    <p>00:00</p>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="">Check out</h6>
                                    @if ($attendance->status=="present")

                                    <p style="color: gray;"> {{ $attendance->check_out }}</p>
                                    @else
                                    <p>00:00</p>
                                    @endif

                                </div>
                            </div>
                            <div class="">
                                @if ($attendance->status=="present")
                                <span class="p-2 badge badge-success">Present</span>
                                @elseif ($attendance->status=="leave")
                                <span class="p-2 badge badge-info">Leave</span>
                                @elseif ($attendance->status=="work_from_home")
                                <span class="p-2 badge badge-primary">Work from Home</span>
                                @elseif ($attendance->status=="absent")
                                <span class="p-2 badge badge-danger">Absent</span>

                                @elseif ($attendance->status=="holiday")
                                <span class="p-2 badge badge-dark">Holiday</span>
                                @else
                                <span class="p-2 badge badge-secondary">Remotly</span>
                                @endif

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>

</main>

@endsection
@push('js')
<script>
    $('input[type="date"]').change(function() {
        $('form').submit();
    });
</script>
@endpush
