<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
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

        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Calendar
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('assign-list')}}" class="nav-link {{ Route::is('assign-list') ? 'active' : '' }}">
            <i class="nav-icon far fa-image"></i>
            <p>
              All Calories
            </p>
          </a>
        </li>
        <li class="nav-item {{ Route::is('group-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('group-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Groups
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('group-list')}}" class="nav-link {{ Route::is('group-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('group-create')}}" class="nav-link {{ Route::is('group-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Route::is('subgroup-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('subgroup-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Sub Groups
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('subgroup-list')}}" class="nav-link {{ Route::is('subgroup-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('subgroup-create')}}" class="nav-link {{ Route::is('subgroup-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Route::is('macro-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('macro-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Macros
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('macro-list')}}" class="nav-link {{ Route::is('macro-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('macro-create')}}" class="nav-link {{ Route::is('macro-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item d-none {{ Route::is('sub-macro-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('sub-macro-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Sub-Macros
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('sub-macro-list')}}" class="nav-link {{ Route::is('sub-macro-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sub-macro-create')}}" class="nav-link {{ Route::is('sub-macro-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item {{ Route::is('serving-size-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('serving-size-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Serving Size
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('serving-size-list')}}" class="nav-link {{ Route::is('serving-size-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('serving-size-create')}}" class="nav-link {{ Route::is('serving-size-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item d-none {{ Route::is('count-as-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('count-as-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Count as
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('count-as-list')}}" class="nav-link {{ Route::is('count-as-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('count-as-create')}}" class="nav-link {{ Route::is('count-as-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item {{ Route::is('calories-*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('calories-*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Calories
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('calories-list')}}" class="nav-link {{ Route::is('calories-list') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('calories-create')}}" class="nav-link {{ Route::is('calories-create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>