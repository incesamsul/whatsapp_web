  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-main">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE-3.1.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Kasir</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3.1.0/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar " type="search" placeholder="Search" aria-label="Search">
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

        {{-- @foreach ($menu as $m)
        <li class="nav-item">
          <a href="{{ $m['url'] }}" class="nav-link">
            <i class="nav-icon {{ $m['icon'] }}"></i>
            <p>
              {{ $m['title'] }}
            </p>
          </a>
        </li>
        @endforeach
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li> --}}

        @foreach ($menu as $m)
        @if ($m['access_role'] >= auth()->user()->role_id)
        <li class="nav-item ">
            <a href="{{ URL::to('/admin/'. $m['url'] ) }}" class="nav-link {{ strtolower($m['url']) == request()->segment(2) ? 'active' : '' }}">
              <i class="nav-icon fas {{ $m['icon'] }}"></i>
              <p>
                {{ $m['title'] }}
                @if ($m['is_sub_menu_exist']  == 1)
                <i class="right fas fa-angle-left"></i>
                @endif
              </p>
            </a>
            @if ($m['is_sub_menu_exist'] == 1)
            <?php
                $admin_sub_menu = DB::table('admin_sub_menu')->where('id_menu',$m['id'])->get();
            ?>
            @foreach ($admin_sub_menu as $asm)
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ URL::to('/admin/'. $asm->url ) }}" class="nav-link {{ strtolower($asm->url) == request()->segment(2) ? 'active' : '' }}">
                    <i class="{{ $asm->icon }} nav-icon"></i>
                    <p>{{ $asm->title }}</p>
                  </a>
                </li>
              </ul>
            @endforeach
            @endif
          </li>
        @endif
        @endforeach


        <li class="nav-item">
          <a href="{{ URL::to('/logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
