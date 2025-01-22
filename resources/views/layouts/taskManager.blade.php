<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager Medtronix</title>
    <link rel="stylesheet" href="{{url('taskManager/sidebar.css')}}">
    <style>

    </style>
</head>
<body>

      <!-- Sidebar for navigation -->
  <div class="sidebar">
    <div class="logo-details">
      <!-- Icon and logo name -->
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">Codepen</div>
      <i class='bx bx-menu' id="btn"></i> <!-- Menu button to toggle sidebar -->
    </div>
    <ul class="nav-list">
      <!-- Search bar -->
      <li>
        <i class='bx bx-search'></i>
        <input type="text" placeholder="Search...">
        <span class="tooltip">Search</span>
      </li>
      <!-- List of navigation items -->
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <!-- Additional navigation items -->
      <li>
        <a href="#">
          <i class='bx bx-user'></i>
          <span class="links_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-chat'></i>
          <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name">Analytics</span>
        </a>
        <span class="tooltip">Analytics</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-folder'></i>
          <span class="links_name">File Manager</span>
        </a>
        <span class="tooltip">Files</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cart-alt'></i>
          <span class="links_name">Order</span>
        </a>
        <span class="tooltip">Order</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-heart'></i>
          <span class="links_name">Saved</span>
        </a>
        <span class="tooltip">Saved</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>
      <!-- Profile section -->
      <li class="profile">
        <div class="profile-details">
          <!--<img src="profile.jpg" alt="profileImg">-->
          <div class="name_job">
            <div class="name">PIXEL PERFECT</div>
            <div class="job">@PixelPerfectLabs</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out"></i> <!-- Logout icon -->
      </li>
    </ul>
  </div>
  <!-- Main content area -->
  <section class="home-section">
   @yield('content')
  </section>




    <script>
        // Get the sidebar, close button, and search button elements
let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
let navList = document.querySelector(".nav-list");

// Event listener for the menu button to toggle the sidebar open/close
closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open"); // Toggle the sidebar's open state
  navList.classList.toggle("scroll"); // Toggle scroll state
  menuBtnChange(); // Call function to change button icon
});

// Event listener for the search button to open the sidebar
searchBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  navList.classList.toggle("scroll");
  menuBtnChange(); // Call function to change button icon
});

// Function to change the menu button icon
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); // Change icon to indicate closing
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); // Change icon to indicate opening
  }
}
    </script>
</body>
</html>
