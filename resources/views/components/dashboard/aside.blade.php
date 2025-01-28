<style>
    .badge-white {
        background-color: white;
        color: black;
    }

</style>
<aside class="sidebar-left border-right bg-primary shadow"  style="" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-dark">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
                <b>Medtronix</b>
            </a>
        </div>
        @if (auth()->user()->role == 'admin')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item ">
                    <a href="{{ route('admin.dashboard') }}" class=" nav-link">
                        <i class="fa fa-rocket fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a>

                </li>
                {{-- <li class="nav-item ">
                    <a href="{{ route('task.manager') }}" class=" nav-link">
                        <i class="fa fa-rocket fe-16"></i>
                        <span class="ml-3 item-text">Task Manager</span>
                    </a>

                </li> --}}


                <li class="nav-item dropdown">
                    <a href="#Employee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Employee</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Employee">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ route('employees.create') }}"><span
                                    class="ml-1 item-text">Add</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('employees.index') }}"><span
                                    class="ml-1 item-text">List</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('salary_slips.index') }}"><span
                                    class="ml-1 item-text">SalarySlip List</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('employees.disable-user') }}"><span
                                    class="ml-1 item-text">Disabled Employee</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#Projects" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa fa-cubes fe-16"></i>
                        <span class="ml-3 item-text">Projects</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Projects">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ route('projects.create') }}"><span
                                    class="ml-1 item-text">Add</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('projects.index') }}"><span
                                    class="ml-1 item-text">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#Attendances" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-check-square fe-16"></i>
                        <span class="ml-3 item-text">Attendances</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Attendances">
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('attendances.index') }}"><span
                                    class="ml-1 item-text">Mark</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('attendances.create') }}"><span
                                    class="ml-1 item-text">Lists</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('employee.attendence.list') }}"><span
                                    class="ml-1 item-text">Show in Attendence</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item {{ request()->routeis('employee.tasklist') ? 'active' : '' }}">
                    <a href="{{ route('work.history') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Task History</span>
                    </a>

                </li>
                {{-- <li class="nav-item ">
                    <a href="{{ route('box.history') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Chat History</span>
                    </a>

                </li> --}}

                <li class="nav-item dropdown">
                    <a href="#notification" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-bell fe-16"></i>

                        <span class="ml-3 item-text">Notification</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="notification">
                        <li class="nav-item">
                            <a href="{{ route('notifications.manage') }}" class="nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" {{ route('notifications.list') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a href="#TeamManagment" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-17"></i>
                        <span class="ml-3 item-text">Team Management</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="TeamManagment">
                        <li class="nav-item">
                            <a href="{{ route('team.manage') }} " class="nav-link">
                                <i class="fa fa-hourglass-half fe-17"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('team.list') }} " class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item ">
                    <a href="{{ route('waitlist.list') }}" class=" nav-link">
                        @php
                        $count = \App\Models\Waitlist::count();
                    @endphp
                       <i class="fe fe-clock fe-16"></i>
                        <span class="ml-3 item-text w-50">WaitList <span
                            class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a>

                </li>


                <li class="nav-item ">
                    <a href="{{ route('client.showMessage') }}" class=" nav-link">
                        <i class="fe fe-user fe-16"></i>
                        <span class="ml-3 item-text">Contact Messages <span
                            class="badge badge-white p-1 rounded float-right">0</span></span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href=" {{ route('request.list') }}" class=" nav-link">
                        @php
                            $count = \App\Models\Request::where('status', 'pending')->count();
                        @endphp
                        <i class="fe fe-clipboard fe-16"></i>
                        <span class="ml-3 item-text w-50">Requests <span
                                class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a>

                </li>

                <li class="nav-item dropdown">
                    <a href="#client_review" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-triangle
                        fe-16"></i>
                        <span class="ml-3 item-text">Client Review</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="client_review">
                        <li class="nav-item">
                            <a href="{{ route('client.reviewCreate') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('client.reviewList') }}" class=" nav-link">
                                <i class="fa fa-hourglass-half fe-16"></i>
                                <span class="ml-3 item-text">List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('settings.index') }}" class=" nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">System Settings</span>
                    </a>

                </li>

            </ul>
        @else
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item ">
                    {{-- <a href="{{ route('employee.dashboard') }}" class=" nav-link">
                        <i class='bx bxs-dashboard'></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a> --}}

                    <a href="{{ route('employee.attendance') }}" class=" nav-link">
                        <i class='bx bx-spreadsheet'></i>
                        <span class="ml-3 item-text">Attendance</span>
                    </a>
                    <a href="{{ route('employee.tasklist') }}" class="nav-link">
                        <i class='bx bx-task'></i>
                        <span class="ml-3 item-text">Task List</span>
                    </a>
                    <a href="{{ route('employee.todos.index') }}" class=" nav-link">
                        <i class='bx bx-list-ol'></i>
                        <span class="ml-3 item-text">Todo List</span>
                    </a>
                    <a href="{{ route('employee.request') }}" class="nav-link">
                        <i class='bx bx-git-pull-request' ></i>
                        <span class="ml-3 item-text">Requests</span>
                    </a>
                    <a href="{{ route('employee.performance') }}" class="nav-link">
                        <i class='bx bx-door-open'></i>
                        <span class="ml-3 item-text">Performance</span>
                    </a>

                    <a href="{{ route('employee.notification') }}" class=" nav-link">
                        <i class="fe fe-bell fe-16"></i>
                        @php
                            $startOfWeek = Carbon\Carbon::now()->startOfWeek();
                            $endOfWeek = Carbon\Carbon::now()->endOfWeek();

                            $count = \App\Models\Notification::whereBetween('created_at', [
                                $startOfWeek,
                                $endOfWeek,
                            ])->count();
                        @endphp
                        <span class="ml-3 item-text w-50">Notifications <span
                                class="badge badge-white p-1 rounded float-right">{{ $count }}</span> </span>
                    </a>
                    </a>
                    <a href="{{ route('employee.team') }}" class="nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">Team Members</span>
                    </a>
                </li>

                @if(auth()->user()->role == 'social_manager' || auth()->user()->role == 'finance')
                <li class="nav-item">
                    <a href="{{ route('box.history') }}" class="nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">Chat History</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'seo')
                <li class="nav-item">
                    <a href="{{ route('seo.manage') }}" class="nav-link">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text">SEO Manage</span>
                    </a>
                </li>
                @endif
            </ul>
        @endif
    </nav>
</aside>
