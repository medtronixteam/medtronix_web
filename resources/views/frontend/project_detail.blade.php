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

    <!-- =======================Recent Projects Section======================= -->
    <section class="section_two" style="margin-top:10%;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 para text-light" data-aos="zoom-in-right" data-aos-duration="2000">
                    <h2>
                        <span class="sys">Project</span>
                        Details
                    </h2>
                </div>

            <div class="col-12 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
                <img src="{{ asset('storage/'.$detail->main_picture) }}" alt="not show" class="img-thumbnail">
            </div>
            <div class="col-12 col-md-8 mt-md-0 mt-4" data-aos="zoom-in-left" data-aos-duration="2000">
                <h1 class="text-white">{{ $detail->name }} <span class="sys">({{ $detail->category}})</span> </h1>
                <h5 class="sys">Description:</h5>
                <p>{{ $detail->description }}</p>
            </div>

            </div>
        </div>
    </section>
    <!-- =======================Recents PRojects End======================= -->

    <!--====================  footer area ====================-->

    <x-footer />

    <!--====================  End of footer area  ====================-->

    </div>
    <!--====================  scroll top ====================-->

    <a href="#" id="scrollToTop" title="Go to top" data-aos="zoom-in" data-aos-duration="2000"><i class="fa-solid fa-arrow-up"></i></a>
    <a href="https://wa.me/923443228863" class="whatsappChat text-dark text-decoration-none" data-aos="zoom-in" data-aos-duration="2000"><i class="bx bxl-whatsapp text-white fa-4x"></i></a>
    <!-- footer -->

    <x-foot />
    @stack('scripts')

</body>

</html>
