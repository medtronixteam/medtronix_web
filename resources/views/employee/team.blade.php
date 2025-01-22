@extends('layouts.dashboard')
@section('content')
    <main role="main" class="main-content">

        <div class="card p-4 my-4">
            <div class="card-body">
                @if ($teamCheck)
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Team Name: <b>{{ $myTeamName }}</b> </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4>Team Lead: <b>{{ $teamLead }}</b> </h4>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($members as $member)
                            @php
                                $employee = \App\Models\User::find($member->id);
                            @endphp
                            <div class="col-md-4 my-2">
                                <div class="card employee border-0 p-3" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;">
                                    <div class="text-center">
                                        <img class="img-fluid rounded mt-2" style="width:180px; height:150px;"
                                             src="{{ $employee->picture ? asset('storage/' . $employee->picture) : asset('assets/images/sub-img/img_avatar.png') }}"
                                             alt="User Profile Picture">
                                    </div>
                                    <div class="card-body pl-0">
                                        <h6 style="height:35px;" class="card-title mb-0">{{ $employee->name }}</h6>
                                        <p style="height:35px;" class="card-text">{{ $employee->designation }}</p>
                                    </div>
                                     @if (auth()->user()->name == $teamLead)
                                    <a class="btn btn-primary w-50" href="{{ route('employee.work.detail', $employee->id) }}">Work History</a>

                                    @endif
                                    </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1>You are not part of any team</h1>
                @endif
            </div>
        </div>
    </main>
@endsection
