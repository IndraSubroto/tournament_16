@section('sidebar')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ url('/') }}/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tournament 16</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-white">
          {{ Auth::user()->name }}
        </div>
      </div>
      @endauth

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU</li>
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          @auth
          <li class="nav-item has-treeview">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          @endauth
          <li class="nav-item has-treeview">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon fas fa-medal"></i>
              <p>Tournaments</p>
            </a>
          </li>
          @auth
          @cannot('isPromotor', Model::class)
          <li class="nav-item has-treeview">
            <a href="{{ url('/listTeams') }}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>My Register</p>
            </a>
          </li>
          @endcannot
          @cannot('isMember', Model::class)
          {{-- @cannot('isAdmin') --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('/tournament') }}" class="nav-link">
              <i class="nav-icon fas fa-trophy"></i>
              <p>Create Tournament</p>
            </a>
          </li>
          {{-- @endcannot --}}
          <li class="nav-item has-treeview">
            <a href="{{ url('/listTournaments') }}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>My Tournaments</p>
            </a>
          </li>
          @endcannot
          <li class="nav-item has-treeview">
            <a href="{{ url('/complain') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Complain Box</p>
            </a>
          </li>
          @endauth
          <li class="nav-header">USER</li>
          <li class="nav-item has-treeview">
            <a class="nav-link" href="#">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>User Menu <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav-item nav-treeview pl-3">
              @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="nav-icon fas fa-sign-in-alt"></i>
                    <p> Login</p>
                </a>
              </li>
              @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <i class="nav-icon fas fa-registered"></i>
                    <p> Register</p>
                </a>
              </li>
              @endif
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{ url('profile') }}">
                  <div class="image img-size-32">
                    <img src="{{ url('/') }}/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2 img-size-32" alt="User Image">
                    <p> Profile</p>
                  </div>
                </a>
              </li>
              @can('isMember')
              <li class="nav-item">
                <a class="nav-link" href="{{ url('upgrade') }}">
                    <i class="nav-icon fas fa-registered"></i>
                    <p>Upgrade Membership</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i> 
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
              @endguest
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@endsection