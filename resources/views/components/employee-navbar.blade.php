<style>
    .badge-white {
        background-color: white;
        color: black;
    }
    .sidebar-left::-webkit-scrollbar {
  width: 5px;
}

.sidebar-left::-webkit-scrollbar-track {
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.sidebar-left::-webkit-scrollbar-thumb {
  background-color: #181144;
  outline: 1px solid slategrey;
}
</style>
<aside class="sidebar-left border-right bg-primary shadow d-md-block d-none"  style="" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-dark">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('mobile.dashboard') }}">
                <b>Medtronix</b>
            </a>
        </div>
        @if (auth()->user()->role == 'admin')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item ">
                    <a href="{{ route('admin.dashboard') }}" class=" nav-link">
                        <i class="fa fa-rocket fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a>

                </li>
                {{-- <li class="nav-item ">
                    <a href="{{ route('task.manager') }}" class=" nav-link">
                        <i class="fa fa-rocket fe-16"></i>
                        <span class="ml-3 item-text">Task Manager</span>
                    </a>

                </li> --}}


                <li class="nav-item dropdown">
                    <a href="#Employee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Employee</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Employee">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ route('employees.create') }}"><span
                                    class="ml-1 item-text">Add</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('employees.index') }}"><span
                                    class="ml-1 item-text">List</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('salary_slips.index') }}"><span
                                    class="ml-1 item-text">SalarySlip List</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('employees.disable-user') }}"><span
                                    class="ml-1 item-text">Disabled Employee</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#Projects" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa fa-cubes fe-16"></i>
                        <span class="ml-3 item-text">Projects</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Projects">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ route('projects.create') }}"><span
                                    class="ml-1 item-text">Add</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('projects.index') }}"><span
                                    class="ml-1 item-text">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#Attendances" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-check-square fe-16"></i>
                        <span class="ml-3 item-text">Attendances</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Attendances">
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('attendances.index') }}"><span
                                    class="ml-1 item-text">Mark</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('attendances.create') }}"><span
                                    class="ml-1 item-text">Lists</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('mobile.attendence.list') }}"><span
                                    class="ml-1 item-text">Show in Attendence</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('work.history') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Task History</span>
                    </a>

                </li>
                {{-- <li class="nav-item ">
                    <a href="{{ route('box.history') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Chat History</span>
                    </a>

                </li> --}}

                <li class="nav-item dropdown">
                    <a href="#notification" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-bell fe-16"></i>

                        <span class="ml-3 item-text">Notification</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="notification">
                        <li class="nav-item">
                            <a href="{{ route('notifications.manage') }}" class="nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" {{ route('notifications.list') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a href="#TeamManagment" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-17"></i>
                        <span class="ml-3 item-text">Team Management</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="TeamManagment">
                        <li class="nav-item">
                            <a href="{{ route('team.manage') }} " class="nav-link">
                                <i class="fa fa-hourglass-half fe-17"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('team.list') }} " class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item ">
                    <a href="{{ route('waitlist.list') }}" class=" nav-link">
                        @php
                        $count = \App\Models\Waitlist::count();
                    @endphp
                       <i class="fe fe-clock fe-16"></i>
                        <span class="ml-3 item-text w-50">WaitList <span
                            class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="{{ route('client.showMessage') }}" class=" nav-link">
                        <i class="fe fe-user fe-16"></i>
                        <span class="ml-3 item-text">Contact Messages <span
                            class="badge badge-white p-1 rounded float-right">0</span></span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href=" {{ route('request.list') }}" class=" nav-link">
                        @php
                            $count = \App\Models\Request::where('status', 'pending')->count();
                        @endphp
                        <i class="fe fe-clipboard fe-16"></i>
                        <span class="ml-3 item-text w-50">Requests <span
                                class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a>

                </li>

                <li class="nav-item dropdown">
                    <a href="#client_review" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-triangle
                        fe-16"></i>
                        <span class="ml-3 item-text">Client Review</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="client_review">
                        <li class="nav-item">
                            <a href="{{ route('client.reviewCreate') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('client.reviewList') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('settings.index') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">System Settings</span>
                    </a>

                </li>

            </ul>
        @else
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item ">
                    <a href="{{ route('mobile.dashboard') }}" class=" nav-link">
                        <i class='bx bxs-dashboard'></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a>

                    <a href="{{ route('mobile.attendance') }}" class=" nav-link">
                        <i class='bx bx-spreadsheet'></i>
                        <span class="ml-3 item-text">Attendance</span>
                    </a>
                    <a href="{{ route('mobile.tasklist') }}" class="nav-link">
                        <i class='bx bx-task'></i>
                        <span class="ml-3 item-text">Task List</span>
                    </a>
                    {{-- <a href="{{ route('mobile.todos.index') }}" class=" nav-link">
                        <i class='bx bx-list-ol'></i>
                        <span class="ml-3 item-text">Todo List</span>
                    </a> --}}
                    <a href="{{ route('mobile.request') }}" class="nav-link">
                        <i class='bx bx-git-pull-request' ></i>
                        <span class="ml-3 item-text">Requests</span>
                    </a>
                    <a href="{{ route('mobile.performance') }}" class="nav-link">
                        <i class='bx bx-door-open'></i>
                        <span class="ml-3 item-text">Performance</span>
                    </a>

                    {{-- <a href="{{ route('mobile.notification') }}" class=" nav-link">
                        <i class="fe fe-bell fe-16"></i>
                        @php
                            $startOfWeek = Carbon\Carbon::now()->startOfWeek();
                            $endOfWeek = Carbon\Carbon::now()->endOfWeek();

                            $count = \App\Models\Notification::whereBetween('created_at', [
                                $startOfWeek,
                                $endOfWeek,
                            ])->count();
                        @endphp
                        <span class="ml-3 item-text w-50">Notifications <span
                                class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a> --}}
                    <a href="{{ route('mobile.team') }}" class="nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">Team Members</span>
                    </a>
                </li>

                @if(auth()->user()->role == 'social_manager' || auth()->user()->role == 'finance')
                <li class="nav-item">
                    <a href="{{ route('box.history') }}" class="nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Chat History</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'seo')
                <li class="nav-item">
                    <a href="{{ route('seo.manage') }}" class="nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">SEO Manage</span>
                    </a>
                </li>
                @endif
            </ul>
        @endif
    </nav>
