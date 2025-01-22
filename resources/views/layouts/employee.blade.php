<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
    <x-employee-head />

</head>

<body class="vertical  dark  ">
    <div class="wrapper">

        <x-employee-header />

        @yield('content')


    </div> <!-- .wrapper -->
    <x-employee-navbar />

    <x-employee-footer />


    @include('flashy::message')


    





</body>

</html>
