<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>N</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Pagar</b>Nusa</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('dist/img/user2-160x160.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - Administrator
                  <small>Pengguna sejak {{ Auth::user()->created_at }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                    <a href="{{ route('logout') }}"
                        class="btn btn-default btn-flat"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Keluar
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>