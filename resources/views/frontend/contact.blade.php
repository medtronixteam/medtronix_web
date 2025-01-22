
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



  <!-- ==================  contact-section ================== -->
  <section class="contact-section mt-5">
    <div class="container">
      <div class="row mt-5 pt-5">
        <div class="col-lg-6 contact-section" style="padding: 10px 15px">
          <div class="heading mt-2" style="padding: 10px 10px">
            <p style="color: #04B3AB;" data-aos="fade-right" data-aos-duration="2000">CONTACT NOW</p>
            <h1 class="mb-4" data-aos="zoom-in" data-aos-duration="2000">Have Question? <br> Write a
              Message</h1>
          </div>
           @if (session('success'))
            <div class="alert alert-success text-dark mb-2" data-aos="zoom-in-up" data-aos-duration="2000">
                {{ session('success') }}
            </div>
            @endif
          <form action="{{ route('message.save') }}" method="POST" data-aos="zoom-in-up" data-aos-duration="2000">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control custom-input" name="name" placeholder="Enter Your Name" required>
              @error('name')
                  <span class="text-danger">
                      {{ $message }}
                  </span>
                  @enderror
            </div>
            <div class="form-group mt-3">
              <input type="email" class="form-control custom-input" name="email" placeholder="Enter Your Email*" required>
              @error('email')
              <span class="text-danger">
                  {{ $message }}
              </span>
              @enderror
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control custom-textarea" id="message" name="message" rows="4"
                placeholder="Enter your message" required></textarea>
                @error('message')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="col-12 mt-5">
              <div class="form-group">
                <div class="button text-center">
                  <button type="submit" class="btn btn-gradient"
                    style="width: 100%; padding: 8px 0px; border-radius: 30px; border: none; ">
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </form>


        </div>
        <div class="col-lg-6 mt-5">
          <div class="row">
            <div class="col-12" data-aos="zoom-in-down" data-aos-duration="2000">
              <div class="card p-3" style="background-color: white;">
                <div class="d-flex align-content-center">
                  <i class='bx bxs-phone mr-1' style="color: #04B3AB; font-size: 35px;"></i>
                  <h2 class="mb-0" style="font-size: 30px; font-weight:600;">Phone</h2>
                </div>
                <p class="text-dark">Assistance hours: Monday - Friday, 9 am to 6 pm
                </p>
                <strong><a href="tel:+923443228863" style="color: #04B3AB; text-decoration: underline;">040-2038224</a>

                </strong>
              </div>
            </div>
            <div class="col-12 mt-4" data-aos="zoom-in-up" data-aos-duration="2000">
              <div class="card p-3 text-white" style="background-color: black; border:inset 1px solid rgb(255, 252, 252);">
                <div class="d-flex align-items-center">
                  <i class='bx bxs-envelope mr-1' style="color: #04B3AB; font-size: 35px;"></i>
                  <h2 class="mb-0" style="font-size: 30px; font-weight:600;">Email</h2>
                </div>
                <p > Our Support team will get back to you in 24h during
                    Standard business hours.
                </p>
                <strong style="color:#04B3AB;"><a href="mailto:contact@medtronix.world" style="color: #04B3AB; text-decoration: underline;">contact@medtronix.world</a>

                </strong>
              </div>
            </div>
            <div class="col-12 mt-4" data-aos="zoom-in-left" data-aos-duration="2000">
              <div class="card p-3" style="background-color: rgb(255, 255, 255);">
                <div class="d-flex align-items-center">
                  <i class='bx bx-id-card mr-1' style="color: #04B3AB; font-size: 35px;"></i>
                  <h2 class="mb-0" style="font-size: 30px; font-weight:600;">Address</h2>
                </div>
                <p class="text-dark">Opposite National Saving Bank, Goal Chakar Sahiwal. 57000
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ==================  contact-section end ================== -->

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
