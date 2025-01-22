@extends('layouts.dashboard')

@section('content')
<style>
    .time_input {
        display: none;
    }

</style>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="h3 mb-4 page-title">Attendance</h3>
                <div class="card">
                    <div class="card-body">
                        <form action="" id="attend_form" method="POST">
                            <div class="row my-2 mb-4">
                                <div class="col-sm-4">
                                    <input onchange="getAttendance()" name="attendance_date" id="attendance_date" type="date" value="{{ date('Y-m-d') }}" class="form-control">
                                    <input name="attendance_time" id="attendance_time" type="hidden" value="{{ \Illuminate\Support\Carbon::now()->timezone('Asia/Karachi')->format('H:i') }}" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="mt-2"> <b>Date :</b> <span class="badge badge-dark py-2">{{ \Illuminate\Support\Carbon::now()->timezone('Asia/Karachi')->format('d-m-Y') }}
                                        </span> <b>Time :</b> <span class="badge badge-primary py-2">{{ \Illuminate\Support\Carbon::now()->timezone('Asia/Karachi')->format('H:i') }}
                                        </span></h5>
                                </div>
                            </div>
                            @csrf

                            <div id="lists_of_attendance">
                                <div class="row justify-content-center align-items-center mt-5">
                                    <div class="spinner-grow mr-3 spinner-grow " role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow mr-3 spinner-grow " role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow mr-3 spinner-grow " role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row ">
                                <button id="btn_attend" type="submit" class="btn btn-dark mt-2 w-25">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection
@push('js')
<script>
    function changeStatus(employee) {
        let attend_status = $('.attend_status_' + employee).val();
        if (attend_status !== 'present') {
            $('#remark_' + employee).fadeIn('slow');
            $('.time_' + employee).fadeOut('slow');
            $('#time_' + employee).prop('required', false);
        } else {
            $('#remark_' + employee).fadeOut('slow');
            $('#time_' + employee).prop('required', true);
            $('.time_' + employee).fadeIn('slow');
            //$('#time_'+employee).val($('#attendance_time').val());
        }
    }
    getAttendance();

    function getAttendance() {
        $('#lists_of_attendance').empty().append(`<div class="row justify-content-center align-items-center mt-5">
                                            <div class="spinner-grow mr-3 spinner-grow " role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                              <div class="spinner-grow mr-3 spinner-grow " role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                              <div class="spinner-grow mr-3 spinner-grow " role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                        </div>`);
        $.ajax({
            url: "{{route('attendances.list')}}"
            , method: "post"
            , headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            , }
            , dataType: "json"
            , data: {
                attendance_date: $('#attendance_date').val()
            , }
            , beforeSend: function(request) {
                return request.setRequestHeader(
                    "X-CSRF-Token"
                    , $("meta[name='csrf-token']").attr("content")
                );
            }
            , success: function(response) {
                //  $("#lists_of_attendance").empty().html(dataHTML);
                var dataHTML = '';
                console.log(response);
                $("#lists_of_attendance").empty();
                response.forEach(function(value) {

                    dataHTML = `<div class="row my-1 border border-black ">\

                                        <input type="hidden" value="${value.id}" name="user_id[]" />\
                                        <div class="col-sm-12">\
                                            <h6 class="m-0 mt-2">${value.name}</h6>\
                                        </div>\
                                        <div class="col-sm-3">\

                                            <select name="status[]" onchange='changeStatus(${value.id})' class="form-control attend_status_${value.id}"\
                                                data-employee='${value.id}'>\
                                                <option ${(value.status === 'absent') ? 'selected' : ''} value="absent">Absent</option>\
                                                <option ${(value.status === 'present') ? 'selected' : ''} value="present">Present</option>\
                                                <option ${(value.status === 'leave') ? 'selected' : ''} value="leave">Leave</option>\
                                                <option ${(value.status === 'work_from_home') ? 'selected' : ''} value="work_from_home">Work from home</option>\
                                                <option ${(value.status === 'holiday') ? 'selected' : ''} value="holiday">holiday</option>\
                                                <option ${(value.status === 'remotely') ? 'selected' : ''} value="remotely">Remotely</option>\
                                                <option ${(value.status === 'half_leave') ? 'selected' : ''} value="half_leave">Half Leave</option>\
                                            </select>\
                                        </div>\
                                        <div class="col-sm-3">\


                                            <input type="time" id="time_${value.id}"  name="check_in[]" value="${value.check_in}" class="form-control time_input time_${value.id}">\
                                            <input placeholder='Enter Remarks' type="text" id="remark_${value.id}"  name="remarks[]" value="${value.remarks}" class="form-control remark_input remark_${value.id}">\
                                        </div>\
                                        <div class="col-sm-3">\

                                            <input type="time" value="${value.check_out}" name="check_out[]" class="form-control time_input time_${value.id}" >\
                                        </div>\
                                        <div class="col-sm-3">\

                                            <input value="${value.extra_hours}"  type="number" max="12" min="0"  name="extra_hours[]" class="form-control time_input time_${value.id}" step="0.02" placeholder="Enter Extra hours">                                        </div>\

                                    </div>`;
                    $("#lists_of_attendance").append(dataHTML);
                    changeStatus(value.id);
                });
            }
        , });
    }
    $("#attend_form").on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#attend_form');
        $.ajax({
            type: 'POST'
            , url: "{{ route('attendances.store') }}"
            , data: new FormData(this)
            , contentType: false
            , cache: false
            , processData: false
            , dataType: 'json'
            , beforeSend: function() {
                $('#btn_attend').prop("disabled", true);
                $('#btn_attend').text("Saving...");
            }
            , success: function(response) {
                Toast.fire({
                    icon: response.status
                    , title: response.message
                });
                $('#btn_attend').prop("disabled", false);
                $('#btn_attend').text("Save");
            }
        }); //ajax call
    }); //main

</script>
@endpush
