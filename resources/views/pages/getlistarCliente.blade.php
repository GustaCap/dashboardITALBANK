@extends('layouts.app', ['activePage' => 'listarCliente', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      {{--  --}}


    {{--tablas cell4 y sharedfield--}}
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              {{-- @foreach ($re as $item)
                  {{ $item->['_token'] }}
              @endforeach --}}
      {{-- {{ $value }} --}}
              <h4 class="card-title">Clientes Registrados</h4>
              <p class="card-category">Lista de cliente registrados</p>
            </div>
            <div class="card-body table-responsive">
              <table id="tablelistarclientes" class="table display cell-border text-center" style="width:100%">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                    {{-- {{ $usuario }} --}}
                  {{-- <th style="width:40px"><strong>id</strong></th> --}}
                  <th style="width:60px"><strong>Nombre</strong></th>

                  <th style="width:90px"><strong>DNI</strong></th>
                  <th style="width:50px"><strong>Email</strong></th>
                  <th style="width:70px"><strong>ID Italbank</strong></th>
                  <th style="width:150px"><strong>Tipo Cliente</strong></th>
                  <th style="width:80px"><strong>Cuenta</strong></th>
                  <th style="width:140px"><strong>Acción</strong></th>

                </thead>

                <tbody>
                    @foreach ($dataCliente as $item)
                    <tr>
                      {{-- <td>{{ $item->id }}</td> --}}
                      <td>{{ $item->nombre }}</td>

                      <td>{{ $item->dni }}</td>
                      <td>{{ $item->email }}</td>
                      {{-- <td>{{ $item->n_transfer }}</td> --}}
                      {{-- <td>{{ $item->name_archivo }}</td> --}}
                      <td>{{ $item->cliente_id_itbk }}</td>
                      {{-- <td>{{ $item->tipocliente_id }}</td> --}}
                      @if ($item->tipocliente_id == 1)

                      <td>Individuo</td>

                      @endif
                      @if ($item->tipocliente_id == 2)

                      <td>Pencionado</td>

                      @endif
                      @if ($item->tipocliente_id == 3)

                      <td>Fondo Mutual</td>

                      @endif
                      @if ($item->tipocliente_id == 4)

                      <td>BMI</td>

                      @endif
                      @if ($item->tipocliente_id == 5)

                      <td>Empresas</td>

                      @endif
                      @if ($item->tipocliente_id == 6)

                      <td>Instituciones Financieras</td>

                      @endif
                      @if ($item->tipocliente_id == 7)

                      <td>Nomina</td>

                      @endif
                      @if ($item->tipocliente_id == 8)

                      <td>Banco Publico A</td>

                      @endif
                      @if ($item->tipocliente_id == 9)

                      <td>Empresa Publica B</td>

                      @endif
                      @if ($item->tipocliente_id == 10)

                      <td>Empresa Convenio C</td>

                      @endif
                      @if ($item->tipocliente_id == 11)

                      <td>Empresa Convenio D</td>

                      @endif
                      @if ($item->tipocliente_id == 12)

                      <td>Personal Account</td>

                      @endif

                      <td>{{ $item->n_cuenta }}</td>
                      <form method="POST" action="{{ route('postRegistroCliente') }}">
                      {{-- <td class="text-center"><a class="btn btn-primary" href="{{ route('getConsultaCliente',$item->id) }}">Ver detalle</a></td> --}}
                      <td class="text-center"><a class="btn btn-primary" href="{{ route('getConsultaCliente',array($item->id, $usuario)) }}">Ver detalle</a></td>
                      </form>

                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        {{-- <th>Id</th> --}}
                        <th>Nombre</th>

                        <th>Dni</th>
                        <th>Email</th>
                        <th>Id italbank</th>
                        <th>Tipo Cliente</th>
                        <th>Cuenta</th>
                        <th>Acción</th>

                    </tr>
                </tfoot>

                {{-- <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody> --}}
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


