<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    {{-- <form class="form-inline mr-auto searchform text-muted">
      <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
    </form> --}}
    <ul class="nav">
      {{-- <li class="nav-item">
        <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
          <i class="fe fe-sun fe-16"></i>
        </a>
      </li> --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="avatar avatar-sm mt-2">
            <img style="height: 35px; width:40px; border-radius:5px" src="{{ asset('storage/'.Auth::user()->picture) }}" alt="no_pic" class="avatar-img">
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        @if (auth()->user()->role=="admin")

        <a class="dropdown-item" href="{{route('profile.settings')}}">Profile</a>
        @else
        <a class="dropdown-item" href="{{route('employee.profile')}}">Profile</a>

        @endif

          {{-- <a class="dropdown-item" href="{{ route('profile.settings') }}">Settings</a> --}}

           <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
