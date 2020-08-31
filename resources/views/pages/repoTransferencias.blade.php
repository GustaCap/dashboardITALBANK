@extends('layouts.app', ['activePage' => 'repoTransferencias', 'titlePage' => __('Reporte transferencias Cargados')])

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
          <form method="POST" action="{{ route('postrepopertrans') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="usuario" value="{{ $usuario }}">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Reporte') }}</h4>
                <p class="card-category">{{ __('Transferencias cargadas de un cliente en un rango de Fechas') }}</p>
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
                @if (session('warning'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('warning') }}</span>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Cliente') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="cliente_id_itbk" name="cliente_id_itbk" class="form-control seleccion" required>
                              <option> </option>
                              @foreach($data as $item)
                                  <option value="{{ $item->cliente_id_itbk }}">{{ $item->nombre }} - {{ $item->cliente_id_itbk }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Vía Payment') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="viaPayment" name="viaPayment" class="form-control" required>
                              <option> </option>
                                  <option value="FED">FED</option>
                                  <option value="SWIFT">SWIFT</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Channel') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="channel" name="channel" class="form-control" required>
                              <option> </option>
                                  <option value="FED">FED</option>
                                  <option value="BBN">BBN</option>
                                  <option value="EEX">EEX</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha Inico') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="date" name = "fechaini" id="datepicker1" class="form-conrol">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha Fin') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="date" name = "fechafin" id="fechafin" class="form-conrol">
                      </div>
                    </div>
                  </div>
                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Generar Reporte PDF') }}</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- @push('js')
<script>
    $( function() {
      $( "#datepicker1" ).datepicker();
      $( "#datepicker2" ).datepicker();
    } );
</script>
@endpush --}}
@push('js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
  // Select dinamico con buscardor, usando la libreria Select2
  $(document).ready(function() {
      $('.seleccion').select2();
  });
  // Fin Select2
  </script>
  @endpush
@endsection
