<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('Logo-01.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('Logo-01.ico')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Thumbnail for Social Media Sharing -->
    <meta property="og:title" content="Medtronix Company provides IT services and develops software.">
    <meta property="og:description" content="Medtronix specializes in technological and IT-related services such as product engineering, warranty management, building cloud, infrastructure, network, etc.">
    <meta property="og:image" content="{{url('Logo-01.ico')}}">
    <meta property="og:url" content="https://medtronix.world">
    <meta property="og:type" content="website">
    <title>Medtronix Systems</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="admin/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ url("admin/css/feather.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/select2.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/dropzone.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/uppy.min.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/jquery.steps.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/jquery.timepicker.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/quill.snow.css") }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="{{ url('employee/assets/css/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" /> --}}
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ url("admin/css/daterangepicker.css") }}">
    <link rel="stylesheet" href="{{ url("admin/css/dataTables.bootstrap4.css") }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ url("admin/css/app-light.css") }}" id="lightTheme">
    <link rel="stylesheet" href="{{ url('employee/assets/css/style.css') }}">

    <style>
        .bg-primary {
            background: #16B4AC !important;
            color: white;
        }

        .btn-outline-primary {
            background: white !important;
            border: 1px solid #181144 !important;
            color: #181144;
        }

        .btn-outline-primary:hover {
            background: #181144 !important;
            color: white;
        }
@media (max-width:768px){
    .attendance-card{
        margin-bottom: 150px !important;
    }
    .m-card{
        margin-bottom: 150px !important;
    }
}
    </style>

    @stack('css')
</head>
