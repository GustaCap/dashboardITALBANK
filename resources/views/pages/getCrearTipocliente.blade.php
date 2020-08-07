@extends('layouts.app', ['activePage' => 'getCrearTipocliente', 'titlePage' => __('Crear Tipos de Cliente')])

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
          <form method="POST" action="{{ route('postCrearTipocliente') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Crear Tipo de Cliente') }}</h4>
                <p class="card-category">{{ __('Sección para crear un nuevo tipo de Cliente') }}</p>
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
                  <label class="col-sm-2 col-form-label">{{ __('Nombre Tipo de Cliente') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                        <input type="text" id="tipo" name = "tipo" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Registrar') }}</button>
                </div>
            </div>
          </form>
        </div>

        <div class="col-md-4"><!--Inicio table cell4-->
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Clientes Registrados</h4>
                <p class="card-category">Lista de cliente registrados</p>
              </div>
              <div class="card-body table-responsive">
                <table id="tablelistarclientes" class="table display cell-border" style="width:100%">
                    <thead class="text-danger">
                    <th style="width:60px"><strong>Tipo de Cliente</strong></th>
                    </thead>
                <tbody>
                      @foreach ($tipocliente as $item)
                      <tr>
                        <td>{{ $item->tipo }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div><!--fin table cell4-->
      </div>

    </div>
  </div>
@endsection
