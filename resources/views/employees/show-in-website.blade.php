

@extends('layouts.dashboard')
@push('css')
{{-- bootstrap-toggle css --}}
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endpush

@section('content')

<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <h3 class="py-4">Show in Website</h3>

        <div class="table-responsive">
            <table id="" class="table table-striped text-dark table-hover dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="color: rgb(0, 26, 78); font-weight:800; ">picture</th>
                        <th style="color: rgb(0, 26, 78); font-weight:800; ">Employee Name</th>
                        <th style="color: rgb(0, 26, 78); font-weight:800; ">Employee designation</th>

                        <th style="color: rgb(0, 26, 78); font-weight:800; ">Show in Website </th>


                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp

                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $i }}</td>

                            <td>
                                @if ($employee->picture)

                                    <img class="img-fluid rounded mt-2" style=" width:150px; height:150px; " src="{{ asset('storage/' . $employee->picture) }}" alt="User Profile Picture">


                                @else

                                    <img class="img-fluid rounded mt-2" style=" width:150px; height:150px; " src="{{ asset('assets/images/sub-img/img_avatar.png') }}" alt="not-show">


                                @endif
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->designation }}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input data-id="{{ $employee->id }}"  type="checkbox" class="toggle-class"
                                               data-onstyle="success"
                                               data-offstyle="dark" data-toggle="toggle" data-on="Show" data-off="Hide"
                                               {{ $employee->show_in_website ? 'checked' : '' }}>
                                    </label>

                                </div>
                            </td>

                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</main>
@push('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.toggle-class').change(function() {
            var ShowInWebsite = $(this).prop('checked') ? 1 : 0;
            var memberId = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('update.employee.website') }}",

                data: {'ShowInWebsite': ShowInWebsite, 'member_id': memberId},
                success: function(data) {
                    // console.log('Success');

                }
            });
        });
    });
</script>


@endpush

@endsection