</aside>

<div class="navbar-bottom navbar d-md-none">
    <div class="effect"></div>
    <a href="{{ route('mobile.dashboard') }}">
        <i class="bx bx-home"></i>
    </a>
    <a href="{{ route('mobile.attendance') }}">
      <i class='bx bx-calendar'></i>
    </a>
    <a href="{{ route('mobile.tasklist') }}">
        <i class='bx bx-task'></i>
    </a>
    <a class="plus" class="active" id="scan-qrcode-2">
        <i class="bx bx-qr qr-icon"></i>
    </a>
    {{-- @if ($checkInTime)
        <button class="plus" class="active" type="button" class="btn mx-auto d-flex justify-content-center h4 font-weight-bold" id="scan-qrcode-mobile">  <i class="bx bx-qr"></i>
        </button>
        @else
        <span style=" cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 50px;
        border-radius: 20px;
        background: transparent;
        transition: all .25s ease;">
                <button style=" padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        background: #e84c4f;
        border-radius: 50px;
        margin-top: -50px;
        box-shadow: 0 10px 20px 0 #e84c4f66;" class="plus" class="active" type="button" class="btn mx-auto d-flex justify-content-center h4 font-weight-bold" id="scan-qrcode-mobile">  <i class="bx bx-qr"></i>
                </button>
            </span>

        @endif --}}
    <a href="{{ route('mobile.request') }}">
        <i class='bx bx-message-square-edit'></i>
    </a>
    <a href="{{ route('mobile.team') }}">
        <i class='bx bx-group'></i>
    </a>
    <a href="{{ route('mobile.performance') }}">
        <i class='bx bx-male'></i>
    </a>
</div>


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
<!-- Modal -->
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
    $('#scan-qrcode-2').click(function() {
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
            url: "{{ route('mobile.attendance.marked') }}"
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
    $('#check-out-button').click(function() {
        if (latitude_loc === '' || longitude_loc === '') {
            Toast.fire({
                icon: 'warning'
                , title: 'Please enable your location and try again.'
            });
            return;
        }
        const checkoutButton = document.getElementById('check-out-button');
        checkoutButton.innerHTML = 'Checking out...';
        checkoutButton.disabled = true; // Disable the button while checking-in

        $.ajax({
            url: "{{ route('employee.check-out') }}"
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
                    checkoutButton.innerHTML = 'Check out: ' + response.checkOutTime;
                    checkoutButton.disabled = true; // Disable the button after successful check-out

                } else {
                    Swal.fire({
                        icon: 'error'
                        , title: response.message
                    });
                    checkoutButton.disabled = false;
                }
            }
            , error: function(xhr) {
                checkoutButton.innerHTML = 'Check Out';
                checkoutButton.disabled = false;
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
