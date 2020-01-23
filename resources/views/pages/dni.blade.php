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
            <p class="card-category"> ...</p>
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
                  {{-- <th>
                    City
                  </th>
                  <th>
                    Salary
                  </th> --}}
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
                  {{-- <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                    <td class="text-primary">
                      $36,738
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      Minerva Hooper
                    </td>
                    <td>
                      Curaçao
                    </td>
                    <td>
                      Sinaai-Waas
                    </td>
                    <td class="text-primary">
                      $23,789
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      Sage Rodriguez
                    </td>
                    <td>
                      Netherlands
                    </td>
                    <td>
                      Baileux
                    </td>
                    <td class="text-primary">
                      $56,142
                    </td>
                  </tr>
                  <tr>
                    <td>
                      4
                    </td>
                    <td>
                      Philip Chaney
                    </td>
                    <td>
                      Korea, South
                    </td>
                    <td>
                      Overland Park
                    </td>
                    <td class="text-primary">
                      $38,735
                    </td>
                  </tr>
                  <tr>
                    <td>
                      5
                    </td>
                    <td>
                      Doris Greene
                    </td>
                    <td>
                      Malawi
                    </td>
                    <td>
                      Feldkirchen in Kärnten
                    </td>
                    <td class="text-primary">
                      $63,542
                    </td>
                  </tr>
                  <tr>
                    <td>
                      6
                    </td>
                    <td>
                      Mason Porter
                    </td>
                    <td>
                      Chile
                    </td>
                    <td>
                      Gloucester
                    </td>
                    <td class="text-primary">
                      $78,615
                    </td>
                  </tr> --}}
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
                    Mod
                  </th>
                  <th>
                    Documento
                  </th>
                  <th>
                    Preview
                  </th>
                  {{-- <th>
                    Salary
                  </th> --}}
                </thead>
                <tbody>
                    @foreach ($query as $item)
                  <tr>
                    <td>
                        {{ $item->documentid }}
                      </td>
                      <td>
                        {{ $item->mod }}
                      </td>
                      <td>

                                <a href="{{ '/dashboard/storage/app/public'.$item->path }}">Ver Documento</a>

                        </td>
                        <td>
                            <iframe src="{{'/dashboard/storage/app/public'.$item->path}}" width="80%" height="auto"></iframe>
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
