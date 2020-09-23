@extends('layouts.app', ['activePage' => 'Historico', 'titlePage' => __('Historicos')])
@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              {{-- {{ $usuario }} --}}
              @foreach ( $cliente as $cliente )
              <h4 class="card-title"><strong>Detalle de Cliente</strong> </h4>
              <p class="card-category"><strong>Cliente ID: {{ $cliente->cliente_id_itbk }}</strong> </p>
              <p class="card-category"><strong>Nombre: {{ $cliente->nombre }}</strong> </p>
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
              @endforeach

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
                  <th style="width:60px" class="text-center"><strong>Documento id</strong></th>
                  <th style="width:110px" class="text-center"><strong>Preview</strong></th>
                  <th style="width:110px" class="text-center"><strong>Descargar</strong></th>
                  <th style="width:110px" class="text-center"><strong>Vence</strong></th>
                  <th style="width:110px" class="text-center"><strong>Cargado</strong></th>
                  <th style="width:110px" class="text-center"><strong>Usuario</strong></th>


                  </thead>
                <tbody>
                  {{-- @foreach($cliente->archivos as $item)
                    @if ($item->estatus_doc === 'activo') --}}

                    @foreach($data as $items)
                    <tr>
                        <td class="text-center">{{$items->id}}</td>
                        <td class="text-center">{{$items->documentid}}</td>

                        {{-- previews --}}
                        @if (Str::endsWith($items->path, '.PDF'))
                        @php
                            $path = substr($items->path, 14);
                        @endphp
                        <td class="text-center"><embed width="191" height="207" name="plugin" src="{{ 'http://10.200.0.71/'.$path }}" type="application/pdf"></td>
                        @else
                        @php
                            $path = substr($items->path, 14);
                        @endphp
                            <td class="text-center"><img src="{{ 'http://10.200.0.71/'.$path }}" width=120 height=90 /> </td>
                        @endif

                        {{-- Descargas --}}
                        @php
                            $path = substr($items->path, 14);
                        @endphp
                        <td class="text-center"><a href="{{ 'http://10.200.0.71/'.$path }}" target="_blank"><i class="material-icons">get_app</i></a></td>

                        {{-- vence --}}
                        <td class="text-center">{{$items->expdate}}</td>

                        {{-- cargado --}}
                        <td class="text-center">{{$items->uploaddate}}</td>

                        {{-- usuario --}}
                        <td class="text-center">{{$items->username}}</td>

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
