<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a style="height:75px !important;" class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
            <div class="sidebar-brand-icon">
              <img style="height: 45px;" src="{{asset('assets/img/desasidebar.png')}}">
            </div>
            <div style="font-size: 20px" class="sidebar-brand-text mx-3">SIG Desa</div>
          </a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <div class="sidebar-brand d-flex align-items-center justify-content" href="/admin">
      <div class="sidebar-brand-icon">
        <img style="height:50px;width:50px;" src="{{asset('assets/img/profile.svg')}}">
      </div>
      <div style="font-size: 10px !important;margin-left:10px;" class="sidebar-brand-text my-3">
        {{auth()->guard()->user()->nama}}
      </div>
    </div>
    <!-- Divider -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Potensi Desa
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item" id="desa">
        <a class="nav-link" href="{{ route('admin-desa-home') }}">
            <i class="fas fa-city"></i>
            <span>Desa</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBerita" aria-expanded="true" aria-controls="collapseBerita">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Potensi Desa</span>
      </a>
      <div id="collapseBerita" class="collapse" aria-labelledby="headingKI" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Daftar Potensi:</h6>
          <a class="collapse-item" href="{{ route('admin-sekolah-home') }}" ><i class="fas fa-fw fa-school"></i>   Sekolah</a>
          <a class="collapse-item" href="{{ route('admin-ibadah-home') }}"><i class="fas fa-fw fa-place-of-worship"></i>  Tempat Ibadah</a>
          <a class="collapse-item" href="{{ route('admin-wisata-home') }}"><i class="fas fa-fw fa-umbrella-beach"></i>  Tempat Wisata</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tentang SIG Desa
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item" id="desa">
        <a class="nav-link" href="{{ route('admin-desa-home') }}">
            <i class="fas fa-users-cog"></i>
            <span>Admin</span></a>
    </li>
    <li class="nav-item" id="desa">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#aboutModal">
          <i class="fas fa-info-circle"></i>
          <span>Tentang</span></a>
  </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->