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

    <!-- =======================Hero section start=======================-->
    <section id="section_one" style="margin-top: 8%;">
        <div class="container-fluid hero">
            <div class="row">
                <div class="col-md-5 main-img">
                    <img class="img-fluid" src="{{ url('frontend/assets/images/home/hero-banner.png') }}" alt="hero-banner" id="floating-img" />
                </div>
                <div class="col-md-7 text-column">
                    <div class="circle circle-start"></div>
                    <div class="txt-col">
                        <h1 class="med-h1 pt-5" data-aos="zoom-in-up" data-aos-duration="2000">
                            Medtronix Company Provides
                            <span class="sys">IT SERVICES</span> and Develops Software.
                        </h1>
                    </div>
                    <div class="circle circle-end"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================Hero section end=======================-->
    <!-- =======================services section start======================= -->
    <section class="section_two py-4">
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center para text-light" data-aos="zoom-in-up" data-aos-duration="2000">
                    <h2>
                        Services We Deliver <br />We Provide Truly
                        <span class="sys">Prominent IT Solutions.</span>
                    </h2>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/AI.png') }}" alt="Artifical Intelligence" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/01.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>Artifical Intelligence</h3>
                            <p class="m-0">
                                Artificial Intelligence (AI) is a branch of computer science
                                that focuses on creating systems capable of performing tasks
                                that typically require human intelligence. These tasks include
                                learning, reasoning, problem-solving, understanding natural
                                language, speech recognition, and computer vision.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/web-developing.png') }}" alt="Web Developing" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/02.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>Web Development</h3>
                            <p class="m-0">
                                A Web development company with 5 years of excellence, we
                                create reliable, scalable, and secure software solutions for
                                any OS, browser, or device. Combining industry expertise with
                                the latest IT advancements, we deliver custom solutions
                                tailored to meet user needs and behavior.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/quotes.png') }}" alt="Testing & QA" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/03.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>Testing & QA</h3>
                            <p class="m-0">
                                We offer full-range QA and testing outsourcing services, can
                                help to develop your QA or enhance the existing one, assist
                                you in TCoE setup and evolution. We perform end-to-end testing
                                of mobile, web and desktop application at each stage of the
                                development lifecycle.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/flutter.png') }}" alt="Flutter" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/04.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>App Development</h3>
                            <p class="m-0">
                                Our experts help mid-sized and large firms build, test,
                                secure, manage, migrate, and optimize digital solutions. We
                                ensure they remain fully operational, perform optimally, and
                                are protected from potential risks, keeping your systems
                                aligned with evolving business goals.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/ux-design.png') }}" alt="ux-design" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/05.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>UX/UI Design</h3>
                            <p class="m-0">
                                User experience and user interface design for all types of
                                websites, SaaS, and web/mobile apps. We combine the latest
                                UI/UX trends with our customers, individual goals and needs to
                                deliver intuitive, vibrant, and impactful designs that power
                                up businesses.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3">
                        <div class="d-flex justify-content-between mt-2">
                            <img class="image" src="{{ url('frontend/assets/images/cards/consultant.png') }}" alt="consultant" />
                            <img style="height: 40px; width: 55px" src="{{ url('frontend/assets/images/cards/06.png') }}" alt="number" />
                        </div>
                        <div class="px-4 card_text">
                            <h3>Desktop Application</h3>
                            <p class="m-0">
                                Our experts can help develop and implement a robust IT
                                strategy, guide a smooth digital transformation, and manage
                                system integration. We also advise on enhancing digital
                                customer experience and recommend improvements to keep your
                                business agile and competitive.
                            </p>
                        </div>
                        <div>
                            <img class="float-right" style="width: 55px" src="{{ url('frontend/assets/images/cards/next.png') }}" alt="next" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================services section end=======================-->
    <!-- =======================CEO section=======================-->
    <section class="section_two cto-container" data-aos="zoom-in-up" data-aos-duration="2000">
        <div class="container cto-section d-md-flex d-none">
            <img class="img-fluid rounded" src="{{ url('frontend/assets/images/home/meet-our-ceo.png') }}" alt="meet-our-ceo" />
        </div>
        <div class="container cto-section d-md-none d-block">
            <img class="img-fluid rounded" src="{{ url('frontend/assets/images/home/meet-our-ceo-responsive.png') }}" alt="meet-our-ceo" />
        </div>
    </section>
    <!-- =======================Fun Facts section start=======================-->
    <section class="fun-fact-wrapper bg-theme-default section-space--pb_30 section-space--pt_60 bg_dark_blue">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="2000" style="visibility: visible">
                    <div class="fun-fact--two text-center">
                        <div class="fun-fact__count counter">80</div>
                        <h6 class="fun-fact__text">Happy clients</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="2000" style="visibility: visible">
                    <div class="fun-fact--two text-center">
                        <div class="fun-fact__count counter">120</div>
                        <h6 class="fun-fact__text">Finished projects</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="2000" style="visibility: visible">
                    <div class="fun-fact--two text-center">
                        <div class="fun-fact__count counter">80</div>
                        <h6 class="fun-fact__text">Skilled Experts</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="2000" style="visibility: visible">
                    <div class="fun-fact--two text-center">
                        <div class="fun-fact__count counter">318</div>
                        <h6 class="fun-fact__text">Media Posts</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================Fun Facts Section end ======================= -->
    <!-- ===================Our Process section start====================== -->
    <section class="py-4">
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12 text-center para text-light" data-aos="zoom-in-up" data-aos-duration="2000">
                    <h2>
                        Simple
                        <span class="sys">STEPS</span> We Follow
                    </h2>
                    <p class="w-75 m-auto"> We begin by understanding your goals, then craft tailored
                        solutions. Our team ensures smooth integration, thorough testing,
                        and ongoing support, delivering quality results at every stage.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-5" data-aos="zoom-in-left" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3 bg-transparent">
                        <div class="d-flex justify-content-between mt-lg-5">
                            <h1 class="m-auto process-h1">01</h1>
                        </div>
                        <div class="px-4 card_text process-content">
                            <h3 class="process-h3">Project Analysis</h3>
                            <p class="m-0 text-white">
                                We define your goals and create a tailored plan to meet your
                                needs.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-lg-2 mt-md-5" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3 bg-transparent">
                        <div class="d-flex justify-content-between mt-lg-2">
                            <h1 class="m-auto process-h1">02</h1>
                        </div>
                        <div class="px-4 card_text process-content">
                            <h3 class="process-h3">Research & Implement </h3>
                            <p class="m-0 text-white">
                                We conduct research and implement the project efficiently.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-5" data-aos="zoom-in-right" data-aos-duration="2000">
                    <div class="card m-3 pl-3 pb-3 bg-transparent">
                        <div class="d-flex justify-content-between mt-lg-5">
                            <h1 class="m-auto process-h1">03</h1>
                        </div>
                        <div class="px-4 card_text process-content">
                            <h3 class="process-h3">Testing & Launch</h3>
                            <p class="m-0 text-white">
                                We launch the solution and provide support for lasting
                                success.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================Our Process section start====================== -->
    <!-- =======================Recent Projects Section======================= -->
    <section class="section_two pb-5">
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
                    <a href="{{ route('project.detail',$project->id) }}" class="text-decoration-none">
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
                <!-- ================See More Button======================= -->
                <div class="d-flex m-auto">
                    <a class="btn-content text-decoration-none" href="{{ route('more.project') }}">
                        <span class="btn-title">See More</span>
                        <span class="icon-arrow">
                            <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                    <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                    <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- ================See More Button======================= -->
            </div>
        </div>
    </section>
    <!-- =======================Recents PRojects End======================= -->
    <!-- ======================Testimonial section start=========================== -->
    <section class="py-4">
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center para text-light" data-aos="zoom-in-up" data-aos-duration="2000">
                    {{-- <p>Industries We Serve</p> --}}
                    <h2>
                        What Do People Praise About
                        <span class="sys">Medtronix Systems</span>
                    </h2>
                    {{-- <h1>Clients Reviews</h1> --}}
                </div>
            </div>
        </div>
    </section>

    <div class="owl-carousel testimonial-carousel">
        <!--   Start Testimonials -->
        <!--   Testimonial 1 -->
        @foreach ($reviews as $review)
        @if($review->status == '1')
        <div class="single-testimonial" data-aos="zoom-in" data-aos-duration="2500">
            <div class="testimonials-wrapper">
                <img src="{{ asset('storage/'.$review->picture) }}" alt="not show" class="rounded">
            </div>
        </div>
        @endif
        @endforeach
        <!--   =======================End Testimonials======================= -->
    </div>

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
