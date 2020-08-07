@extends('layouts.app', ['activePage' => 'getListarTransferencias', 'titlePage' => __('Consultar Cliente ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title"><strong>Detalle de Transferencias</strong> </h4>
            </div>
            <div class="card-body table-responsive">
              <table id="tableDocCliente" class="table display cell-border text-center" style="width:100%">
                  <thead class="text-danger">
                  <th style="width:40px" class="text-center"><strong>id</strong></th>
                  <th style="width:60px" class="text-center"><strong>Número de Transferencia</strong></th>
                  <th style="width:60px" class="text-center"><strong>Descripción</strong></th>
                  {{-- <th style="width:110px"><strong>Ubicaión</strong></th> --}}
                  <th style="width:110px" class="text-center"><strong>Preview</strong></th>
                  <th style="width:110px" class="text-center"><strong>Descargar</strong></th>
                  <th style="width:110px" class="text-center"><strong>Cargado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Usuario</strong></th>
                  <th style="width:110px" class="text-center"><strong>Acción</strong></th>
                  </thead>
                <tbody>
                  {{-- @foreach($cliente->archivos as $item)
                    @if ($item->estatus_doc === 'activo') --}}

                      @foreach($data as $items)

                      <tr>

                        <td class="text-center">{{$items->id}}</td>
                        <td class="text-center">{{$items->n_transfer}}</td>
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
                        <td class="text-center">{{$items->usuario}}</td>
                        <td class="text-center"><a class="btn btn-primary" href="{{ route('getEliminarDocumento',array($items->id, $usuario)) }}">Eliminar</a></td>
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
