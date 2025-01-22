@extends('layouts.ui')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">{{ $notification->heading }}</h2>

                        <hr>

                        <p class="card-text" style="white-space: pre-wrap;">{!! $notification->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
