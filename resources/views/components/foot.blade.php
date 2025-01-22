<script src="{{ url('frontend/assets/js/bootstrap.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('frontend/assets/js/script.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

{{-- <script>
  AOS.init();
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
</script> --}}
<script>
    AOS.init();

    window.addEventListener('scroll', function () {
      var navbar = document.querySelector('.header');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        localStorage.setItem('navbarScrolled', 'true');
      } else {
        navbar.classList.remove('scrolled');
        localStorage.setItem('navbarScrolled', 'false');
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

    // const modal = document.getElementById('navModal');

    // modal.addEventListener('shown.bs.modal', function () {
    //   modal.style.backgroundColor = 'white';
    // });

    modal.addEventListener('scroll', function () {
      if (modal.scrollTop > 0) {
        modal.style.backgroundColor = 'white';
      } else {
        modal.style.backgroundColor = 'transparent';
      }
    });
    if (modal.classList.contains('show')) {
      modal.style.backgroundColor = 'white';
    }
    if (localStorage.getItem('navbarScrolled') === 'true') {
      document.querySelector('.header').classList.add('scrolled');
    }
  </script>

