@extends('layouts.dashboard')

<style>
    .employee:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px !important;
    }
</style>

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="py-4">Work Detail</h3>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="month">Date</label>
                    <form id="filterForm" method="GET" action="">

                        <input type="month" value="{{ (request('month'))?request('month'):date('Y-m') }}" class="form-control" id="month" name="month" onchange="this.form.submit()">
                    </form>

                </div>
            </div>
        </div>

        <div class="row">

            @if($workDetail->isEmpty())
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No tasks available for this month.
                </div>
            </div>
            @else
            @foreach($workDetail as $task)
            <div class="col-lg-4 mb-4">
                <div class="card p-2 employee" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">{{ \Carbon\Carbon::parse($task->created_at)->toFormattedDateString() }}</h4>

                    </div>

                    <div class="card-body" style="max-height: 300px; overflow-y: auto">
                        <p><strong>Task Description:</strong>
                            <span style="white-space: nowrap;">{!! $task->long_text !!}</span>
                        </p>
                        <!-- HR and Team Lead Approval Status -->
                        <div class="mt-3">
                            <p><strong>Project Manager :</strong>
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

                            <p><strong>Team Lead :</strong>
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
                       @if($showApproveBtn)
                       <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#TeamLeadRemarksModal{{ $task->id }}">Approve</a>

                       @endif
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
                        <form action="{{ route('employee.tasks.approve', $task->id) }}" method="POST">
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
