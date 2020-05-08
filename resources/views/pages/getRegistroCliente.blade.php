@extends('layouts.app', ['activePage' => 'registroCliente', 'titlePage' => __('Reistro Cliente')])

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
          <form method="POST" action="{{ route('postRegistroCliente') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Registro de Clientes') }}</h4>
                <p class="card-category">{{ __('Información principal del Cliente') }}</p>
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
                  <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" id="nombre" name = "nombre" class="form-control" value="{{ old('nombre') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Apellido') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" id="apellido" name = "apellido" class="form-control" value="{{ old('apellido') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Dni') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" id="dni" name = "dni" class="form-control" value="{{ old('dni') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="email" id="email" name ="email" class="form-control" value="{{ old('email') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Cliente') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <select id="tipocliente_id" name="tipocliente_id" class="form-control" required>
                            <option> </option>
                            @foreach($tipocliente as $item)
                                <option value="{{ $item->id }}">{{ $item->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Id Cliente ItalBank') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="text" id="cliente_id_itbk" name ="cliente_id_itbk" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Número de Cuenta') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="text" id="n_cuenta" name ="n_cuenta" class="form-control">
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
{{-- @push('js')
<script>
    $( function() {
      $( "#datepicker1" ).datepicker();
      $( "#datepicker2" ).datepicker();
    } );
</script>
@endpush --}}
@endsection