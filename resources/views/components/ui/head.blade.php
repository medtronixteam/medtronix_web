
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('Logo-01.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('Logo-01.ico')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Medtronix Company provides IT services and develops software.">
    <meta property="og:description" content="Medtronix specializes in technological and IT-related services such as product engineering, warranty management, building cloud, infrastructure, network, etc.">
    <meta property="og:image" content="{{url('Logo-01.ico')}}">
    <meta property="og:url" content="https://medtronix.world">
    <meta property="og:type" content="website">
    <title>
      Medtronix Systems
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url("ui/css/nucleo-icons.css") }}" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ url("ui/css/nucleo-svg.css") }}" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url("ui/css/soft-ui-dashboard.css?v=1.0.3") }}" rel="stylesheet" />

    @stack('css')
  </head>
