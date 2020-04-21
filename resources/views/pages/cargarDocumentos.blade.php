@extends('layouts.app', ['activePage' => 'cargarDocumentos', 'titlePage' => __('User Profile')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('cargarDocumentos') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Docuemntos') }}</h4>
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
                        <select id="cliente_id" name="cliente_id" class="form-control" required>
                            <option> </option>
                            @foreach($dataCliente as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}, {{ $item->apellido }}</option>
                            @endforeach
                     </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Documento') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <select id="cliente_id" name="cliente_id" class="form-control" aria-placeholder="dfsdff" required>
                            <option> </option>
                            @foreach($dataRaices as $item)
                                <option value="{{ $item->carpetaRaiz }}">{{ $item->carpetaRaiz }}, Tipo Cliente: {{ $item->tipocliente_id }} </option>
                            @endforeach
                     </select>
                     <label class="col-sm-4 col-form-label">Individuos(IND)     = 1</label>
                     <label class="col-sm-4 col-form-label">Cliente Empresa(CE) = 2</label>
                     <label class="col-sm-4 col-form-label">Cliente Bancos (CB) = 3</label>
                     <label class="col-sm-4 col-form-label">Cliente MSB (CM)    = 4</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Cargar documento') }}</label>
                    <div class="col-sm-7 mt-2">

                        <input id="file-input" name="files" type="file"/>

                    </div>
                  </div>
              </div>
              <div class="card-footer ml-auto mr-auto">

                <button type="submit" class="btn btn-primary">{{ __('Cargar Documentos') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      {{-- <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Change password') }}</h4>
                <p class="card-category">{{ __('Password') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div> --}}
    </div>
  </div>
@endsection
