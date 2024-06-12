<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/order') }}">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category') }}">View Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">Add Category</a></li>
          </ul>
        </div>
      </li>
      @if(Auth::user()->role_as =='1')
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/create') }}"> Add User </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}">  View User </a></li>
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
          <i class="mdi mdi-database-plus menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">View Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create') }}">Add Product</a></li>
          </ul>
        </div>
      </li>
      @if(Auth::user()->role_as =='1')
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/message') }}">
          <i class="fa fa-key"></i>
          <span class="menu-title ms-3">Message</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/seller-reports') }}">
          <i class="fa fa-bell"> </i>
          <span class="menu-title ms-3">Seller Report</span>
        </a>
      </li>
    </ul>
  </nav>

  