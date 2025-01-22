@extends('layouts.dashboard')

<style>
    .employee:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px !important;
    }

    .status-btn {
        display: inline-block;
        padding: 0 10px;
        height: 15px;
        line-height: 15px;
        border-radius: 5px;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
    }

    .bg-success {
        background-color: green !important;
    }

    .bg-danger {
        background-color: red !important;
    }

    .bg-warning {
        background-color: yellow !important;
        color: black !important;
    }

    .bg-primary {
        background-color: blue !important;
    }
</style>

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="py-4">Work Detail</h1>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="month">Month</label>
                    <form id="filterForm" method="GET" action="{{ route('employee.task.filter') }}">
                        <input type="month" value="{{ request('month') }}" class="form-control" id="month" name="month" onchange="this.form.submit()">
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @if($tasks->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        No tasks available for this month.
                    </div>
                </div>
            @else
                @foreach($tasks as $task)
                    <div class="col-lg-4 mb-4">
                        <div class="card p-2 employee" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                            <div class="card-header bg-primary">
                            <h4 class="text-white">{{ \Carbon\Carbon::parse($task->created_at)->toFormattedDateString() }}</h4>
                            </div>

                            <div class="card-body" style="max-height: 330px; overflow-y: auto">
                                <p><strong>Name:</strong>
                                    <span>{{ $task->user->name }}</span>
                                </p>
                                <p><strong>Task Description:</strong>
                                    <span style="white-space: nowrap;">{!! $task->long_text !!}</span>
                                </p>
                                <!-- HR and Team Lead Approval Status -->
                                <div class="mt-3">
                                    <p><strong>HR Approval:</strong>
                                        <div class="status-btn @if($task->approved_by_hr == 1) bg-success @elseif($task->approved_by_hr == 2) bg-danger @elseif($task->approved_by_hr == 3) bg-warning @else bg-primary @endif">
                                            @if($task->approved_by_hr == 0)
                                            <span class="badge bg-info text-white">Pending</span>
                                            @elseif($task->approved_by_hr == 1)
                                            <span class="badge bg-success text-white">Approved</span>
                                            @elseif($task->approved_by_hr == 2)
                                            <span class="badge bg-danger text-white">Rejected</span>
                                            @elseif($task->approved_by_hr == 3)
                                            <span class="badge bg-warning text-white">Revise</span>
                                            @endif
                                        </div>
                                    </p>
                                    <p><strong>Team Lead Approval:</strong>
                                        <div class="status-btn @if($task->approved_by_team_lead == 1) bg-success @elseif($task->approved_by_team_lead == 2) bg-danger @elseif($task->approved_by_team_lead == 3) bg-warning @else bg-primary @endif">
                                            @if($task->approved_by_team_lead == 0)
                                            <span class="badge bg-info text-white">Pending</span>
                                            @elseif($task->approved_by_team_lead == 1)
                                            <span class="badge bg-success text-white">Approved</span>
                                            @elseif($task->approved_by_team_lead == 2)
                                            <span class="badge bg-danger text-white">Rejected</span>
                                            @elseif($task->approved_by_team_lead == 3)
                                            <span class="badge bg-warning text-white">Revise</span>
                                            @endif
                                        </div>
                                    </p>
                                </div>
                                <!-- Remarks and Percentage -->
<div class="mt-3">
     <p><strong>Work Completed:</strong>
    @if($task->percentage_completed > 0)
        {{ $task->percentage_completed }}%
    @else
        No percentage added
    @endif
</p>

    <p><strong>Remarks:</strong>
        @if($task->remarks)
            {{ $task->remarks }}
        @else
            No remarks added.
        @endif
    </p>
</div>


                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</main>

@endsection
