<nav class="topnav navbar navbar-light d-md-flex d-none">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    {{-- <form class="form-inline mr-auto searchform text-muted">
      <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
    </form> --}}
        <div class="d-flex align-items-center dashboard-header">
            <a href="{{ route('mobile.notification') }}"> <i class="fe fe-bell fe-16 d-flex justify-content-center align-items-center mx-2 bell-icon "></i></a>
            {{-- <div class="dropdown">
                <img src="{{ asset('storage/'.Auth::user()->picture) }}" alt="img" class="img-fluid">
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Logout</a>
            </div>
        </div> --}}
        <ul class="nav">
            {{-- <li class="nav-item">
              <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                <i class="fe fe-sun fe-16"></i>
              </a>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="avatar avatar-sm mt-2">
                        <img style="height: 45px; width:45px; border-radius:50px" src="{{ asset('storage/'.Auth::user()->picture) }}" alt="no_pic" class="avatar-img">
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    @if (auth()->user()->role=="admin")

                    <a class="dropdown-item" href="{{route('profile.settings')}}">Profile</a>
                    @else
                    <a class="dropdown-item" href="{{route('mobile.profile')}}">Profile</a>

                    @endif

                    {{-- <a class="dropdown-item" href="{{ route('profile.settings') }}">Settings</a> --}}

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
</div>
</nav>


<div class="container-fluid d-md-none">
    <header class="p-3 d-flex justify-content-between align-items-center dashboard-header">
        <h2><a href="{{ route('mobile.dashboard') }}">Dashboard</a></h2>
        <div class="d-flex align-items-center">
            <a href="{{ route('mobile.notification') }}"><i class='bx bxs-bell-ring d-flex justify-content-center align-items-center mx-2 bell-icon '></i></a>
            {{-- <div class="dropdown">
                <img src="{{ asset('storage/'.Auth::user()->picture) }}" alt="img" class="img-fluid">
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Logout</a>
            </div>
        </div> --}}
        <ul class="nav">
            {{-- <li class="nav-item">
              <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                <i class="fe fe-sun fe-16"></i>
              </a>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="avatar avatar-sm mt-2">
                        <img style="height: 45px; width:45px; border-radius:50px" src="{{ asset('storage/'.Auth::user()->picture) }}" alt="no_pic" class="avatar-img">
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    @if (auth()->user()->role=="admin")

                    <a class="dropdown-item" href="{{route('profile.settings')}}">Profile</a>
                    @else
                    <a class="dropdown-item" href="{{route('mobile.profile')}}">Profile</a>

                    @endif

                    {{-- <a class="dropdown-item" href="{{ route('profile.settings') }}">Settings</a> --}}

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
</div>
</header>
</div>
