@extends('layouts.app', ['activePage' => 'searchDocID', 'titlePage' => __('Consultar ID Documentos ')])

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
              <p class="card-category">Lista de documentos cargados</p>
            </div>
            <div class="card-body table-responsive">
              <table id="table_id" class="table display cell-border" style="width:100%">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                  {{-- <th style="width:40px"><strong>id</strong></th> --}}
                  <th style="width:60px"><strong>Pre-id</strong></th>
                  <th style="width:110px"><strong>Cliente-id</strong></th>
                  <th style="width:134px"><strong>Tipo Cliente</strong></th>
                  <th style="width:180px"><strong>Nro.Cuenta</strong></th>
                  {{-- <th><strong>Nro.Transferencia</strong></th> --}}
                  {{-- <th><strong>Archivo</strong></th> --}}
                  <th style="width:180px"><strong>File</strong></th>
                  <th style="width:50px"><strong>Ver</strong></th>
                  <th style="width:50px"><strong>Preview</strong></th>
                  {{-- <th style="width:80px"><strong>Emitido</strong></th> --}}
                  <th style="width:80px"><strong>Vence</strong></th>
                  {{-- <th style="width:120px"><strong>Cargado</strong></th> --}}
                </thead>
                
                <tbody>
                    @foreach ($archivos as $item)
                    <tr>
                      {{-- <td>{{ $item->id }}</td> --}}
                      <td>{{ $item->p_cliente_id }}</td>
                      <td>{{ $item->cliente_id }}</td>
                      <td>{{ $item->tipo_cliente }}</td>
                      <td>{{ $item->n_cuenta }}</td>
                      {{-- <td>{{ $item->n_transfer }}</td> --}}
                      {{-- <td>{{ $item->name_archivo }}</td> --}}
                      <td>{{ $item->name_archivo }}</td>
                      
                      <td><a href="{{ '/dashboard/public'.$item->file }}"><i class="material-icons">get_app</i></a></td>
                      {{-- <td><iframe src="{{'/dashboard/public'.$item->file}}" width="100%" height="250px"></iframe></td> --}}
                      <td><canvas>src="{{'/dashboard/public'.$item->file}}" width="100" height="100"></canvas></td>
                      {{-- <td>img-pdf</td> --}}
                      {{-- <td>{{ $item->fecha_emitido }}</td> --}}
                      @php
                          $fechahoy =strtotime(date('y-m-d'));
                          // echo $fechahoy;
                          @endphp
                      @if (!empty($item->fecha_vence) && $fechahoy > strtotime($item->fecha_vence))
                      <td style="color:red"><strong> {{ $item->fecha_vence }}</strong>
                        {{-- <button class="btn btn-primary" type="submit">Actualizar</button> --}}
                      </td>
                          
                      @else
                      <td >{{ $item->fecha_vence }}</td>
                      @endif
                     
                      
                      
                       {{-- <td>{{ $item->fecha_vence }}</td> --}}
                      {{-- <td>{{ $item->created_at }}</td> --}}
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

