<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
          <input type="text" name="q" class="form-control" placeholder="Administrator" disabled>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li id="menu-dashboard">
          <a href="{{ url('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li id="menu-lokasi">
          <a href="{{ url('location') }}">
            <i class="fa fa-map-pin"></i> <span>Daftar Lokasi</span>
          </a>
        </li>
        <li id="menu-grup">
          <a href="{{ url('group') }}">
            <i class="fa fa-users"></i> <span>Group</span>
          </a>
        </li>
        <li id="menu-confirm">
          <a href="{{ url('confirm') }}">
            <i class="fa fa-check-circle"></i> <span>Konfirmasi Santri Baru 
            @if(session('confirm') > 0)
            <span class="pull-right-container">
              <span class="label label-primary pull-right">{{ session('confirm') }}
              </span>
            </span>
            @endif
            </span>
          </a>
        </li>
        <li id="menu-santri">
          <a href="{{ url('santri') }}">
            <i class="fa fa-address-book-o"></i> <span>Daftar Santri</span>
          </a>
        </li>
        <li id="menu-pelatih">
          <a href="{{ url('pelatih') }}">
            <i class="fa fa-address-book-o"></i> <span>Daftar Pelatih</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>