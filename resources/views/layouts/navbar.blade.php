@section('navbar')
<nav class="main-header navbar navbar-expand-md navbar-white navbar-light">

  <div class="container">
    
    <a href="{{ url('/') }}" class="navbar-brand">
      <img src="{{ url('/') }}/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tournament 16</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('/') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
        </li>
        @auth
        <li class="nav-item dropdown">
          @cannot('isMember')<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>@endcannot<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Tournament</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @cannot('isMember')
            <li><a href="{{ url('/tournament') }}" class="dropdown-item badge-success">Create Tournament <span class="text-sm text-white"><i class="fas fa-plus"></i></span></a></li>
            <li><a href="{{ url('/listTournaments') }}" class="dropdown-item">My Tournament</a></li>
            @endcannot
            @cannot('isPromotor', Model::class)
            <li><a href="{{ url('/listTeams') }}" class="dropdown-item">My Register</a></li>
            @endcannot
          </ul>
        </li>    
        @endauth
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <li class="nav-item dropdown">
        @guest
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        
          @if (Route::has('register'))
          <a class="nav-link" href="{{ route('register') }}">
            <i class="fas fa-registered"></i>
          </a>
      </li>
          @endif
          @else
          <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-alt"></i> 
          @can('isMember')
          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
          @endcan
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-header">
            <img src="{{ url('/') }}/admin/dist/img/user2-160x160.jpg" class="img-size-50 mr-3 img-circle" alt="User Image">
            <h3 class="dropdown-item-title">
              {{ Auth::user()->name }}
            </h3>
          </div>
          <div class="dropdown-divider"></div>
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                
                
                <a class="dropdown-item" href="{{ url('profile') }}">
                  <i class="fas fa-user-cog"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                @can('isMember')
                <a class="dropdown-item" href="{{ url('upgrade') }}">
                  <i class="fas fa-warning fa-user-edit"></i>
                    Upgrade Membership
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </a>
                <div class="dropdown-divider"></div>
                @endcan
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> 
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
            <!-- Message End -->
            <div class="dropdown-divider"></div>
            <p class="dropdown-footer">Tournament 16</p>
          </div>
          @endguest
      </li>
      
    </ul>
  </div>
</nav>
@endsection