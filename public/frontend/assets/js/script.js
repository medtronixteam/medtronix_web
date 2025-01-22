// ==============Testimonials==============
$(function() {
    $('.owl-carousel.testimonial-carousel').owlCarousel({
      nav: true,
      navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
      dots: false,
      responsive: {
        0: {
          items: 1,
        },
        750: {
          items: 2,
        }
      }
    });
  });

  //================Header script==========
    window.addEventListener('scroll', function () {
      var navbar = document.querySelector('.header');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  function closeModalOnLargeScreen() {
    if (window.innerWidth >= 992) {
      const modalElement = document.getElementById('navModal');
      const modal = bootstrap.Modal.getInstance(modalElement);
      if (modal) {
        modal.hide();
      }
    }
  }

  window.addEventListener('resize', closeModalOnLargeScreen);

  window.addEventListener('load', closeModalOnLargeScreen);


// =========Sroll to top button
// Get the button
var scrollToTopButton = document.getElementById("scrollToTop");

// Show the button after scrolling down 20px
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollToTopButton.style.display = "block";
  } else {
    scrollToTopButton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the page
scrollToTopButton.onclick = function() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
};