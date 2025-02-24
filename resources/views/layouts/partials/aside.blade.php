<aside class=".verify main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend')}}/dist/img/6132.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="userName d-block">Kazi Omar</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{route('user.dashboard')}}"
            class="nav-link {{request()->routeIs('user.dashboard') ? 'active': ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User Profile
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('user.post.item')}}"
            class="nav-link {{request()->routeIs('user.post.item') ? 'active' : ''}}">
            <i class="nav-icon fas fa-book"></i>
            <p>
              User Post Item
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('user.chat')}}"
            class="nav-link {{request()->routeIs('user.chat') ? 'active' : ''}}">
            <i class="nav-icon fas fa-comments"></i>
            <p>
             chat
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Simple Link
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>