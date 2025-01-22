@extends('layouts.dashboard')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">{{ $notification->heading }}</h2>
                        <hr>
                        <h5>Description</h5>
                        <p class="card-text">{!! $notification->description !!}</p>
                        <hr>
                        <h5>Type</h5>
                        <p>{{ $notification->type_of }}</p>
                        <hr>
                        <h5>Label</h5>
                        <p>{{ $notification->label }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
