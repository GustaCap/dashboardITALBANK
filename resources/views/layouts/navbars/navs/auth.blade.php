<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">

    {{-- prueba --}}
    {{-- <button type="button" id="sidebarCollapse" class="btn btn-info">
      <i class="fas fa-align-left"></i>
      <span>Toggle Sidebar</span>
  </button> --}}
  {{-- fin de la prueba --}}



    <div class="navbar-wrapper">
      {{-- <a class="navbar-brand" href="#">{{ $titlePage }}</a> --}}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
        {{-- formulario de busqueda --}}
      {{-- <form class="navbar-form">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control" placeholder="Buscar...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form> fin del formulario --}}
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('welcome') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        @php
            $user = Session::get('usuario');
            $str_user = rtrim($user, '-12345678admin');
        @endphp
        <li class="nav-item">
          <a class="nav-link" href="{{ route('welcome') }}">
            <i class="material-icons">account_circle</i>{{ $str_user }}
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>

        {{-- Aqui se comento el items d notificaciones al usuario --}}

        {{-- <li class="nav-item dropdown">
          <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            <span class="notification">5</span>
            <p class="d-lg-none d-md-block">
              {{ __('Some Actions') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">{{ __('Mike John responded to your email') }}</a>
            <a class="dropdown-item" href="#">{{ __('You have 5 new tasks') }}</a>
            <a class="dropdown-item" href="#">{{ __('You\'re now friend with Andrew') }}</a>
            <a class="dropdown-item" href="#">{{ __('Another Notification') }}</a>
            <a class="dropdown-item" href="#">{{ __('Another One') }}</a>
          </div>
        </li> --}}
        <li class="nav-item dropdown">
          {{-- <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">account_circle</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a> --}}
          {{-- Menu del usuarios logueado --}}
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Perfil') }}</a>
            <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
            <div class="dropdown-divider"></div>
            {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a> --}}
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
