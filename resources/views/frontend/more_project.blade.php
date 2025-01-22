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
            <div class="row">
                <div class="col-lg-12 para text-light" data-aos="zoom-in-up" data-aos-duration="2000">
                    {{-- <p>Industries we Serve</p> --}}
                    <h2>
                        See We have Solution Done
                        <span class="sys">IT Projects</span>
                    </h2>
                </div>
                @foreach ($projects as $project)
                <div class="col-12 col-md-6 col-lg-4 my-4" data-aos="fade-right" data-aos-duration="2000">
                    <a href="{{ route('project.detail', $project->id) }}" class="text-decoration-none">
                        <div class="card project_card p-2" style="
  background-image: url({{ asset('storage/'.$project->main_picture) }});">
                            <div class="project_content p-2" style="margin-top: auto">
                                <p class="text-light mb-0">@if($project->category == 'app')
                                    <p class="text-light mb-0">App Development</p>
                                    @elseif($project->category == 'web')
                                    <p class="text-light mb-0">Web Development</p>
                                    @elseif($project->category == 'python')
                                    <p class="text-light mb-0">Python AI</p>
                                    @elseif($project->category == 'desktop')
                                     <p class="text-light mb-0">Desktop Application</p>
                                    @endif</p>
                                <h4 class="text-light">{{ $project->name }}</h4>
                            </div>
                            <div class="arrow">
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
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

    <!--====================  End of scroll top  ====================-->



    <!-- footer -->

    <x-foot />
    @stack('scripts')

</body>

</html>
