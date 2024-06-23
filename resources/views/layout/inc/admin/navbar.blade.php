<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}">
                BetelNut
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
            <li class="nav-item nav-search d-none d-lg-block w-100">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="search">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="asd">
                    <i class="fa fa-bell"></i>
                    @if(Auth::user()->notifications()->where('status', 'unread')->count() > 0)
                        <span class="badge bg-danger">{{ Auth::user()->notifications()->where('status', 'unread')->count() }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notifDropdown">
                    @php
                        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
                    @endphp
                    @if($notifications->isEmpty())
                        <li><a class="dropdown-item" href="#">No notifications</a></li>
                    @else
                        @foreach($notifications as $notification)
                            <li>
                                <a class="dropdown-item {{ $notification->status == 'unread' ? 'bg-primary text-white' : '' }}" href="{{ url('notifications/' . $notification->id) }}">
                                    {{ $notification->message }}
                                </a>
                            </li>
                        @endforeach
                        <li><a class="dropdown-item bg-warning" href="{{ url('notifications') }}">View more</a></li>
                    @endif
                </ul>                
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="asd">
                    {{-- <img src="images/faces/face3.jpg" alt="profile" /> --}}
                    <span class="nav-profile-name-user">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>