@extends('layouts.app', ['activePage' => 'consultaCliente', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              {{-- {{ $usuario }} --}}
              <h4 class="card-title"><strong>Detalle de Cliente</strong> </h4>
              <p class="card-category"><strong>Cliente ID: {{ $cliente->cliente_id_itbk }}</strong> </p>
              <p class="card-category"><strong>Nombre: {{ $cliente->nombre }}, {{ $cliente->apellido }}</strong> </p>
              <p class="card-category"><strong>DNI: {{ $cliente->dni }}</strong> </p>
              <p class="card-category"><strong>Correo Electronico: {{ $cliente->email }}</strong> </p>
              <p class="card-category"><strong>Cuenta Cliente: {{ $cliente->n_cuenta }}</strong> </p>
              @if ($cliente->tipocliente_id == 1)
              <p class="card-category"><strong>Tipo de Cliente: Individuo(IND)</strong> </p>
              @endif
              @if ($cliente->tipocliente_id == 2)
              <p class="card-category"><strong>Tipo de Cliente: Cliente Empresa(CE)</strong> </p>
              @endif
              @if ($cliente->tipocliente_id == 3)
              <p class="card-category"><strong>Tipo de Cliente: Cliente Bancos(CB)</strong> </p>
              @endif
              @if ($cliente->tipocliente_id == 4)
              <p class="card-category"><strong>Tipo de Cliente: Cliente MSB(CM)</strong> </p>
              @endif
              {{-- <p class="card-category"><strong>Tipo de Cliente: {{ $cliente->tipo_clienteid }}</strong> </p> --}}
              {{-- <div class="iconForward">
                <a href="{{ route('getlistarCliente') }}">
                  <i class="material-icons">forward</i>
                </a>
                </div> --}}
            </div>
            
            <div class="card-body table-responsive">
              <table id="tableDocCliente" class="table display cell-border text-center" style="width:100%">
                  <thead class="text-danger">
                  <th style="width:40px" class="text-center"><strong>id</strong></th>
                  <th style="width:60px" class="text-center"><strong>Documento</strong></th>
                  {{-- <th style="width:110px"><strong>Ubicaión</strong></th> --}}
                  <th style="width:110px" class="text-center"><strong>Preview</strong></th>
                  <th style="width:110px" class="text-center"><strong>Descargar</strong></th>
                  <th style="width:110px" class="text-center"><strong>Cargado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Actualizado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Vence</strong></th>
                  <th style="width:110px" class="text-center"><strong>Usuario</strong></th>
                  <th style="width:110px" class="text-center"><strong>Acción</strong></th>
                  </thead>
                <tbody>
                  {{-- @foreach($cliente->archivos as $item)
                    @if ($item->estatus_doc === 'activo') --}}

                      @foreach($result3 as $items)
                     
                      <tr>
                        
                        <td class="text-center">{{$items->id}}</td>
                        <td class="text-center">{{$items->name_archivo}}</td>
                        {{-- <td>{{$items->file}}</td> --}}
                        @if (Str::endsWith($items->name_archivo, '.pdf'))
                          <td class="text-center"><embed width="191" height="207" name="plugin" src="{{ '/dashboard/public'.$items->file }}" type="application/pdf"></td>  
                            {{-- <td class="text-center"><embed width="191" height="207" name="plugin" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1200px-PDF_file_icon.svg.png" type="application/pdf"></td> --}}
                        @else
                          <td class="text-center"><img src="{{ '/dashboard/public'.$items->file }}" width=120 height=90 /> </td> 
                        @endif
                        <td class="text-center"><a href="{{ '/dashboard/public'.$items->file }}" target="_blank"><i class="material-icons">get_app</i></a></td>
                        {{-- <td><img src="{{ '/dashboard/public'.$items->file }}" width=120 height=90 /> </td>  --}}
                        <td class="text-center">{{$items->created_at}}</td>
                        <td class="text-center">{{$items->updated_at}}</td>
                        @php
                          $fechahoy =strtotime(date('y-m-d'));
                          // echo $fechahoy;
                        @endphp
                        @if (!empty($items->fecha_vence) && $fechahoy > strtotime($items->fecha_vence))
                          <td style="color:red" class="text-center"><strong> {{ $items->fecha_vence }}</strong><span class="badge badge-danger">Vencido</span>
                        </td>
                        @endif
                        @if (!empty($items->fecha_vence) && $fechahoy < strtotime($items->fecha_vence))
                          <td >{{ $items->fecha_vence }}</td>
                        @endif
                        @if (empty($items->fecha_vence))
                          <td class="text-center" ><span class="badge badge-primary">No Aplica</span></td>
                        @endif
                        <td class="text-center">{{$items->usuario}}</td>
                        {{-- <td class="text-center"><a class="btn btn-primary" href="{{ route('getEliminarDocumento',$items->id) }}">Eliminar</a></td> --}}
                        <td class="text-center"><a class="btn btn-primary" href="{{ route('getEliminarDocumento',array($items->id, $usuario)) }}">Eliminar</a></td>
                      </tr>
                     
                      @endforeach
   
                    </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>




    {{-- prueba *****************************************************************************************************************  --}}
    <div class="row">
      <div class="col-lg-12 col-md-10"><!--Inicio table cell4-->
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title"><strong>Detalles de Carga</strong></h4>
            <p class="card-category"><strong>Documentos cargados y faltantes</strong> </p>
          </div>
          {{-- {{ print_r($result) }} --}}
          <div class="card-body table-responsive">
            <table id="tableDocCargados" class="table display cell-border" style="width:100%">
              {{-- <thead class="text-warning"> --}}
                <thead class="text-danger">
                
                <th style="width:40px" class="text-center"><strong>id</strong></th>
                <th style="width:110px" class="text-center"><strong>Nivel Relación</strong></th>
                <th style="width:110px"><strong>Documento</strong></th>
                <th style="width:110px" class="text-center"><strong>Frecuencia</strong></th>
                <th style="width:110px" class="text-center"><strong>Requerido</strong></th>
                <th style="width:110px" class="text-center"><strong>status</strong></th>
              </thead>
              
              <tbody>
                  {{-- @foreach ($cliente as $item) --}}
                  
                  @foreach($result as $item)
                    <tr>
                      <td class="text-center">{{$item->id}}</td>
                      <td class="text-center bg">{{$item->nivel_relacion}}</td>
                      <td>{{$item->carpeta_raiz}}</td>
                      <td class="text-center">{{$item->frecuencia}}</td>
                      <td class="text-center">{{$item->requerido}}</td>
                     
                      @if (in_array($item->id, $array2))
                      <td class="text-center">
                        <div data-tooltip="Cargado" class="c">
                          <i class="material-icons" style="color: green; font-size: 2rem;">done_all</i>
                        </div>
                      </td>
                      @else
                      <td class="text-center">
                        <div data-tooltip="No Cargado" class="nc">
                          <i class="material-icons" style="color: orange">done</i>
                        </div>
                      </td>

                      {{-- <td class="text-center"><i class="material-icons" style="color: orange">done</i></td> --}}
                      @endif
                      </tr>
                    @endforeach
                </tbody>
            </table>
           
          </div>
          {{-- {{ $array }} --}}
        </div>
      </div><!--fin table cell4-->
  </div>
  {{-- ************************************************************************************************************************ --}}
    
   
  </div>
@endsection
{{-- @push('js')
  <script>
   this.thumbPreview=function(){xOffset=10,yOffset=30,$("a.thumb").hover(function(t){this.t=this.title,this.title="";var e=""!=this.t?"<br>"+this.t:"";$("body").append("<p id='thumb'><img width='300x' src='"+this.href+"' alt='' />"+e+"</p>"),$("#thumb").css("top",t.pageY-xOffset+"px").css("left",t.pageX+yOffset+"px").fadeIn("fast")},function(){this.title=this.t,$("#thumb").remove()}),$("a.thumb").mousemove(function(t){$("#thumb").css("top",t.pageY-xOffset+"px").css("left",t.pageX+yOffset+"px")})},$(document).ready(function(){thumbPreview()});
  </script>
@endpush --}}
@push('js')
<script type="text/javascript">
  $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#tableDocCliente thead tr').clone(true).appendTo( '#tableDocCliente thead' );
      $('#tableDocCliente thead tr:eq(1) th').each( function (i) {
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
       var table = $('#tableDocCliente').DataTable( {
           orderCellsTop: true,
           fixedHeader: true,
           order: [[ 4, "desc" ]]
       } );
   } );
  
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
          // Setup - add a text input to each footer cell
          $('#tableDocCargados thead tr').clone(true).appendTo( '#tableDocCargados thead' );
          $('#tableDocCargados thead tr:eq(1) th').each( function (i) {
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
           var table = $('#tableDocCargados').DataTable( {
               orderCellsTop: true,
               fixedHeader: true,
               order: [[ 5, "desc" ]]
           } );
       } );
      
        </script>
@endpush
