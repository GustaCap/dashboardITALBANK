@extends('layouts.app', ['activePage' => 'consultaCliente', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              
              <h4 class="card-title"><strong>AUDILOG</strong> </h4>
              
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
                  {{-- <th style="width:110px" class="text-center"><strong>Preview</strong></th> --}}
                  {{-- <th style="width:110px" class="text-center"><strong>Descargar</strong></th> --}}
                  <th style="width:110px" class="text-center"><strong>Cargado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Actualizado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Vence</strong></th>
                  <th style="width:110px" class="text-center"><strong>Usuario</strong></th>
                  {{-- <th style="width:110px" class="text-center"><strong>Acción</strong></th> --}}
                  </thead>
                <tbody>
                  {{-- @foreach($cliente->archivos as $item)
                    @if ($item->estatus_doc === 'activo') --}}

                      @foreach($data as $items)
                     
                      <tr>
                        
                        <td class="text-center">{{$items->id}}</td>
                        <td class="text-center">{{$items->name_archivo}}</td>
                        {{-- <td>{{$items->file}}</td> --}}
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
                       
                      </tr>
                     
                      @endforeach
   
                    </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
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
