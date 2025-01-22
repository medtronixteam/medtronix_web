<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-overlay__inner">
        <div class="mobile-menu-overlay__header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8">
                        <!-- logo -->
                        <div class="logo">
                            <a href="/">
                                <img src="  assets/images/Medtronix/logo-horizontal.png" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-4">
                        <!-- mobile menu content -->
                        <div class="mobile-menu-content text-end">
                            <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay__body">
            <nav class="offcanvas-navigation">
                <ul>
                    <li class="">
                        <a href="/">Home</a>

                    </li>

                    <li class="has-children">
                        <a href="#">Company</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('about.as') }}"><span>About us</span></a>

                            </li>
                            <li><a href="{{ route('contact.us') }}"><span>Contact us</span></a></li>
                            <li><a href="{{ route('leadership') }}"><span>Leadership</span></a></li>
                            <li><a href="{{ route('why.choose.us') }}"><span>Why choose us</span></a></li>
                            <li><a href="{{ route('our.history') }}"><span>Our history</span></a></li>
                            <li><a href="{{ route('404') }}"><span>FAQs</span></a></li>
                            <li><a href="{{ route('careers') }}"><span>Careers</span></a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#">IT solutions</a>
                        <ul class="sub-menu">
                            <li><a href="it-services.html"><span>IT Services</span></a></li>
                            <li><a href="managed-it-service.html"><span>Managed IT Services</span></a></li>
                            <li><a href="industries.html"><span>Industries</span></a></li>
                            <li><a href="business-solution.html"><span>Business solution</span></a></li>
                            <li><a href="it-services-details.html"><span>IT Services Details</span></a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#">Technologies</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('c.plus') }}"><span>C++</span></a></li>
                            <li><a href="{{ route('react.js') }}"><span>React JS</span></a></li>
                            <li><a href="{{ route('node.js') }}"><span>Node JS</span></a></li>
                            <li><a href="{{ route('flutter') }}"><span>Flutter</span></a></li>
                            <li><a href="{{ route('404') }}"><span>Python</span></a></li>
                            <li><a href="{{ route('php') }}"><span>PHP</span></a></li>
                            <li><a href="{{ route('csharp') }}"><span>C#</span></a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#">Services</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('services_web.development') }}"><span>Web Development</span></a></li>
                            <li><a href="{{ route('android') }}"><span>Android Development</span></a></li>
                            <li><a href="{{ route('graphics') }}"><span>Graphics Designing</span></a></li>
                            <li><a href="{{ route('UIUX') }}"><span>UI/UX Designing</span></a></li>
                            <li><a href="{{ route('desktop.application') }}"><span>Desktop Application</span></a></li>
                            <li><a href="{{ route('freelancing') }}"><span>Freelancing / Fiver</span></a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#">Portfolio</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('portfolio') }}"><span>Case Studies</span></a></li>
                        </ul>

                    </li>
                    <li class="">
                        <a href="{{ route('courses') }}"><span>Courses</span></a>

                    </li>




                </ul>
            </nav>
        </div>
    </div>
</div>
