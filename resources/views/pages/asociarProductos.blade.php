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
          <form method="POST" action="{{ route('asociaciones') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Asociar productos a clientes') }}</h4>
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
                    <label class="col-sm-2 col-form-label">{{ __('Cliente') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="cliente_id_itbk" name="cliente_id_itbk" class="form-control seleccion" required>
                              <option> </option>
                              @foreach($clientes as $item)
                                  <option value="{{ $item->cliente_id_itbk }}">{{ $item->nombre }}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  {{-- prueba --}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nro. de Cuenta') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="n_cuenta" name="n_cuenta" class="form-control seleccion" required>
                              <option> </option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Producto') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="id" name="id[]" class="form-control seleccion" multiple required>
                              <option> </option>
                              @foreach($raices as $item)
                                  <option value="{{ $item->id }}">{{ $item->carpeta_raiz }}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Asociar Producto') }}</button>
                </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

@push('js')
<script>

jQuery(document).ready(function () {
    jQuery('select[name="cliente_id_itbk"]').on('change', function (){
        var cliente_id_itbk = jQuery(this).val();
        if (cliente_id_itbk) {
            jQuery.ajax({
                url:'getcuentasJson/'+cliente_id_itbk,
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
  //Select Dinamico
  $(document).ready(function() {
        $('.seleccion').select2();
    });
  </script>
@endpush
@endsection


