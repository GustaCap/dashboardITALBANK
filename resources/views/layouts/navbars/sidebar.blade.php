<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://italbank.com/" class="simple-text logo-normal">
      {{ __('ITALBANK') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      {{-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Consultar Documento') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> NC </span>
                <span class="sidebar-normal">{{ __('Nro. de Cuenta') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> FR </span>
                <span class="sidebar-normal"> {{ __('Fecha de Registro') }} </span>
              </a>
            </li>
            <!--Agregado por gustavo -->
            <li class="nav-item{{ $activePage == 'prueba' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                  <span class="sidebar-mini"> IDC </span>
                  <span class="sidebar-normal"> {{ __('ID de Cliente') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li> --}}
      <li class="nav-item{{ $activePage == 'searchDocID' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchDocID') }}">
          <i class="material-icons">assignment_ind</i>
            <p>{{ __('Consultar ID Documento') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'searchFechaRegistro' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchFechaRegistro') }}">
          <i class="material-icons">assignment_ind</i>
            <p>{{ __('Consultar Recha Registro ') }}</p>
        </a>
      </li>
      {{-- <li class="nav-item{{ $activePage == 'dni' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dni') }}">
          <i class="material-icons">assignment_ind</i>
            <p>{{ __('Documentos') }}</p>
        </a>
      </li> --}}

      {{-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">payment</i>
            <p>{{ __('Nro. De Cuenta') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">event</i>
            <p>{{ __('Fecha de Registro') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">assignmentte</i>
            <p>{{ __('Perfil Clientes') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Documentos') }}</p>
        </a>
      </li> --}}
      {{-- <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>
      <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('upgrade') }}">
          <i class="material-icons">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> --}}
    </ul>
  </div>
</div>
