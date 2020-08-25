@extends('layouts.app', ['activePage' => 'registroRuta', 'titlePage' => __('Registro de Documentos')])

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
            {{-- {{ $ip }} --}}
          <form method="POST" action="{{ route('postRegistroRuta') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Asociar Documentos a Estructura') }}</h4>
                <p class="card-category">{{ __('') }}</p>
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
                    <label class="col-sm-2 col-form-label">{{ __('Tipo de Cliente') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="tipocliente_id" name="tipocliente_id" class="form-control seleccion" required>
                              <option> </option>
                              @foreach($tipocliente as $item)
                                  <option value="{{ $item->id }}">{{ $item->tipo }}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo de Estructura') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select name="nivel1" id="tipoDocumentos" class="form-control seleccion" required></select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nombre del Documento') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="nombre_doc" name = "nombre_doc" class="form-control">
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nivel 3') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="nivel3" name = "nivel3" class="form-control">
                      </div>
                    </div>
                  </div> --}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo de Requerimiento') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="requerido" name="requerido" class="form-control seleccion" required>
                              <option> </option>
                                  <option value="Obligatorio">Obligatorio</option>
                                  <option value="No Obligatorio">No Obligatorio</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nivel de Relación') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="nivel_relacion" name="nivel_relacion" class="form-control" required>
                              <option> </option>

                                  <option value="cliente">Cliente</option>
                                  <option value="producto">Producto</option>
                                  <option value="transferencia">Transferencia</option>

                          </select>
                      </div>
                    </div>
                  </div> --}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Expiración') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="fec_expiracion" name="fec_expiracion" class="form-control seleccion" required>
                              <option> </option>
                              {{-- @foreach($tipocliente as $item) --}}
                                  <option value="1">Aplica</option>
                                  <option value="0">No Aplica</option>
                              {{-- @endforeach --}}
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Frecuencia') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="frecuencia" name="frecuencia" class="form-control seleccion" required>
                              <option> </option>
                              {{-- @foreach($tipocliente as $item) --}}
                                  <option value="Anual">Anual</option>
                                  <option value="2 años">2 años</option>
                                  <option value="3 años">3 años</option>
                                  <option value="4 años">4 años</option>
                                  <option value="5 años">5 años</option>
                                  <option value="No Aplica">No Aplica</option>
                              {{-- @endforeach --}}
                          </select>
                      </div>
                    </div>
                  </div>


                {{-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre del Documento') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="text" id="nombre_doc" name = "nombre_doc" class="form-control">
                    </div>
                  </div>
                </div> --}}
                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Registrar') }}</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function(){
    function loadtipoDocumentos() {
        var tipocliente_id = $('#tipocliente_id').val();
        if ($.trim(tipocliente_id) != '') {
          /*$.get('nombredelaruta', {variableRequest: variableFormvalue}, funcion)*/
            $.get('getTipoDocumento', {tipocliente_id: tipocliente_id}, function (tipoDocumentos) {

                var old = $('#tipoDocumentos').data('old') != '' ? $('#tipoDocumentos').data('old') : '';

                $('#tipoDocumentos').empty();
                $('#tipoDocumentos').append("<option value=''>Seleccione Documento Base</option>");

                $.each(tipoDocumentos, function (index, value) {
                    $('#tipoDocumentos').append("<option value='" + index + "'" + (old == index ? 'selected' : '') + ">" + value +"</option>");
                })
            });
        }
    }
    loadtipoDocumentos();
    $('#tipocliente_id').on('change', loadtipoDocumentos);
});

//Select Dinamico
$(document).ready(function() {
      $('.seleccion').select2();
  });
</script>

@endpush
@endsection
