<x-head />
    <!-- =======================navbar=======================  -->
     <section class="hero-section courses_hero_section">
  <x-header />
  <!--=============== Header end ===============-->
  <!-- ============Hero Section start============== -->
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row" data-aos="fade-up"
        data-aos-anchor-placement="center-bottom" data-aos-duration="2000">
            <div class="col-12 hero-section-content">
              <h2 class="d-flex justify-content-center align-items-center">Courses</h2>
              <p class="align-items-center">Let us help your business thrive in this digital age</p>
            </div>
        </div>
    </div>
</section>
  <!-- ============Hero Section end============== -->
   <!-- =================courses section start================ -->
   <section class="py-4 courses_section">
  <div class="container d-flex justify-content-center">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center para text-light" data-aos="zoom-in" data-aos-duration="2000">
        <h1 class="my-lg-5 course-section-h1">
            Our <span class="sys">Courses</span>
          </h1>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/web-development.png') }}" alt="Website Development" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Website Development</h5>
            <p class="text-black-50"> Learn how to create professional, responsive websites using
                the latest tools and best practices to enhance user experience
                and functionality.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('course.web.development') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/app.png') }}" alt="App Development" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">App Development</h5>
            <p class="text-black-50">Master the art of building cross-platform mobile applications
                with Flutter, enabling smooth performance across different
                devices.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('course.app.development') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/seo.png') }}" alt="Search Engine Optimization" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Search Engine Optimization</h5>
            <p class="text-black-50"> Discover strategies to optimize your website for search
                engines, improving visibility, ranking, and driving organic
                traffic.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('seo') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="zoom-in-right" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/python.png') }}" alt="Python AI / ML" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Python AI / ML</h5>
            <p class="text-black-50"> Learn to build powerful applications using Python, one of the
                most versatile and popular programming languages.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('python') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/graphics.png') }}" alt="Graphics Designing" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Graphics Designing</h5>
            <p class="text-black-50"> Develop creative and technical skills to design visually
                appealing digital content that stands out.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('graphics') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/uiux.png') }}" alt="UI/UX Designing" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">UI/UX Designing</h5>
            <p class="text-black-50"> Master the principles of user interface and user experience
                design to create intuitive, user-friendly products.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('course.ui.ux') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>


      {{-- <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/desktop.png') }}" alt="Desktop Application" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Desktop Application</h5>
            <p class="text-black-50"> Learn to build powerful desktop applications that provide
                seamless performance and a great user experience.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="#" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div> --}}

      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/wordpress.png') }}" alt="Wordpress Development" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Wordpress Development</h5>
            <p class="text-black-50">Get hands-on experience building and managing websites using
                WordPress, the world’s most popular CMS.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
                <a href="{{ route('wordpress') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
                <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-duration="2000">
        <div class="card m-3 pb-3 courses-cards">
          <div class="d-flex justify-content-between">
            <img class="card-img-top courses-cards-img" src="{{ url('frontend/assets/images/courses/freelancing.png') }}" alt="Freelancing" />
          </div>
          <div class="card-body card-content">
            <h5 class="card-title mb-3">Freelancing</h5>
            <p class="text-black-50"> Master the skills to work independently, manage clients, and
                grow your freelancing career successfully.</p>
            <div class="d-flex justify-content-between">
              <p class="text-black-50"><i class="fa-regular fa-clock text-black-50"></i> 1 - 1:15 hours</p>

            </div>
            <div class="d-flex justify-content-between flex-lg-nowrap flex-wrap">
              <a href="{{ route('freelancing') }}" class="btn cards-btns px-2 px-sm-4">More Info</a>
              <a href="{{ route('contactUs') }}" class="btn cards-btns-2 text-white px-2 px-sm-4 mx-sm-1" style="background-color:#04b3ab;">Apply now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
   <!-- =================courses section end================ -->
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

