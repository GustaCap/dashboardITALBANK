@extends('layouts.app', ['activePage' => 'getClienteCE', 'titlePage' => __('User Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form method="POST" action="{{ route('postClienteFiles') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Documentos') }}</h4>
                <p class="card-category">{{ __('Informacion del Cliente') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Número de Cuenta') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group">
                        <input type="text" id="numCuenta" name = "numCuenta" class="form-control" placeholder="Eje: 0001111222333" >
                    </div>
                  </div>
                </div>

                {{-- Lista de tipo de cliente --}}
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo de Cliente') }}</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                          <select id="tipocliente" name="tipocliente" class="form-control">
                              <option> </option>
                              <option value="Cliente Empresa(CE)">Cliente Empresa(CE)</option>
                       </select>

                      </div>
                    </div>
                  </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Ruta de Documentos') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="carpetas" name="carpetas" class="form-control" required>
                              <option> </option>
                              @foreach($dataRaices as $item)
                                  <option value="{{ $item->carpeta_raiz }}">{{ $item->carpeta_raiz }}</option>
                              @endforeach
                       </select>
  
                      </div>
                    </div>
                  </div>
                {{-- FECHA DE EMISION --}}
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Emisión') }}</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="text" id="datepicker1" name = "fecEmitido" class="form-control" >
                      </div>
                    </div>
                  </div>
                  {{-- FECHA DE EXPIRA --}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Expiración') }}</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="text" id="datepicker2" name = "fecExpira" class="form-control" placeholder="Si aplica para la ruta selecionada">
                      </div>
                    </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label mt-3">{{ __('Cargar documento') }}</label>
                    <div class="col-sm-7 mt-4">

                        <input id="file-input" name="file" type="file" />

                    </div>
                  </div>
              </div>
              <div class="card-footer ml-auto mr-auto">

                <button type="submit" class="btn btn-primary mb-4">{{ __('Cargar Documentos') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  @push('js')
  <script type="text/javascript">
      $( function() {
        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();
      } );

      function ShowHideDiv() {
            var tipocliente = document.getElementById("tipocliente");
            var carpetas_c1 = document.getElementById("carpetas_c1");
            var carpetas_c2 = document.getElementById("carpetas_c2");
            var carpetas_c3 = document.getElementById("carpetas_c3");
            var carpetas_c4 = document.getElementById("carpetas_c4");
            if (tipocliente.value == "1") {
                carpetas_c1.style.display = "block";
            } else if (tipocliente.value == "2") {
                carpetas_c2.style.display = "block";
            } else if (tipocliente.value == "3") {
                carpetas_c3.style.display = "block";
            } else {
                carpetas_c4.style.display = "block";
            }
            // carpetas.style.display = tipocliente.value == "2" ? "block" : "none";
            // carpetas_c1.style.display = tipocliente.value == "1" ? "block" : "none";
            // carpetas_c2.style.display = tipocliente.value == "2" ? "block" : "none";
            // carpetas_c3.style.display = tipocliente.value == "3" ? "block" : "none";
            // carpetas_c4.style.display = tipocliente.value == "4" ? "block" : "none";
        }

  </script>
  @endpush
  {{-- @push('js')
  <script type="text/javascript">
      function ShowHideDiv() {
            var tipocliente = document.getElementById("tipocliente");
            var carpetas = document.getElementById("carpetas");
            carpetas.style.display = tipocliente.value == "2" ? "block" : "none";
        }
  </script>
  @endpush --}}
@endsection
