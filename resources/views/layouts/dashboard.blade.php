
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    table.dataTable tbody tr {
    background-color: transparent;
}
    .dataTables_length option{
        color: black;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#projectTable').DataTable();
    });
</script>
@endpush

@stack('css')
    <style>
        *::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #4c545b;
        }

        *::-webkit-scrollbar {
            width: 8px;
            height: 8px;
            background-color: #4c545b;
        }

        *::-webkit-scrollbar-thumb {
            background-color: #04000B;
        }

        .btn-primary {
            background-color: #16B4AC ;
            border-color: #16B4AC ;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #fff;
            border-color: #181144;
            color: #181144;
        }

        .bg-primary {
            background-color: #16B4AC !important;
            border-color: #16B4AC !important;
            color: #fff;

        }
.dashboard-card-set .card{
    height: 80%;

}
    </style>
<x-ui.head />
<body class="g-sidenav-show  bg-gray-100">
  <x-ui.aside />
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
  <x-ui.navbar />
    <!-- End Navbar -->


    @yield('content')
  </main>

  <!--   Core JS Files   -->
<x-ui.script />
@include('flashy::message')


</body>

</html>
