@extends('layouts.dashboard')

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">

        <!-- Disabled Users Section -->
        <h3 class="py-4">Disabled Employees</h3>
        <div class="row">
            @foreach($employees as $employee)
                @if ($employee->is_disabled === 'yes')
                    <div class="col-md-4 my-2">
                        <div class="card employee border-0 p-3" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;">
                            @if ($employee->picture)
                                <div class="text-center" style=" width:180px;  height:150px;" >
                                    <img class="img-fluid rounded mt-2" style=" width:180px; height:150px; " src="{{ asset('storage/' . $employee->picture) }}" alt="User Profile Picture">
                                </div>
                            @else
                                <div class="text-center">
                                    <img class="img-fluid rounded mt-2" style=" width:180px; height:150px; " src="{{ asset('assets/images/sub-img/img_avatar.png') }}" alt="not-show">
                                </div>
                            @endif
                            <div class="card-body pl-0">
                                <h6 style="height:35px;" class="card-title mb-0">{{ $employee->name }}</h6>
                                <p style="height:35px;" class="card-text">{{ $employee->designation }}</p>
                            </div>
                            <form method="POST" action="{{ route('employees.toggle', $employee->id) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="{{ $employee->is_disabled === 'yes' ? 'enable' : 'disable' }}">
                                <button type="submit" class="btn btn-dark ">
                                    {{ $employee->is_disabled === 'yes' ? 'Enable User' : 'Disable User' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</main>

@endsection
