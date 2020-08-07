@extends('layouts.app', ['activePage' => 'getClienteIND', 'titlePage' => __('Carga de Documentos Cliente IND')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success" style="display:none"></div>
          {{-- <form class="form-horizontal" enctype="multipart/form-data" id="formuploadajax"> --}}
            <form method="post" action="{{ route('postClienteFiles') }}" id="upload_form" enctype="multipart/form-data">
            @csrf
            {{-- {{ $usuario }} --}}
            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}" />
            <input type="hidden" name="nombre" id="nombre" value="{{ $nombre }}" />
            <input type="hidden" name="cliente_id_itbk" id="cliente_id_itbk" value="{{ $cliente_id_itbk }}" />
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Documentos') }}</h4>
                <p class="card-category">Cliente Italbank: {{ $nombre }}</p>
                <p class="card-category">Italbank ID: {{ $cliente_id_itbk }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Numero de Cuenta') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select id="n_cuenta" name="n_cuenta" class="form-control seleccion" required>
                          <option> </option>
                          @foreach($data as $item)
                               <option value="{{ $item->n_cuenta }}">{{ $item->n_cuenta }}</option>
                          @endforeach

                   </select>
                  </div>
                  </div>
                </div>

                <div class="row d-flex justify-content-center">
                  <div class="col-lg-10 col-md-12">
                    <div class="progress mt-5 mb-5" style="height: 1.5rem;">
                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <div id="success" class="text-center"></div>
                  </div>

                  <div class="card-body table-responsive">
                    <table id="table_id" class="table display table-bordered text-center" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Opción</th>
                            <th>Frecuencia</th>
                            <th>Nivel Relación</th>
                            {{-- <th>Estructura</th> --}}
                            <th>Estructura</th>
                            <th>Documento</th>
                            <th class="text-center">Requerido</th>
                            <th class="text-center">Vence</th>
                            <th>Archivo</th>
                            <th class="text-center">Cargar</th>
                        </tr>
                        <td colspan="8">
                          <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" />
                        </td>
                    </thead>
                    <tbody>
                      @foreach($data2 as $item)
                        <tr>
                            <td class="text-center"><input type="radio" id="carpetas" name="carpetas" value="{{ $item->carpeta_raiz }}" required></td>
                            <td class="text-center">{{ $item->frecuencia }}</td>
                            {{-- <td>{{ $item->nivel_relacion }}</td> --}}
                            @if ($item->nivel_relacion == 'cliente')
                            <td class="bg-success">{{ $item->nivel_relacion }}</td>
                            @else
                            <td class="bg-warning" >{{ $item->nivel_relacion }}</td>
                            @endif
                            <td>{{ $item->carpeta_raiz }}</td>
                            <td>{{ $item->nombre_doc }}</td>
                            @if ($item->requerido == 'Obligatorio')
                            <td class="text-center"><span class="badge badge-success">{{ $item->requerido }}</span></td>
                            @endif
                            @if ($item->requerido == 'No Obligatorio')
                            <td class="text-center"><span class="badge badge-warning">{{ $item->requerido }}</span></td>
                            @endif
                            @if ($item->requerido == 'Excepción')
                            <td class="text-center"><span class="badge badge-info">{{ $item->requerido }}</span></td>
                            @endif
                            {{-- <td><input type="date" name = "fecEmitido" id="fecEmitido"></td> --}}
                            @if ($item->fec_expiracion == '1')
                            <td><input type="date" name = "fecExpira" id="fecExpira"></td>
                            @else
                            <td class="text-center">No Aplica</td>
                            @endif
                            {{-- <td><input type="date" name = "fecExpira" id="fecExpira"></td> --}}
                            <td><input id="file" name="file" type="file"></td>
                            <td><button type="submit" class="btn btn-primary" id="ajaxSubmit">{{ __('Cargar') }}</button></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
                </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  @push('js')
  <script type="text/javascript">
    $(document).ready(function(){
        $('#cliente').on('change', function (){
            var cliente_id_itbk = $(this).val();
            if ($.trim(cliente_id_itbk) != '') {
                $.get('cuentas', {cliente_id_itbk: cliente_id_itbk}, function (cuentas) {
                    $('#cuenta').empty();
                    $('#cuenta').append("<option value=''>Seleccione Documento Base</option>");
                    $.each(cuentas, function (index, value) {
                        $('#cuenta').append("<option value='"+index+"'>"+value+"</option>");

                    })
                });

            }

        });
});
  </script>
  @endpush
  @push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">

/*Filtro para la tabla*/

var busqueda = document.getElementById('buscar');
    var table = document.getElementById("table_id").tBodies[0];

    buscaTabla = function(){
      texto = busqueda.value.toLowerCase();
      var r=0;
      while(row = table.rows[r++])
      {
        if ( row.innerText.toLowerCase().indexOf(texto) !== -1 )
          row.style.display = null;
        else
          row.style.display = 'none';
      }
    }

    busqueda.addEventListener('keyup', buscaTabla);

/*Final del script para filtrar la tabla*/

$(document).ready(function(){

$('form').ajaxForm({
  beforeSend:function(){
    $('#success').empty();
  },
  uploadProgress:function(event, position, total, percentComplete)
  {
    $('.progress-bar').text(percentComplete + '%');
    $('.progress-bar').css('width', percentComplete + '%');
  },
  success:function(data)
  {
    if(data.errors)
    {
      $('.progress-bar').text('0%');
      $('.progress-bar').css('width', '0%');
      $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
    }
    if(data.success)
    {
      $('.progress-bar').text('Uploaded');
      $('.progress-bar').css('width', '100%');
      $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
      $('#success').append(data.image);
    }
  }
});

});

/**Validacion para tamaño de la imagen */
$(document).on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);

	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

	if(fileSize > 204800000000){
		alert('El archivo no debe superar los 2GB');
		this.value = '';
		this.files[0].name = '';
	}else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();

		// Convertimos en minúscula porque
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();

		// console.log(ext);
		switch (ext) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'pdf': break;
			default:
				alert('El archivo no tiene la extensión adecuada');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}
});


/*Valdar fecha */
$(document).on('change','input[type="date"]',function(){

var hoy             = new Date();
var fechaFormulario = new Date(document.getElementById("fecExpira").value);

// Compara solo las fechas => no las horas!!
hoy.setHours(0,0,0,0);

if(hoy > fechaFormulario){
    alert('Documento Vencido');
  this.value = '';
  }
});
//Fin validar Fecha


// Select dinamico con buscardor, usando la libreria Select2
$(document).ready(function() {
    $('.seleccion').select2();
});
// Fin Select2
</script>
@endpush


@endsection
