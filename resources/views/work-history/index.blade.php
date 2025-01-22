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
                <h3 class="py-4">Work History</h3>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="month">Date</label>
                    <form id="filterForm" method="GET" action="{{ route('work.history') }}">
                        <input type="date" value="{{ request('date') }}" class="form-control" id="date" name="date" onchange="this.form.submit()">
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

            @endforeach
                @foreach($tasks as $task)
                    <div class="col-lg-4 mb-4">
                        <div class="card p-2 employee" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                            <div class="card-header bg-primary">
                                <h4 class="text-white">{{ \Carbon\Carbon::parse($task->created_at)->toFormattedDateString() }}</h4>
                                <h4 class="text-white">
                                    {{ $task->user->name }}
                                </h4>
                            </div>

                            <div class="card-body" style="max-height: 300px; overflow-y: auto">
                                <p><strong>Task Description:</strong>
                                    <span style="white-space: nowrap;">{!! $task->long_text !!}</span>
                                </p>
                                <!-- HR and Team Lead Approval Status -->
                                <div class="mt-3">
                                    <p><strong>Project Manager</strong>
                                        @if($task->approved_by_hr == 0)
                                            <span class="badge bg-info text-white">Pending</span>
                                        @elseif($task->approved_by_hr == 1)
                                            <span class="badge bg-success text-white">Approved</span>
                                        @elseif($task->approved_by_hr == 2)
                                            <span class="badge bg-danger text-white">Rejected</span>
                                        @elseif($task->approved_by_hr == 3)
                                            <span class="badge bg-warning text-white">Revise</span>
                                        @endif
                                    </p>

                                    <p><strong>Team Lead Approval:</strong>
                                        @if($task->approved_by_team_lead == 0)
                                            <span class="badge bg-info text-white">Pending</span>
                                        @elseif($task->approved_by_team_lead == 1)
                                            <span class="badge bg-success text-white">Approved</span>
                                        @elseif($task->approved_by_team_lead == 2)
                                            <span class="badge bg-danger text-white">Rejected</span>
                                        @elseif($task->approved_by_team_lead == 3)
                                            <span class="badge bg-warning text-white">Revise</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="card-footer" style="text-align:end;">
                                <div class="btn-group">
                                    <a type="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#HRModal{{ $task->id }}">Project Manager Approval</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#TeamLeadRemarksModal{{ $task->id }}">Team-Lead Approval & Remarks</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HR Approval Modal -->
                    <div class="modal fade" id="HRModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="HRModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="HRModalLabel{{ $task->id }}">Project Manager Approval</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tasks.approve.hr', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Project Manager</label>
                                            <select name="approved_by_hr" class="form-control">
                                                <option value="0" {{ $task->approved_by_hr == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $task->approved_by_hr == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ $task->approved_by_hr == 2 ? 'selected' : '' }}>Rejected</option>
                                                <option value="3" {{ $task->approved_by_hr == 3 ? 'selected' : '' }}>Revise It</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Team Lead Approval & Remarks Modal -->
                    <div class="modal fade" id="TeamLeadRemarksModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="TeamLeadRemarksModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TeamLeadRemarksModalLabel{{ $task->id }}">Team Lead Approval & Remarks</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tasks.approve.teamlead_remarks', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Team Lead Approval:</label>
                                            <select name="approved_by_team_lead" class="form-control">
                                                <option value="0" {{ $task->approved_by_team_lead == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $task->approved_by_team_lead == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ $task->approved_by_team_lead == 2 ? 'selected' : '' }}>Rejected</option>
                                                <option value="3" {{ $task->approved_by_team_lead == 3 ? 'selected' : '' }}>Revise It</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks:</label>
                                            <textarea name="remarks" class="form-control">{{ $task->remarks }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Percentage Completed:</label>
                                            <input type="number" name="percentage_completed" class="form-control" value="{{ $task->percentage_completed }}" min="0" max="100">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</main>

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
