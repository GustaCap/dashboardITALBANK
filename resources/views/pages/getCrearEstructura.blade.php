@extends('layouts.app', ['activePage' => 'getCrearEstructura', 'titlePage' => __('Crear Estructura Documental')])

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
          <form method="POST" action="{{ route('postCreaEstructura') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Creación de Estructura Documental') }}</h4>
                <p class="card-category">{{ __('Sección para crear la base de una Estructura Documental') }}</p>
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
                    <label class="col-sm-2 col-form-label">{{ __('Nombre de la Estructura') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="carpeta_raiz" name = "carpeta_raiz" class="form-control">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nivel de Relación') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <select id="nivel_relacion" name="nivel_relacion" class="form-control seleccion" required>
                              <option> </option>
                              {{-- @foreach($tipocliente as $item) --}}
                                  <option value="cliente">Cliente</option>
                                  <option value="producto">Producto</option>
                                  <option value="transferencia">Transferencia</option>
                              {{-- @endforeach --}}
                          </select>
                      </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
//Select Dinamico
$(document).ready(function() {
    $('.seleccion').select2();
});
</script>
@endpush
@endsection
