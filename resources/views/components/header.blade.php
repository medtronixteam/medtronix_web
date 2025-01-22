<!-- =======================navbar=======================  -->
<header class="header">
    <div class="container-fluid pr-0">
        <nav class="navbar navbar-expand-lg navbar-custom py-2">
            <div class="container-fluid">
                <a class="navbar-brand pl-0" href="{{ route('home') }}">MEDTRONIX <span>SYSTEMS</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#navModal" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="background-color: transparent; color: black;"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav justify-content-center p-1" id="navbarNav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses') }}">Courses</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">
                                Services <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item" href="{{ route('web.development') }}">Web Development</a></li>
                                <li><a class="dropdown-item" href="{{ route('app.development') }}">App Development</a></li>
                                <li><a class="dropdown-item" href="{{ route('ui.ux') }}">UI/UX Design</a></li>
                                <li><a class="dropdown-item" href="{{ route('desktop.app') }}">Desktop App</a></li>
                                <li><a class="dropdown-item" href="{{ route('artificial.intelligence') }}">Artificial intelligence</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('portfolio') }}">Portfolio</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="btn btn-custom" href="{{ route('contactUs') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-custom d-none d-lg-inline-block" href="{{ route('contactUs') }}">Contact Us</a>
            </div>
        </nav>
    </div>
</header>
<div class="modal right fade navbar-modal" id="navModal" tabindex="-1" aria-labelledby="navModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header bg-white text-dark">
                <h5 class="modal-title" id="navModalLabel" ><img src="{{ url('frontend/assets/images/logo.png') }}" alt="" class="img-fluid w-50"></h5>
                <button type="button" class="btn-close custom-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class='bx bx-x'></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses') }}">Courses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark" href="#" role="button" id="servicesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Services <i class='bx bx-chevron-down'></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="{{ route('web.development') }}">Web Development</a></li>
                            <li><a class="dropdown-item" href="{{ route('app.development') }}">App Development</a></li>
                            <li><a class="dropdown-item" href="{{ route('ui.ux') }}">UI/UX Design</a></li>
                            <li><a class="dropdown-item" href="{{ route('desktop.app') }}">Desktop App</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('portfolio') }}">Portfolio</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="btn btn-custom" href="{{ route('contactUs') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class=" bg-white" style="margin-top: 70px">

    <marquee behavior="scroll" direction="left">
        <p class="text-dark p-0 m-0">We are hiring! Join our team as a Python Developer, AI Specialist, QA Tester, Full-Stack Developer, or Frontend Developer. <a href="/apply-now" class="text-primary">Apply now </a> and be part of an innovative journey!
        </p>
             </marquee>

</div>
<!--=============== Header end ===============-->
