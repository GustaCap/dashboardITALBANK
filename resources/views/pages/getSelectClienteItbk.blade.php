@extends('layouts.app', ['activePage' => 'getSelecionarCliente', 'titlePage' => __('Seleccionar Cliente Italbank')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Cliente Italbank') }}</h4>
                <p class="card-category">{{ __('Seleccion de Cliente Italbank') }}</p>
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
                            @foreach($data as $item)
                                {{-- <option value="{{ $item->n_cuenta }}">{{ $item->nombre }} - {{ $item->n_cuenta }}</option> --}}
                                 <option value="{{ $item->cliente_id_itbk }}">{{ $item->nombre }}</option>
                            @endforeach
                     </select>
                    </div>
                  </div>
                </div>
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
