@extends('layouts.app', ['activePage' => 'dni', 'titlePage' => __('Consulta Documento ID')])

@section('content')
<div class="content">
  <div class="container-fluid">

    {{-- Muestra los errores en la vista --}}

      @if( count( $errors ) > 0 )
            <div class="alert alert-warning" role="alert">
               @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>
        @endif </br>

    {{-- ------------------------------------ --}}

      <div class="row">
        <div class="col-md-12">
             {{-- formulario de busqueda --}}
      <form class="navbar-form" method="POST" action="{{ route('idDocumentConsultar') }}">
        @csrf {{-- Para mostrar los errores si enviamos en formulario vasio --}}
        <div class="input-group no-border">
        <input type="text" name = "id" class="form-control" placeholder="Introduzca el id del documento...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          {{-- <div class="ripple-container"></div> --}}
        </button>
        </div>
      </form> {{-- fin del formulario --}}
        </div>

      </div>


    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Informacion General</h4>
          <p class="card-category">{{ $tipoCliente }}</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    DcumentID
                  </th>
                  <th>
                    Expiration Date
                  </th>
                  <th>
                    Upload Date
                  </th>
                  <th>
                    Responsable
                  </th>
                  <th>
                    Estatus
                  </th>

                </thead>
                <tbody>
                    @foreach ($query as $item)
                    <tr>
                        <td>
                          {{ $item->id }}
                        </td>
                        <td>
                          {{ $item->documentid }}
                        </td>
                        <td>

                            {{ date('d-m-Y', strtotime($item->expdate)) }}
                          </td>
                          <td>

                            {{ $item->uploaddate }}
                          </td>
                        <td>
                        {{-- <a href="{{ '/dashboard/storage/app/public'.$item->path }}">Ver Documento</a> --}}
                        {{ $item->username }}
                        </td>

                        <td>
                            @if ( $item->uploaddate = 'Y')
                                <span class="badge badge-success">ACTIVE</span>
                            @endif
                            {{-- {{ $item->uploaddate }} --}}
                          </td>
                      </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Documentos Cargados</h4>
            <p class="card-category">...</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID Documento
                  </th>
                  <th>
                    Tipo de Documento
                  </th>
                  <th>
                    Documento
                  </th>
                  <th>
                    Preview
                  </th>
                </thead>
                <tbody>
                    @foreach ($query as $item)
                  <tr>
                    <td>
                        {{ $item->documentid }}
                      </td>
                      <td>
                       <strong>{{ $item->doc_name }}</strong>
                      </td>
                      <td>

                                <a href="{{ '/dashboard/storage/app/public'.$item->path }}">Ver Documento</a>

                        </td>
                        <td>
                            <iframe src="{{'/dashboard/storage/app/public'.$item->path}}" width="100%" height="250px"></iframe>
                          </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
