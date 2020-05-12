@extends('layouts.app', ['activePage' => 'consultaCliente', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      {{--  --}}


    {{--tablas cell4 y sharedfield--}}
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title"><strong>Detalle de Cliente</strong> </h4>
              <p class="card-category"><strong>Nombre: {{ $cliente->nombre }}, {{ $cliente->apellido }}</strong> </p>
              <p class="card-category"><strong>DNI: {{ $cliente->dni }}</strong> </p>
              <p class="card-category"><strong>Correo Electronico: {{ $cliente->email }}</strong> </p>
              <p class="card-category"><strong>Cuenta Cliente: {{ $cliente->n_cuenta }}</strong> </p>
              <div class="iconForward">
                <a href="{{ route('getlistarCliente') }}">
                  <i class="material-icons">forward</i>
                </a>
                </div>
                
            </div>
            <div class="card-body table-responsive">
              <table id="table_id" class="table display cell-border" style="width:100%">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                  <th style="width:40px"><strong>id</strong></th>
                  <th style="width:60px"><strong>Documento</strong></th>
                  <th style="width:110px"><strong>Tipo de Documento</strong></th>
                </thead>
                
                <tbody>
                    {{-- @foreach ($cliente as $item) --}}
                    
                      @foreach($cliente->archivos as $items)
                      <tr>
                        <td>{{$items->id}}</td>
                        <td>{{$items->name_archivo}}</td>
                        <td>{{$items->file}}</td>
                      </tr>
                      @endforeach
                    
                    {{-- @endforeach --}}
                  </tbody>
              </table>
            </div>
          </div>
        </div><!--fin table cell4-->
        {{--  --}}

    </div>




    {{-- prueba *****************************************************************************************************************  --}}
    <div class="row">
      <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title"><strong>Detalle de Cliente</strong>{{ $cliente->tipocliente_id }} </h4>
            <p class="card-category"><strong>Nombre: {{ $cliente->nombre }}, {{ $cliente->apellido }}</strong> </p>
            <p class="card-category"><strong>DNI: {{ $cliente->dni }}</strong> </p>
            <p class="card-category"><strong>Correo Electronico: {{ $cliente->email }}</strong> </p>
            <p class="card-category"><strong>Cuenta Cliente: {{ $cliente->n_cuenta }}</strong> </p>
            <div class="iconForward">
              <a href="{{ route('getlistarCliente') }}">
                <i class="material-icons">forward</i>
              </a>
              </div>
              
          </div>
          {{-- {{ print_r($result) }} --}}
          <div class="card-body table-responsive">
            <table id="table_id" class="table display cell-border" style="width:100%">
              {{-- <thead class="text-warning"> --}}
                <thead class="text-danger">
                
                <th style="width:60px"><strong>Documento</strong></th>
                <th style="width:110px"><strong>Status</strong></th>
              </thead>
              
              <tbody>
                  {{-- @foreach ($cliente as $item) --}}
                  
                  {{-- @foreach($result as $item)
                    <tr>
                      
                      
                      <td>{{$item->carpeta_raiz}}</td>
                      @foreach($cliente->archivos as $items)
                     @if (Str::contains($items->file, $item->carpeta_raiz))
                     <td>esta</td>
                     @else
                     <td>Noesta</td>
                     @endif
                     @endforeach
                     
                    </tr>
                    @endforeach --}}
                    
                  
                </tbody>
            </table>
            
            @foreach($cliente->archivos as $items)
	
            Id : {{ $items->file }} 
            Process :
            @if (in_array('4', $array))
              <p>esta</p>
            @else
              Record missing;
            @endif
          
          @endforeach
                     
          </div>
          {{-- {{ $array }} --}}
        </div>
      </div><!--fin table cell4-->
      {{--  --}}

  </div>
  {{-- ************************************************************************************************************************ --}}
    
   
  </div>
@endsection

{{-- @push('js')
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
  </script> --}}
{{-- @endpush --}}