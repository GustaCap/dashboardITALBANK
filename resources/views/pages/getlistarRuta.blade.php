@extends('layouts.app', ['activePage' => 'listarRuta', 'titlePage' => __('Consultar Rutas ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      {{--  --}}


    {{--tablas cell4 y sharedfield--}}
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              {{-- {{ $ip }} {{ $navegador }} --}}
              <h4 class="card-title">Tipos de Documentos Registrados</h4>

              <p class="card-category">Lista de documentos registrados</p>
            </div>
            <div class="card-body table-responsive">
              <table id="tabletipodoc" class="table display cell-border text-center" style="width:100%">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                  {{-- <th style="width:35px"><strong>id</strong></th>
                  <th style="width:60px"><strong>Carpeta</strong></th>
                  <th style="width:60px"><strong>Documento</strong></th>
                  <th style="width:80px"><strong>Nivel Relación</strong></th>
                  <th style="width:70px"><strong>Vence</strong></th>
                  <th style="width:50px"><strong>Tipo Cliente</strong></th>
                  <th style="width:70px"><strong>Requerido</strong></th>
                  <th style="width:40px"><strong>Frecuencia</strong></th>
                  <th style="width:50px"><strong>Creado</strong></th> --}}



                  <th style="width:35px"><strong>Tipo Cliente</strong></th>
                  <th style="width:80px"><strong>Nivel Relación</strong></th>
                  <th style="width:80px"><strong>Estructura</strong></th>
                  <th style="width:60px"><strong>Documento</strong></th>
                  <th style="width:70px"><strong>Requerido</strong></th>
                  <th style="width:40px"><strong>Frecuencia</strong></th>
                  <th style="width:70px"><strong>Vence</strong></th>
                  <th style="width:50px"><strong>Creado</strong></th>
                  </thead>

                <tbody>
                    @foreach ($dataRaices as $item)
                    <tr>
                      {{-- <td>{{ $item->id }}</td>
                      <td>{{ $item->carpeta_raiz }}</td>
                      <td>{{ $item->nombre_doc }}</td>
                      <td>{{ $item->nivel_relacion }}</td>

                      @if ($item->fec_expiracion == 0)

                      <td>No Aplica</td>

                      @endif
                      @if ($item->fec_expiracion == 1)

                      <td>Aplica</td>

                      @endif
                      @if ($item->tipocliente_id == 1)

                      <td>Individuos (IND)</td>

                      @endif
                      @if ($item->tipocliente_id == 2)

                      <td>Cliente Empresa (CE)</td>

                      @endif
                      @if ($item->tipocliente_id == 3)

                      <td>Cliente Bancos (CB)</td>

                      @endif
                      @if ($item->tipocliente_id == 4)

                      <td>Cliente MSB (CM)</td>

                      @endif

                      <td>{{ $item->requerido }}</td>
                      <td>{{ $item->frecuencia }}</td>
                      <td>{{ $item->created_at }}</td> --}}

                      @if ($item->tipocliente_id == 1)

                      <td>Individuos (IND)</td>

                      @endif
                      @if ($item->tipocliente_id == 2)

                      <td>Cliente Empresa (CE)</td>

                      @endif
                      @if ($item->tipocliente_id == 3)

                      <td>Cliente Bancos (CB)</td>

                      @endif
                      @if ($item->tipocliente_id == 4)

                      <td>Cliente MSB (CM)</td>

                      @endif
                      @if ($item->tipocliente_id == 5)

                      <td>Empresas</td>

                      @endif
                      <td>{{ $item->nivel_relacion }}</td>
                      <td>{{ $item->carpeta_raiz }}</td>
                      <td>{{ $item->nombre_doc }}</td>
                      <td>{{ $item->requerido }}</td>
                      <td>{{ $item->frecuencia }}</td>
                      @if ($item->fec_expiracion == 0)

                      <td>No Aplica</td>

                      @endif
                      @if ($item->fec_expiracion == 1)

                      <td>Aplica</td>

                      @endif
                      <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Tipo Cliente</th>
                      <th>Nivel Relación</th>
                      <th>Estructura</th>
                      <th>Documento</th>
                      <th>Requerido</th>
                      <th>Frecuencia</th>
                      <th>Vence</th>
                      <th>Creado</th>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div><!--fin table cell4-->
        {{--  --}}

    </div>
  </div>
@endsection

@push('js')
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> --}}
<script type="text/javascript">
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tabletipodoc thead tr').clone(true).appendTo( '#tabletipodoc thead' );
    $('#tabletipodoc thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="inputfiltro form-control text-center" type="text" placeholder="'+title+'" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    /* Idioma español*/
     var table = $('#tabletipodoc').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        order: [[ 7, "desc" ]],
        pageLength : 20,
        lengthMenu: [[20, 30, 50, 100, -1], [20, 30, 50, 100, 'Todos']]
     } );
 } );

  </script>
@endpush

