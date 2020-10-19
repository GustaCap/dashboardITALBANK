@extends('layouts.app', ['activePage' => 'getCargarTransferencia', 'titlePage' => __('Carga de Documentos Transferencias')])

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
          <form method="POST" action="{{ route('postUploadTransferencia') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="usuario" id="usuario" value="{{$usuario}}" />
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Documentos Transferencia') }}</h4>
                <p class="card-category">{{ __('Sección para carga las transferencias') }}</p>
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
                    <label class="col-sm-2 col-form-label">{{ __('Selecione Cuenta Cliente') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                          <select id="cliente_id_itbk" name="cliente_id_itbk" class="form-control seleccion" required>
                              <option> </option>
                              @foreach($clientes as $item)
                                  <option value="{{ $item->IDCLIENTE }}">{{ $item->NOMBRE }}, <strong>Tipo: </strong>{{ $item->TIPO }}, <strong>Cuenta: </strong>{{ $item->CUENTA }}</option>
                              @endforeach
                       </select>
                      </div>
                      </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label mt-3 ">{{ __('Número de Transferencia') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="transfer" name = "transfer" class="form-control mt-3">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label mt-2">{{ __('Estructura Documental') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <select id="nombredoc" name="nombredoc" class="form-control seleccion" required>
                            <option> </option>
                            @foreach($dataRaices as $item)
                                <option value="{{ $item->nombre_doc }}">{{ $item->nombre_doc }}</option>
                            @endforeach
                     </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Vía Payment') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="viaPayment" name="viaPayment" class="form-control seleccion" required>
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
                          <select id="channel" name="channel" class="form-control seleccion" required>
                              <option> </option>
                                  <option value="FED">FED</option>
                                  <option value="BBN">BBN</option>
                                  <option value="EEX">EEX</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Número de Cuenta del Beneficiario') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="cuenta_bene" name = "cuenta_bene" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nombre del Beneficiario') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="nombre_bene" name = "nombre_bene" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Banco Beneficiario') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="banco_bene" name = "banco_bene" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label mt-4">{{ __('Proposito de la Transferencia') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <textarea class="form-control border mt-4" id="proposito" name="proposito" rows="3"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label mt-2">{{ __('Cargar transferencia') }}</label>
                    <div class="col-sm-7">
                        <input class="mt-3" id="file" name="file" type="file">
                    </div>
                  </div>

                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Registrar') }}</button>
                </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.seleccion').select2();
});
</script>
@endpush
@endsection
