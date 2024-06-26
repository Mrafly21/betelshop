<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name">BetelNut</h5>
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search" action="{{ url('search') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" value="" placeholder="Search your product"
                                class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item dropdown">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('cart') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart ({{ $cartCount }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('wishlist') }}">
                                    <i class="fa fa-heart"></i> Wishlist ({{ $wishlistCount }})
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role_as =='0')
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-heart"></i> Edit Profile </a></li>
                                <li><a class="dropdown-item" href="{{ url('become-seller') }}"><i class="fa fa-user-plus"></i> Request become Seller </a></li>
                                @elseif(Auth::user()->role_as =='1')
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-heart"></i> Edit Profile </a></li>
                                <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}"><i class="fa fa-folder"></i> Go to Admin Dashboard </a></li>
                                @elseif(Auth::user()->role_as =='2')
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-heart"></i> Edit Profile </a></li>
                                <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}"><i class="fa fa-folder"></i> Go to Seller Dashboard </a></li>
                                @endif
                                <li>
                                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i> Logout</a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                BetelShop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections') }}">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/newArrivals') }}">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/featured-product') }}">Featured Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/myorder') }}">My Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
