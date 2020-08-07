@extends('layouts.app', ['activePage' => 'listarCliente', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Clientes Registrados</h4>
              <p class="card-category">Lista de cliente registrados</p>
            </div>
            <div class="card-body table-responsive">
              <table id="tablelistarclientes" class="table display cell-border text-center" style="width:100%">
                  <thead class="text-danger">

                  <th style="width:60px"><strong>Tipo de Cliente</strong></th>
                  <th style="width:110px"><strong>Acción</strong></th>

                </thead>

                <tbody>
                    @foreach ($tipocliente as $item)
                    <tr>

                      <td>{{ $item->tipo }}</td>
                      {{-- <form method="POST" action="{{ route('postRegistroCliente') }}"> --}}
                      {{-- <td class="text-center"><a class="btn btn-primary" href="{{ route('getConsultaCliente',$item->id) }}">Ver detalle</a></td> --}}
                      {{-- <td class="text-center"><a class="btn btn-primary" href="{{ route('uploadDocClientes',array($item->id, $usuario) ) }}">Cargar Documentos</a></td> --}}
                      <td class="text-center"><a class="btn btn-primary" href="{{ route('getClienteItbk',array($item->id, $usuario) ) }}">Ver clientes</a></td>
                    {{-- </form> --}}

                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div><!--fin table cell4-->
        {{--  --}}

    </div>
  </div>
@endsection

{{-- @push('js')
<script type="text/javascript">
  $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#tablelistarclientes thead tr').clone(true).appendTo( '#tablelistarclientes thead' );
      $('#tablelistarclientes thead tr:eq(1) th').each( function (i) {
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
       var table = $('#tablelistarclientes').DataTable( {
          orderCellsTop: true,
          fixedHeader: true,
          pageLength : 20,
          lengthMenu: [[20, 30, 50, 100, -1], [20, 30, 50, 100, 'Todos']]
          //  order: [[ 3, "asc" ]] /*Ordenar la tabla por numero de columna*/
       } );

   } );

    </script>
@endpush --}}
