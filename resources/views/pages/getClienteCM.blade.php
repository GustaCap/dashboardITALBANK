@extends('layouts.app', ['activePage' => 'getClienteCM', 'titlePage' => __('User Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
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
                  <label class="col-sm-2 col-form-label">{{ __('Nombre del Cliente') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="text" id="numCuenta" name = "numCuenta" class="form-control" placeholder="Eje: 0001111222333" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo de Cliente') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <select id="tipocliente" name="tipocliente" class="form-control">
                            <option> </option>
                            <option value="Cliente MSB (CM)">Cliente MSB (CM)</option>
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
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="text" id="datepicker1" name = "fecEmitido" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  {{-- FECHA DE EXPIRA --}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Expiración') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="text" id="datepicker2" name = "fecExpira" class="form-control" placeholder="Si aplica para la ruta selecionada">
                      </div>
                    </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label mt-3">{{ __('Cargar documento') }}</label>
                    <div class="col-sm-7 mt-4">

                        <input id="file-input" name="file" type="file" required/>

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
  <script>
      $( function() {
        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();
      } );
  </script>
  @endpush
@endsection
