@extends('layouts.employee')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 h-auto" style="height: auto">
                    <div class="card shadow-sm">
                        <div class="card-header h2  bg-dark text-white">
                            Request View
                        </div>
                        <div class="card-body">
                            @php
                            $statusClass = '';
                            $statusText = ucfirst($request->status);
                            switch ($request->status) {
                                case 'pending':
                                    $statusClass = 'btn-warning';
                                    break;
                                case 'approved':
                                    $statusClass = 'btn-primary';
                                    break;
                                case 'rejected':
                                    $statusClass = 'btn-danger';
                                    break;
                            }
                        @endphp
                        <div class="text-right">
                            <button class="btn btn {{ $statusClass }}">{{ $statusText }}</button>

                        </div>



                            <div class="form-group">
                                <h5 >Title : </h5>
                                <p class="pl-4">{{ $request->title }}</p>


                            </div>


                            <div class="form-group">
                                <h5 >Details</h5>
                                {!! $request->details !!}
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </main>
@endsection


