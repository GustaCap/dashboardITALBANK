@extends('layouts.app', ['activePage' => 'getdocumentos', 'titlePage' => __('Carga de Documentos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Documentos Italbank') }}</h4>

              </div>
              <div class="card-body ">
                <form method="post" action="{{ route('postClienteItbk') }}">
                    @csrf
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cliente') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <select id="cliente_id_itbk" name="cliente_id_itbk" class="form-control seleccion" required>
                            <option> </option>
                            @foreach($clientes as $item)

                                 {{-- <option value="{{ $item->cliente_id_itbk }}">{{ $item->nombre }} - {{ $item->cliente_id_itbk }}</option> --}}
                                 <option value="{{ $item->IDCLIENTE }}">{{ $item->NOMBRE }} - {{ $item->IDCLIENTE }}</option>
                            @endforeach
                     </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Cuentas Asociadas') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="n_cuenta" name="n_cuenta" class="form-control seleccion" required>
                            <option> </option>
                       </select>
                      </div>
                    </div>
                  </div>
                {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Productos Asociados') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="carpeta_raiz" name="carpeta_raiz" class="form-control seleccion" required>
                              <option> </option>

                       </select>
                      </div>
                    </div>
                  </div> --}}
                {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nivel de Relación') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="nivel_relacion" name="nivel_relacion" class="form-control seleccion" required>
                              <option> </option>
                              <option value="cliente" >Cliente</option>
                              <option value="producto" >Producto</option>
                       </select>
                      </div>
                    </div>
                  </div> --}}
                 <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}" />

                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('enviar') }}</button>
                    {{-- <a class="btn btn-primary" href="{{ route('uploadDocClientes',array($item->cliente_id_itbk, $usuario) ) }}">Cargar Documentos</a> --}}
                </div>

            </div>
        </form>

        </div>
      </div>

    </div>
  </div>

  @push('js')
  {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script> --}}
  {{-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
  <script>

  jQuery(document).ready(function () {
    jQuery('select[name="cliente_id_itbk"]').on('change', function (){
        var cliente_id_itbk = jQuery(this).val();
        if (cliente_id_itbk) {
            jQuery.ajax({
                url:'getdocumentosJson/'+cliente_id_itbk,
                type:"GET",
                dataType:"JSON",
                success:function(data){
                    // alert(data);
                    jQuery('select[name="n_cuenta"]').empty();
                    jQuery.each(data, function(key,value){
                        $('select[name="n_cuenta"]').append('<option value="'+key+'">'+value+'</option>');
                    });
                }
            });

        }
        else{
            $('select[name="n_cuenta"]').empty();
        }
    });
});

// Select dinamico con buscardor, usando la libreria Select2
$(document).ready(function() {
    $('.seleccion').select2();
});
// Fin Select2


  </script>
  @endpush

@endsection
