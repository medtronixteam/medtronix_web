@extends('layouts.dashboard')

@section('content')

    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 h-auto" style="height: auto">
                    <div class="card shadow-sm">
                        <div class="card-header h4">
                            {{ $request->title }}
                        </div>
                        <div class="card-body">
                        <p class="mb-0">{!! $request->details !!}</p>

                    </div>
                    <div class="card-footer">
                      Status : <span class="badge badge-primary"> {{ ucfirst($request->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
