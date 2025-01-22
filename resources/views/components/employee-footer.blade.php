<script src="{{ url('admin/js/jquery.min.js') }}"></script>
<script src="{{ url('admin/js/popper.min.js') }}"></script>
<script src="{{ url("admin/js/moment.min.js") }}"></script>
<script src="{{ url("admin/js/bootstrap.min.js") }}"></script>
<script src="{{ url("admin/js/simplebar.min.js") }}"></script>
<script src="{{ url('admin/js/daterangepicker.js') }}"></script>
<script src="{{ url('admin/js/jquery.stickOnScroll.js') }}"></script>
<script src="{{ url("admin/js/tinycolor-min.js") }}"></script>
<script src="{{ url("admin/js/config.js") }}"></script>
<script src="{{ url("admin/js/d3.min.js") }}"></script>
<script src="{{ url("admin/js/topojson.min.js") }}"></script>
<script src="{{ url("admin/js/datamaps.all.min.js") }}"></script>
<script src="{{ url("admin/js/datamaps-zoomto.js") }}"></script>
<script src="{{ url("admin/js/datamaps.custom.js") }}"></script>
<script src="{{ url("admin/js/Chart.min.js") }}"></script>

<script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="{{ url("admin/js/gauge.min.js") }}"></script>
<script src="{{ url("admin/js/jquery.sparkline.min.js") }}"></script>
<script src="{{ url("admin/js/apexcharts.min.js") }}"></script>
<script src="{{ url("admin/js/apexcharts.custom.js") }}"></script>
<script src="{{ url('admin/js/jquery.mask.min.js') }}"></script>
<script src="{{ url('admin/js/select2.min.js') }}"></script>
<script src="{{ url('admin/js/jquery.steps.min.js') }}"></script>
<script src="{{ url('admin/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('admin/js/jquery.timepicker.js') }}"></script>
<script src="{{ url('admin/js/dropzone.min.js') }}"></script>
<script src="{{ url('admin/js/uppy.min.js') }}"></script>
<script src="{{ url('admin/js/quill.min.js') }}"></script>
<script src='{{url("admin/js/jquery.dataTables.min.js")}}'></script>
<script src='{{url("admin/js/dataTables.bootstrap4.min.js")}}'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
{{-- this editor not use👇 --}}
{{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
@stack('js')
@include('flashy::message')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    $('.dataTable').DataTable();
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    $('.select2-multi').select2({
        multiple: true,
        theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });
    $('.time-input').timepicker({
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000", {
        placeholder: "__/__/____"
    });
    $('.input-zip').mask('00000-000', {
        placeholder: "____-___"
    });
    $('.input-money').mask("#.##0,00", {
        reverse: true
    });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/,
                optional: true
            }
        },
        placeholder: "___.___.___.___"
    });
    // editor
    // var editor = document.getElementById('editor');
    // if (editor) {
    //     var toolbarOptions = [
    //         [{
    //             'font': []
    //         }],
    //         [{
    //             'header': [1, 2, 3, 4, 5, 6, false]
    //         }],
    //         ['bold', 'italic', 'underline', 'strike'],
    //         ['blockquote', 'code-block'],
    //         [{
    //                 'header': 1
    //             },
    //             {
    //                 'header': 2
    //             }
    //         ],
    //         [{
    //                 'list': 'ordered'
    //             },
    //             {
    //                 'list': 'bullet'
    //             }
    //         ],
    //         [{
    //                 'script': 'sub'
    //             },
    //             {
    //                 'script': 'super'
    //             }
    //         ],
    //         [{
    //                 'indent': '-1'
    //             },
    //             {
    //                 'indent': '+1'
    //             }
    //         ], // outdent/indent
    //         [{
    //             'direction': 'rtl'
    //         }], // text direction
    //         [{
    //                 'color': []
    //             },
    //             {
    //                 'background': []
    //             }
    //         ], // dropdown with defaults from theme
    //         [{
    //             'align': []
    //         }],
    //         ['clean'] // remove formatting button
    //     ];
    //     var quill = new Quill(editor, {
    //         modules: {
    //             toolbar: toolbarOptions
    //         },
    //         theme: 'snow'
    //     });
    // }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    function showPushNotification(title,body) {
        Push.create(title, {
    body:body,
    icon: "https://medtronix.world/assets/images/Medtronix/logo-horizontal.png",
    // Remove the timeout parameter to make the notification persistent
    onClick: function () {
        window.open('https://www.medtronix.world', '_blank'); // Open the link in a new tab
        window.focus();
        this.close(); // Close the notification
    }
});
    }

// Pusher.logToConsole = true;

// var pusher = new Pusher('522eece01cd7e27ffc66', {
//   cluster: 'ap2'
// });

// var channel = pusher.subscribe('checkChannel');
// channel.bind('CheckNotify', function(data) {
//     console.log(data);
//   showPushNotification('Medtronix System',data.data);
// });
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg) {
        var uppy = Uppy.Core().use(Uppy.Dashboard, {
            inline: true,
            target: uptarg,
            proudlyDisplayPoweredByUppy: false,
            theme: 'dark',
            width: 770,
            height: 210,
            plugins: ['Webcam']
        }).use(Uppy.Tus, {
            endpoint: 'https://master.tus.io/files/'
        });
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    }
</script>
<script src="{{url('admin/js/apps.js')}}"></script>

<script>
    const navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active');
        });
    });
    document.querySelector('.dashboard-header .dropdown img').addEventListener('click', function() {
var dropdown = this.closest('.dropdown');
dropdown.classList.toggle('active');
});

</script>
