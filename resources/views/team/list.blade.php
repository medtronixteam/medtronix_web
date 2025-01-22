@extends('layouts.dashboard')

@section('content')
    <main role="main" class="main-content">
        <div class="card p-4 my-4">
            <h3 class="py-4">List of Teams</h3>
            <div class="table-responsive">
                <table id="teamTable" class="table table-striped table-hover">
                    <thead>
                        <tr class="text-dark">
                            <th>#</th>
                            <th>Name</th>
                            <th>Team Lead</th>
                            <th>Members</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->teamLead ? $team->teamLead->name : 'N/A' }}</td>
                                <td>
                                    @foreach ($users->where('team_id', $team->id) as $user)
                                        {{ $user->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a type="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#addTeamLeadModal{{ $team->id }}">Add Team Lead</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#addTeamMemberModal"
                                                onclick="setTeamId({{ $team->id }})">Add Team Member</a>
                                            <a class="dropdown-item" href="{{ route('team.edit', $team->id) }}">Edit</a>
                                            <form method="POST" action="{{ route('team.destroy', $team->id) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for adding team lead -->
                            <div class="modal fade" id="addTeamLeadModal{{ $team->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="addTeamLeadModalLabel{{ $team->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addTeamLeadModalLabel{{ $team->id }}">Select
                                                Team Lead</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="selectTeamLeadForm" action="{{ route('team.set_lead') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="team_id" value="{{ $team->id }}">
                                                <div class="form-group">
                                                    <label for="team_lead">Select Team Lead:</label>
                                                    <select name="team_lead" id="team_lead" class="form-control">
                                                        @foreach ($teamLeaders as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Set Team Lead</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for adding team members -->
        <div class="modal fade" id="addTeamMemberModal" tabindex="-1" role="dialog"
            aria-labelledby="addTeamMemberModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTeamMemberModalLabel">Add Team Members</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="selectTeamMemberForm" action="{{ route('team.add_members') }}" method="POST">
                            @csrf
                            <input type="hidden" name="team_id" id="team_id">
                            <div class="form-group">
                                <label>Select Members:</label><br>
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="members[]"
                                            id="member{{ $user->id }}" value="{{ $user->id }}">
                                        <label class="form-check-label" for="member{{ $user->id }}">
                                            {{ $user->name }}  ({{ $user->role }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Add Members</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function setTeamId(teamId) {
            $('#team_id').val(teamId);
        }
    </script>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush
