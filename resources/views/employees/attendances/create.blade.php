@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h3 class="py-4">Attendance</h3>

                @if(isset($attendance))
                    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}">
                    @method('PUT')

                @else

                   <form method="POST" action="{{ route('attendances.store') }}">
                @endif

                    @csrf

                        <div class="row">
                            <!-- Employee ID -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee:</label>
                                    <select name="employee_id" id="employee_id" class="form-control" required>
                                        <!-- Populate this dropdown with employees -->
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ isset($attendance) && $employee->id ==
                                            $attendance->employee_id ? 'selected disabled' : '' }}>{{ $employee->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Month -->
                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control" required>
                                        @for ($month = 1; $month <= 12; $month++) @php
                                            $monthDate=\Carbon\Carbon::create()->month($month);
                                            $isMonth = now()->format('F');
                                            @endphp

                                            @if (isset($attendance))
                                            <option value="{{ $month }}" {{ ($attendance->month==$month ) ? 'selected' : '' }}>
                                                {{ $monthDate->format('F') }}
                                            </option>

                                            @else
                                            <option value="{{ $month }}" {{ ($isMonth==$monthDate->format('F') ) ?
                                                'selected' : '' }}>
                                                {{ $monthDate->format('F') }}
                                            </option>
                                            @endif


                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Year -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="year">Year:</label>
                                    <input type="text" class="form-control" id="year" name="year"
                                        value="{{ isset($attendance) ? $attendance->year : date('Y')  }}" required>
                                </div>
                            </div>

                            <!-- Absent -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="absent">Absent:</label>
                                    <input type="number" class="form-control" id="absent" name="absent"
                                        value="{{ isset($attendance) ? $attendance->absent : '0' }}" required>
                                </div>
                            </div>

                            <!-- present -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="present">Present:</label>
                                    <input type="number" class="form-control" id="present" name="present"
                                        value="{{ isset($attendance) ? $attendance->present : '0' }}" required>
                                </div>
                            </div>

                            <!-- Leave -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="leave">Leave:</label>
                                    <input type="number" class="form-control" id="leave" name="leave"
                                        value="{{ isset($attendance) ? $attendance->leave : '0' }}" required>
                                </div>
                            </div>

                            <!-- Remote Work -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="remote_work">Remote Working Days:</label>
                                    <input type="number" class="form-control" id="remote_work" name="remote_work"
                                        value="{{ isset($attendance) ? $attendance->remote_work : '0' }}" required>
                                </div>
                            </div>

                            <!-- Total Hours -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="total_hours">Total Hours:</label>
                                    <input type="number" class="form-control" id="total_hours" name="total_hours"
                                        value="{{ isset($attendance) ? $attendance->total_hours : '192' }}" required>
                                </div>
                            </div>

                            <!-- Missing Hours -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="missing_hours">Missing Hours:</label>
                                    <input type="number" class="form-control" id="missing_hours" name="missing_hours"
                                        value="{{ isset($attendance) ? $attendance->missing_hours : '0' }}" required>
                                </div>
                            </div>

                            <!-- Working Hours -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="working_hours">Working Hours:</label>
                                    <input type="number" class="form-control" id="working_hours" name="working_hours"
                                        value="{{ isset($attendance) ? $attendance->working_hours : '192' }}" required>
                                </div>
                            </div>

                            <!-- Other -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="other">Other <span class="text-info">(optional)</span>:</label>
                                    <input type="text" class="form-control" id="other" name="other"
                                        placeholder="Addtional Info"
                                        value="{{ isset($attendance) ? $attendance->other : '' }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($attendance) ? 'Update' : 'Create' }}
                            Attendance</button>
                    </form>

            </div>
        </div>
    </div>


</main>

@endsection
