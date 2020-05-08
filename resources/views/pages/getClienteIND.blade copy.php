@extends('layouts.app', ['activePage' => 'getClienteIND', 'titlePage' => __('User Profile')])

@section('content')
<div class="row justify-content-center">
    
  <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card cell4-->
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">view_carousel</i><!--icono-->
        </div>
        <p class="card-category">ItalDocumentos</p>
        <h3 class="card-title">2
          <small>Registros</small>
        </h3>
      </div>
      <div class="card-footer">
          <div class="stats">
            <a class="href-style" href="{{ route('dashboarditalDoc') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
            {{-- <i class="material-icons">assignment_turned_in</i> Infomacion Detallada --}}

          </div>
      </div>
    </div>
  </div><!--fin card cell4-->
  <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card SharedField-->
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">view_carousel</i><!--icono-->
        </div>
        <p class="card-category">SharedFile</p>
        <h3 class="card-title">236
          <small>Registros</small>
        </h3>

      </div>
      <div class="card-footer">
        <div class="stats">
          <a class="href-style" href="{{ route('getClienteIND') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
          {{-- <i class="material-icons">assignment_turned_in</i>Total Clientes --}}
        </div>
      </div>
    </div>
  </div><!--fin card SharedField-->
  <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card SharedField-->
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">view_carousel</i>
        </div>
        <p class="card-category">Onboarding</p>
        <h3 class="card-title">236
          <small>Registros</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">assignment_turned_in</i>Total Clientes
        </div>
      </div>
    </div>
  </div><!--fin card SharedField-->
  <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card ibs-->
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="material-icons">view_carousel</i>
        </div>
        <p class="card-category">IBS</p>
        <h3 class="card-title">236
          <small>Registros</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">assignment_turned_in</i> Total Clientes
        </div>
      </div>
    </div>
  </div><!--fin card ibs-->
  
</div>



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
                  <label class="col-sm-2 col-form-label">{{ __('No. de Cuenta Cliente') }}</label>
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
                            <option value="Individuos(IND)">Individuos(IND)</option>
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
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Experación') }}</label>
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
