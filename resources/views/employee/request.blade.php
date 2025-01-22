@extends('layouts.dashboard')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 h-auto" style="height: auto">
                    <div class="card shadow-sm">
                        <div class="card-header h2 text-center">
                            Send Request To Admin
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('employee.request.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input value="{{ old('title') }}" type="text" name="title" class="form-control" >
                                </div>
                                @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                  </div>

                                @enderror

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" id="editor" class="form-control">{{ old('details') }}</textarea>
                                </div>
                                @error('details')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                  </div>

                                @enderror
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card my-4 shadow-sm">
                        <div class="card-header h2 text-center">
                            <h2>Request List</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="requestTable" class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-dark">
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests->sortByDesc('created_at') as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $request->title }}</td>
                                            <td>{!! Illuminate\Support\Str::limit($request->details, 30, '...') !!}</td>
                                            <td>

                                                @php
                                                    $statusClass = '';
                                                    $statusText = ucfirst($request->status);
                                                    switch ($request->status) {
                                                        case 'pending':
                                                            $statusClass = 'badge-warning';
                                                            break;
                                                        case 'approved':
                                                            $statusClass = 'badge-primary';
                                                            break;
                                                        case 'rejected':
                                                            $statusClass = 'badge-danger';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-light" href="{{ route('employee.request.view', base64_encode($request->id)) }}"><i class="fa fa-eye text-dark" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script>
     let editorInstance;

ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        editorInstance = editor;
    })

    .catch(error => {
        console.error(error);
    });
    </script>

@endpush
@push('css')
    <style scoped>
        .table thead th {
            color: black;
            font-size: 15px;
        }

        .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
            display: table-cell;
            vertical-align: middle;
            font-size: 1.3rem;
            font-weight: 500;
            font-family: Roboto;
        }

        .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title {
            display: table;
            table-layout: fixed;
            height: 100%;
        }

        .m-portlet .m-portlet__head .m-portlet__head-caption {
            display: table-cell;
            vertical-align: middle;
            text-align: left;
        }

        .m-portlet .m-portlet__head {
            display: table;
            padding: 0;
            width: 100%;
            padding: 0 2.2rem;
            height: 5.1rem;
        }

        .m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
            display: table-cell;
            vertical-align: middle;
            font-size: 1.3rem;
            font-weight: 500;
            font-family: Roboto;
        }

        .m-portlet .m-portlet__body {
            padding: 2.2rem 2.2rem;
        }

        .mCSB_container {
            overflow: hidden;
            width: auto;
            height: auto;
        }

        .mCustomScrollBox {
            position: relative;
            overflow-y: hidden;
            height: 100%;

            max-height: 100% max-width: 100%;
            outline: none;
            direction: ltr;
        }

        .m-portlet .m-portlet__body {
            color: black;
        }

        .m-timeline-3 .m-timeline-3__item {
            disply: table;
            margin-bottom: 2rem;
            position: relative;
        }

        .m-timeline-3__item.m-timeline-3__item--success:before {
            background: #34bfa3;
        }

        .m-timeline-3 .m-timeline-3__item:before {
            position: absolute;
            display: block;
            width: 0.28rem;
            -webkit-border-radius: 0.3rem;
            -moz-border-radius: 0.3rem;
            -ms-border-radius: 0.3rem;
            -o-border-radius: 0.3rem;
            border-radius: 0.3rem;
            height: 70%;
            left: 0.1rem;
            top: 0.46rem;
            content: "";
        }

        .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-time {
            display: table-cell;
            vertical-align: top;
            /* padding-top: 0.6rem; */
            font-weight: 500;
            font-size: 16px;
            position: absolute;
            text-align: right;
            width: 3.57rem;
        }

        .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc {
            display: table-cell;
            width: 100%;
            vertical-align: top;
            font-size: 1rem;
            padding-left: 1rem;
        }



        .m-link.m-link--metal {
            color: #c4c5d6;
        }

        .m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc .m-timeline-3__item-user-name .m-timeline-3__item-link {
            font-size: 0.85rem;
            text-decoration: none;
        }

        .newstext {
            color: black !important;
            cursor: pointer;
        }

        /* Modify the scrollbar styles */
        .mCustomScrollBox::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        .mCustomScrollBox::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        .mCustomScrollBox::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        .mCustomScrollBox::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .btn.btn-secondary {
            background: white;
            border-color: #ebedf2;
            color: #212529;
        }

        .btn-secondary {
            color: #212529;
            background-color: #ebedf2;
            border-color: #ebedf2;
            font-size: 14px;
            padding: 10px;
            border-radius: 15px;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            line-height: 1.25;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
@endpush
