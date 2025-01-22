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
<style>
    .btn-primary{
        background-color:#000;
        border-color:#02fff0;
       width: 100px;
    }
    .btn-secondary{
        background-color:#04b3ab;
        border-color:#04b3ab;
    }

    .formbold-form-file {
                  font-size: 14px;
                  line-height: 24px;
                  color: #536387;
                }
                .formbold-form-file::-webkit-file-upload-button {
                  display: none;
                }
                .formbold-form-file:before {
                  content: 'Upload file';
                  display: inline-block;
                  background: #04b3ab;
                  border: 0.5px solid #FBFBFB;
                  box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.25);
                  border-radius: 3px;
                  padding: 3px 12px;
                  outline: none;
                  white-space: nowrap;
                  -webkit-user-select: none;
                  cursor: pointer;
                  color: #fff;
                  font-weight: 500;
                  font-size: 12px;
                  line-height: 16px;
                  margin-right: 10px;
                }
</style>
    <!--====================  End of header area  ====================-->

    <!-- =======================Hero section start=======================-->

    <!-- =======================Hero section end=======================-->
    <!-- =======================services section start======================= -->
    <section class="py-4 courses_section mt-5">
        <div class="container d-flex justify-content-center">
          <div class="row justify-content-center">
            <div class="col-lg-12 text-center para text-light" data-aos="zoom-in" data-aos-duration="2000">
              <h1 class="course-section-h1">
                  Apply <span class="sys">Now</span>
                </h1>
                <p>Join us to empower your experience </p>
            </div>
        </div>
    </div>
    </section>
    <section class="section_two pb-4">
        <div class="container d-flex  ">
            <div class="row ">
                <div class="col-sm-12 col-md-6 mb-3">
                    <div class="card">

                        @livewire('apply-now')
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <img class="img-fluid" src="{{url('frontend/apply-now.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- =======================services section end=======================-->


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
