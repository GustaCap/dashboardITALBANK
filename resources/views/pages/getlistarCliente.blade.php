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
              <h4 class="card-title">Clientes Registrados</h4>
              <p class="card-category">Lista de cliente registrados</p>
            </div>
            <div class="card-body table-responsive">
              <table id="table_id" class="table display cell-border" style="width:100%">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                  <th style="width:40px"><strong>id</strong></th>
                  <th style="width:60px"><strong>Nombre</strong></th>
                  <th style="width:110px"><strong>Apellido</strong></th>
                  <th style="width:90px"><strong>Dni</strong></th>
                  <th style="width:50px"><strong>Email</strong></th>
                  <th style="width:70px"><strong>ID Italbank</strong></th>
                  <th style="width:50px"><strong>Tipo Cliente</strong></th>
                  <th style="width:80px"><strong>Cuenta</strong></th>
                  <th style="width:140px"><strong>Acción</strong></th>

                </thead>
                
                <tbody>
                    @foreach ($dataCliente as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->nombre }}</td>
                      <td>{{ $item->apellido }}</td>
                      <td>{{ $item->dni }}</td>
                      <td>{{ $item->email }}</td>
                      {{-- <td>{{ $item->n_transfer }}</td> --}}
                      {{-- <td>{{ $item->name_archivo }}</td> --}}
                      <td>{{ $item->cliente_id_itbk }}</td>
                      {{-- <td>{{ $item->tipocliente_id }}</td> --}}
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

                      <td>{{ $item->n_cuenta }}</td>
                      <form method="POST" action="{{ route('postRegistroCliente') }}">
                      <td class="text-center"><a class="btn btn-primary" href="{{ route('getConsultaCliente',$item->id) }}">Ver detalle</a></td>
                      </form>
                      
                    </tr>
                    @endforeach
                  </tbody>
                
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
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush

@push('js')
  <script>
    $(document).ready(function() {
    $('#table_id').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );
} );
  </script>
@endpush

