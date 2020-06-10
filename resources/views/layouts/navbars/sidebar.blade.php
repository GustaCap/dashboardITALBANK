<div id="sidebar" class="sidebar wrapperprueba" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <strong><a href="{{ route('welcome') }}" class=" text-white simple-text logo-normal badge-primary ">
      {{ __('Italdocumentos v1.0') }}
    </a></strong>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      {{-- <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('welcome') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Italdocumentos v1.0') }}</p>
        </a>
      </li> --}}
      {{-- </li> --}}
      @php
          $user = Session::get('usuario');
          $value_op1 = Str::contains($user, '1');
          $value_op2 = Str::contains($user, '2');
          $value_op3 = Str::contains($user, '3');
          $value_op4 = Str::contains($user, '4');
          $value_op5 = Str::contains($user, '5');
          $value_op6 = Str::contains($user, '6');
          $value_op7 = Str::contains($user, '7');
          $value_op8 = Str::contains($user, '8');
          $value_op9 = Str::contains($user, 'admin');
      @endphp
      @if ($value_op1 == TRUE || $value_op9 == TRUE )
      <li class="nav-item{{ $activePage == 'listarCliente' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getlistarCliente') }}">
          <i class="material-icons">how_to_reg</i>
            <p>{{ __('Consultar Cliente') }}</p>
            {{-- {{ $user }} {{ $value }} --}}
            {{-- {{ $user }} --}}
        </a>
      </li>
      @endif
      @if ($value_op2 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'registroRuta' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getRegistroRuta') }}">
          <i class="material-icons">description</i>
            <p>{{ __('Registrar Tipo Documento') }}</p>
        </a>
      </li>
      @endif
      @if ($value_op3 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'listarRuta' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getlistarRuta') }}">
          <i class="material-icons">library_add_check</i>
            <p>{{ __('Consultar Tipo Documento') }}</p>
        </a>
      </li>
      @endif
      @if ($value_op4 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'getClienteIND' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getClienteIND') }}">
          <i class="material-icons">cloud_upload</i>
            <p>{{ __('Cargar Documentos (IND)') }}</p>
        </a>
      </li>
      @endif
      @if ($value_op5 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'getClienteCE' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getClienteCE') }}">
          <i class="material-icons">cloud_upload</i>
            <p>{{ __('Cargar Documentos (CE)') }}</p>
        </a>
      </li>
      @endif
      @if ($value_op6 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'getClienteCB' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getClienteCB') }}">
          <i class="material-icons">cloud_upload</i>
            <p>{{ __('Cargar Documentos (CB)') }}</p>
        </a>
      </li>
      @endif
      @if ($value_op7 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'getClienteCM' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('getClienteCM') }}">
          <i class="material-icons">cloud_upload</i>
            <p>{{ __('Cargar Documentos (CM)') }}</p>
        </a>
      </li> 
      @endif
      @if ($value_op8 == TRUE || $value_op9 == TRUE)
      <li class="nav-item{{ $activePage == 'audilog' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('audilog') }}">
          <i class="material-icons">visibility</i>
            <p>{{ __('AudiLog') }}</p>
        </a>
      </li>
      @endif
      
      
      
      {{-- <li class="nav-item {{ ($activePage == 'getClienteIND' || $activePage == 'getClienteCE' || $activePage == 'getClienteCB' || $activePage == 'getClienteCM') ? ' active' : '' }}">
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
                <i class="material-icons iconNote_add">note_add</i>
                  <p>{{ __('Individuos(IND)') }}</p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'getClienteCE' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('getClienteCE') }}">
                <i class="material-icons iconNote_add">note_add</i>
                  <p>{{ __('Empresa(CE)') }}</p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'getClienteCB' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('getClienteCB') }}">
                  <i class="material-icons iconNote_add">note_add</i>
                  <p>{{ __('Bancos(CB)') }}</p>
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'getClienteCM' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('getClienteCM') }}">
                  <i class="material-icons iconNote_add">note_add</i>
                  <p>{{ __('MSB(CM)') }}</p>
                </a>
              </li>
              
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item{{ $activePage == 'searchDocID' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('searchDocID') }}">
          <i class="material-icons">assignment_turned_in</i>
            <p>{{ __('Consultar Documentos') }}</p>
        </a>
      </li> --}}
    </ul>
  </div>
</div>

