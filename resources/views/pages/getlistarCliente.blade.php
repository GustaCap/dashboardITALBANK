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
                  <th style="width:60px"><strong>Nombre</strong></th>
                  <th style="width:150px"><strong>Tipo de Cliente</strong></th>
                  <th style="width:90px"><strong>DNI</strong></th>
                  <th style="width:50px"><strong>Email</strong></th>
                  <th style="width:70px"><strong>ID Italbank</strong></th>
                  <th style="width:80px"><strong>Cuenta</strong></th>
                  <th style="width:140px"><strong>Acción</strong></th>
                </thead>

                <tbody>
                    @foreach ($dataCliente as $item)
                    <tr>

                      <td>{{ $item->NOMBRE }}</td>
                      <td>{{ $item->Clasificacion }}</td>
                      <td>{{ $item->IDENTIFICACION }}</td>
                      <td>{{ $item->correo }}</td>
                      <td>{{ $item->IDCLIENTE }}</td>
                      <td>{{ $item->CUENTA }}</td>
                      <form method="POST" action="{{ route('postRegistroCliente') }}">
                      <td class="text-center"><a class="btn btn-primary" href="{{ route('getConsultaCliente',array($item->IDCLIENTE, $usuario)) }}">Ver detalle</a></td>
                      </form>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo de Cliente</th>
                        <th>Dni</th>
                        <th>Email</th>
                        <th>Id italbank</th>
                        <th>Cuenta</th>
                        <th>Acción</th>
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
        order: [[ 0, "asc" ]],
        pageLength : 20,
        lengthMenu: [[20, 30, 50, 100, -1], [20, 30, 50, 100, 'Todos']]
     } );
 } );

    </script>
@endpush


