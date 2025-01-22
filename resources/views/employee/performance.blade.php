@extends('layouts.dashboard')

@section('content')
<main role="main" class="main-content">
    <div class="card p-4 my-4">
        <div class="row justify-content-between align-items-center">
            <h1 class="py-4 col-sm-4">Employee Performance</h1>

            <div class="col-md-3 mr-3">
                <div class="form-group">
                    <label for="month">Month</label>
                    <form id="filterForm" method="GET" action="{{ route('employee.performance') }}">
                        <input type="month" value="{{ $year }}-{{ $month }}" class="form-control" id="month" name="month" onchange="this.form.submit()">
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Presents</h4>
                        <p class="card-text">{{ $presentCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Absents</h4>
                        <p class="card-text">{{ $absentCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Leaves</h4>
                        <p class="card-text">{{ $leaveCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Work from Home</h4>
                        <p class="card-text">{{ $workFromHomeCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Holidays</h4>
                        <p class="card-text">{{ $holidayCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-secondary text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Remotely</h4>
                        <p class="card-text">{{ $remotelyCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Half Leave</h4>
                        <p class="card-text">{{ $halfLeaves }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Total Hours</h4>
                        <p class="card-text">{{ $presentDaysCount * 8 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Working Hours</h4>
                        <p class="card-text">{{ $formattedTotalHours }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-secondary text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Extra Hours</h4>
                        <p class="card-text">{{ $totalExtraHours }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Yearly leaves available</h4>
                        <p class="card-text">{{ $yearlyLeavesAvailable }}</p>
                    </div>
                </div>
            </div>

            {{-- <div class="col-sm-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Late Check-In</h4>
                        <p class="card-text">{{ $lateCheckInCount }}</p>
                    </div>
                </div>
            </div> --}}
            <div class="col-sm-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Total Days Worked</h4>
                        <p class="card-text">{{ $totalDaysWorked }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Total Pending Approval (HR)</h4>
                        <p class="card-text text-white">{{ $tasksPendingHR }}</p>
                        <h4 class="card-title">Total Approved by HR</h4>
                        <p class="card-text text-white">{{ $tasksApprovedByHR }}</p>
                        <h4 class="card-title">Total Rejected by HR</h4>
                        <p class="card-text text-white">{{ $tasksRejectedByHR }}</p>
                        <h4 class="card-title">Total Revised by HR</h4>
                        <p class="card-text text-white">{{ $tasksRevisedByHR }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Total Pending Approval (Team Lead)</h4>
                        <p class="card-text text-white">{{ $tasksPendingTeamLead }}</p>
                        <h4 class="card-title">Total Approved by Team Lead</h4>
                        <p class="card-text text-white">{{ $tasksApprovedByTeamLead }}</p>
                        <h4 class="card-title">Total Rejected by Team Lead</h4>
                        <p class="card-text text-white">{{ $tasksRejectedByTeamLead }}</p>
                        <h4 class="card-title">Total Revised by Team Lead</h4>
                        <p class="card-text text-white">{{ $tasksRevisedByTeamLead }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
