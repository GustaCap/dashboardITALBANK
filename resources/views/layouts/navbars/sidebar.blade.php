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
      <li class="nav-item{{ $activePage == 'registroCliente' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getRegistroCliente') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Registrar Cliente') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'listarCliente' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getlistarCliente') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Consultar Cliente') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'registroRuta' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getRegistroRuta') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Registrar Ruta') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'listarRuta' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getlistarRuta') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Consultar Ruta') }}</p>
        </a>
      </li>
      {{-- <li class="nav-item{{ $activePage == 'cargaDeDocumentos' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cargaDeDocumentos') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Cargar Documentos') }}</p>
        </a>
      </li> --}}
      {{-- <li class="nav-item{{ $activePage == 'searchDocID' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchDocID') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Consultar Clientes') }}</p>
        </a>
      </li> --}}
      {{-- <li class="nav-item{{ $activePage == 'searchFechaRegistro' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchFechaRegistro') }}">
          <i class="material-icons">date_range</i>
            <p>{{ __('Consultar Recha Registro ') }}</p>
        </a>
      </li> --}}
      <li class="nav-item {{ ($activePage == 'getClienteIND' || $activePage == 'getClienteCE' || $activePage == 'getClienteCB' || $activePage == 'getClienteCM') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#cargarDocumentos" >
            <i class="material-icons">cloud_upload</i>
          <p>{{ __('Cargar Documentos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="cargarDocumentos">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'getClienteIND' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('getClienteIND') }}">
                <span class="sidebar-normal">Individuos(IND)</span>
                {{-- <span class="sidebar-normal"></span> --}}
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'getClienteCE' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('getClienteCE') }}">
                <span class="sidebar-normal">Empresa(CE)</span>
                {{-- <span class="sidebar-normal"> {{ __('User Management') }} </span> --}}
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'getClienteCB' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('getClienteCB') }}">
                  <span class="sidebar-normal">Bancos(CB)</span>
                  {{-- <span class="sidebar-normal"> {{ __('User Management') }} </span> --}}
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'getClienteCM' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('getClienteCM') }}">
                  <span class="sidebar-normal">MSB(CM)</span>
                  {{-- <span class="sidebar-normal"> {{ __('User Management') }} </span> --}}
                </a>
              </li>
              
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'searchDocID' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchDocID') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Consultar Documentos') }}</p>
        </a>
      </li>

      


    </ul>
  </div>
</div>
