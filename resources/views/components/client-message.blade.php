<div class="testimonial-slider-area bg-gray section-space--ptb_100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrap text-center section-space--mb_40">
                    <h6 class="section-sub-title mb-20">Testimonials</h6>
                    <h3 class="heading text_dark_blue">What do people praise about <span class="text_light_blue">
                            Medtronix Systems?</span></h3>
                </div>
                <div class="testimonial-slider">
                    <div
                        class="swiper-container testimonial-slider__container swiper-container-initialized swiper-container-horizontal">
                        <div class="swiper-wrapper testimonial-slider__wrapper"
                            style="transform: translate3d(-1206px, 0px, 0px); transition-duration: 0ms;">

                            @foreach ($reviews as $review)
                            <div class="swiper-slide">
                                <img style="width: 550px; height: 250px; object-fit: cover;" src="{{ asset('storage/'.$review->picture) }}" class="img-fluid" alt="Client Image">
                            </div>
                            @endforeach


                        </div>
                        <div
                            class="swiper-pagination swiper-pagination-t01 section-space--mt_30 swiper-pagination-clickable swiper-pagination-bullets">
                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet"
                                tabindex="0" role="button" aria-label="Go to slide 2"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0"
                                role="button" aria-label="Go to slide 4"></span>
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

