@extends('layouts.dashboard')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">{{ isset($team) ? 'Edit Team' : 'Create Team' }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ isset($team) ? route('team.update', $team->id) : route('team.store') }}">
                                @csrf
                                @if(isset($team))
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label for="team_name">Team Name</label>
                                    <input type="text" id="team_name" name="team_name" class="form-control" value="{{ isset($team) ? $team->name : '' }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ isset($team) ? 'Update Team' : 'Create Team' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
