<x-head />

<body>

    {{-- <div class="preloader-activate preloader-active open_tm_preloader">
        <div class="preloader-area-wrap">
            <div class="spinner d-flex justify-content-center align-items-center h-100">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div> --}}

    <!--====================  header area ====================-->
    <x-header />

    <!--====================  End of header area  ====================-->

    @yield('content')

    <!--====================  footer area ====================-->

    <x-footer />

    <!--====================  End of footer area  ====================-->

    </div>
    <!--====================  scroll top ====================-->


    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top fas fa-chevron-up"></i>
        <i class="arrow-bottom fas fa-chevron-up"></i>
    </a>
    <a class="whatsappChat" href="https://wa.me/923443228863"> <img class="img-fluid whatsapp-img" src="{{ url('assets/images/Medtronix/whatsapp-icom.svg') }}" alt="error">
    </a>
    <!--====================  End of scroll top  ====================-->


    <!--====================  mobile menu overlay ====================-->

    <x-mobile-header />

    <!--====================  End of mobile menu overlay  ====================-->


    <!-- footer -->

    <x-foot />
    @stack('scripts')

</body>

</html>
