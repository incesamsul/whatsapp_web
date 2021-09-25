@include('admin.admin_layout.admin_template.header')
@include('admin.admin_layout.admin_template.navbar')
@include('admin.admin_layout.admin_template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page_title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@yield('header-title')</a></li>
              <li class="breadcrumb-item active">@yield('header-sub-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin.admin_layout.admin_template.footer')
