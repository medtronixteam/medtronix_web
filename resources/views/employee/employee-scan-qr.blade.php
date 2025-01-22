@extends('layouts.employee')
@push('css')
<style scoped>
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
        background: #181144;
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
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 h-auto" style="height: auto">

                <div class="card">

                    <div class="card-header h4 text-center">
                        Mark Attendance

                    </div>
                    <div class="card-body">
                        <livewire:card-attend />
                        <div class="d-flex flex-column justify-content-center">
                            @if ($checkInTime)
                            <button type="button" class="btn btn-primary w-75 mx-auto d-flex justify-content-center" disabled>Check
                                in: {{ $checkInTime }}</button>
                            @else
                            <button type="button" class="btn btn-outline-primary my-3 w-sm-75 mx-auto d-flex justify-content-center" id="scan-qrcode">
                                <i class="fa fa-barcode mr-2" aria-hidden="true"></i> Scan QR to Check-in
                            </button>

                            @endif



                            @if ($checkOutTime)
                            <button type="button" class="btn btn-primary w-75 mx-auto mt-4 d-flex justify-content-center" disabled>Check
                                out: {{ $checkOutTime }}</button>
                            @else
                            @if ($checkInTime)
                            <button type="button" class="btn btn-outline-primary my-3 w-sm-75 mx-auto d-flex justify-content-center" id="scan-qrcode">
                                <i class="fa fa-barcode mr-2" aria-hidden="true"></i> Scan QR to Checkout
                            </button>

                            @endif
                            @endif
                        </div>
                    </div>
                </div>

        </div><!-- end of row -->

    </div> <!-- .container-fluid -->
    <!-- Modal -->
    <!-- barcodeModal  -->
    <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalLabel">Scaning QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-11 " id="qr-reader"></div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">

                    <button id="restart-scan" type="button" class="btn-sm btn btn-primary">Reset
                        Permissions</button>
                    <button id="toggle-camera" type="button" class="btn-sm btn btn-dark">Toggle</button>

                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSDoUUaDgwWTH_GAEmuctshmhFJ9_KhVg&libraries=geometry">
    </script>

    {{-- <h2 id="status">Checking your location...</h2> --}}
</main> <!-- main -->

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const headings = document.querySelectorAll('.toggle-description');
        headings.forEach(function(heading) {
            heading.addEventListener('click', function(event) {
                event.preventDefault();
                const targetId = this.getAttribute('data-target');
                const description = document.getElementById('description_' + targetId);
                if (description.style.display === 'none') {
                    description.style.display = 'inline'; // or 'block' depending on your layout
                } else {
                    description.style.display = 'none';
                }
            });
        });
    });

</script>
@push('js')

<script src="{{ url('admin/js/html5-qrcode.min.js') }}"></script>
{{-- ckeditor.js  --}}
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
    $(document).ready(function() {
        $('#fetch_task').change(function() {
            var taskId = $(this).data('id');
            var taskDate = $(this).val();
            //  alert("task Id is =" + taskId + " and task Date is= " + taskDate);
            $.ajax({
                type: 'GET'
                , dataType: 'json'
                , url: "{{ route('employee.fetch.taskData') }}"
                , data: {
                    'taskDate': taskDate
                }
                , success: function(data) {
                    console.log(data);
                    // Set the data in the CKEditor instance
                    if (editorInstance) {
                        editorInstance.setData(data.text);
                    }
                }
                , error: function(xhr) {
                    console.log('Error', xhr.responseText);
                }
            });
        });
    });
    $('#scan-qrcode').click(function() {
        startScan();
        $('#barcodeModal').modal('show');
    })
    var html5QrCode;
    var facingMode = "environment"; // Default to rear camera
    // Debounce function: delays invoking the function until after a specified time
    function debounce(func, delay) {
        let timer;
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Your function to handle scan success
    function onScanSuccess(decodedText, decodedResult) {
        // Debounced markAttendance function (calls it after a delay of 2 seconds)
        debouncedMarkAttendance(decodedText);

    }

    // Your markAttendance function wrapped with debounce (delay of 2000ms or 2 seconds)
    const debouncedMarkAttendance = debounce(function(decodedText) {
        markAttendance(decodedText);
    }, 1000);




    function onScanError(errorMessage) {
        // Handle the error here
        //  console.error(`Error occurred during scan: ${errorMessage}`);
    }

    function startScan() {
        $('#scan-qrcode-row').fadeOut();
        html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start({
                facingMode: facingMode
            }, // Default camera or specify { facingMode: "user" } for front camera
            {
                fps: 10, // Scanning frequency
                qrbox: {
                    width: 250
                    , height: 250
                } // QR code scanning box size
            }
            , onScanSuccess
            , onScanError
        ).catch(err => {
            // Start failed, handle it

        });
    }
    $('#barcodeModal').on('hide.bs.modal', function(event) {
        html5QrCode.stop().then(() => {
            //startScan(); // Restart scan
        }).catch(err => {
            console.error('Error stopping scan: ${err}');
        });
    })
    //  // Initial scan start
    document.getElementById('restart-scan').addEventListener('click', function() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                startScan(); // Restart scan
            }).catch(err => {
                console.error('Error stopping scan: ${err}');
            });
        }
    });
    document.getElementById('toggle-camera').addEventListener('click', function() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                // Toggle facing mode
                facingMode = (facingMode === "environment") ? "user" : "environment";
                startScan(); // Restart scan with new facing mode
            }).catch(err => {
                console.error('Error stopping scan: ${err}');
            });
        }
    });

    function markAttendance(decodedText) {
        $.ajax({
            url: "{{ route('employee.attendance.marked') }}"
            , method: "post"
            , headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            , }
            , dataType: "json"
            , data: {
                code: decodedText
            , }
            , beforeSend: function(request) {
                return request.setRequestHeader(
                    "X-CSRF-Token"
                    , $("meta[name='csrf-token']").attr("content")
                );
            }
            , success: function(response) {
                Toast.fire({
                    icon: response.status
                    , title: response.message
                });
                if (response.status === "success") {
                    $('#barcodeModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    html5QrCode.stop().then(() => {}).catch(err => {
                        //  console.error('Error stopping scan: ${err}');
                    });
                }
            }
        , });
    }

</script>
{{-- location  --}}
<script>
    let latitude_loc = '';
    let longitude_loc = '';

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            Toast.fire({
                icon: 'warning'
                , title: 'Geolocation is not supported by this browser.'
            });

        }
    }

    function showPosition(position) {
        $('#check-in-button').prop('disabled', false);
        console.log(position.coords.latitude);
        console.log(position.coords.longitude);
        latitude_loc = position.coords.latitude;
        longitude_loc = position.coords.longitude;

    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                Toast.fire({
                    icon: 'warning'
                    , title: 'Enable Geolocation to mark check in'
                });

                break;
            case error.POSITION_UNAVAILABLE:
                Toast.fire({
                    icon: 'warning'
                    , title: 'Location information is unavailable.'
                });
                break;
            case error.TIMEOUT:
                Toast.fire({
                    icon: 'warning'
                    , title: 'The request to get user location timed out.'
                });
                break;
            case error.UNKNOWN_ERROR:
                Toast.fire({
                    icon: 'warning'
                    , title: 'An unknown error occurred..'
                });

                break;
        }
    }

    //
    $('#check-in-button').click(function() {
        if (latitude_loc === '' || longitude_loc === '') {
            Toast.fire({
                icon: 'warning'
                , title: 'Please enable your location and try again.'
            });
            return;
        }
        const checkInButton = document.getElementById('check-in-button');
        checkInButton.innerHTML = 'Checking in...';
        checkInButton.disabled = true; // Disable the button while checking-in

        $.ajax({
            url: "{{ route('employee.check-in') }}"
            , type: 'POST'
            , headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            , }
            , data: {
                latitude: latitude_loc
                , longitude: longitude_loc
            }
            , success: function(response) {
                // Handle success
                if (response.success) {
                    Swal.fire({
                        icon: 'success'
                        , title: response.message
                    });
                    checkInButton.innerHTML = 'Check in: ' + response.checkInTime;
                    checkInButton.disabled = true; // Disable the button after successful check-in

                } else {
                    Swal.fire({
                        icon: 'error'
                        , title: response.message
                    });
                    checkInButton.disabled = false;
                }
            }
            , error: function(xhr) {
                checkInButton.innerHTML = 'Check In';
                checkInButton.disabled = false;
                Swal.fire({
                    icon: 'error'
                    , title: 'Please try again. A error occurred.'
                , });
            }
        });
    });
    //

</script>

<script>
    $(document).ready(function() {
        $('#task_form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                type: 'POST'
                , url: $(this).attr('action')
                , data: formData
                , contentType: false
                , processData: false
                , success: function(response) {
                    Swal.fire({
                        icon: "success"
                        , title: "Request Submitted Successfully"
                        , toast: true
                        , position: "top-end"
                        , showConfirmButton: false
                        , timer: 3000
                        , timerProgressBar: true
                        , didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }
                , error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oops...'
                        , text: 'Something went wrong!'
                    , });
                }
            });
        });
    });

</script>
@endpush
