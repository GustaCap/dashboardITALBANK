@extends('layouts.app', ['activePage' => 'getClienteIND', 'titlePage' => __('getClienteIND')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success" style="display:none"></div>
          {{-- <form class="form-horizontal" enctype="multipart/form-data" id="formuploadajax"> --}}
            <form method="post" action="{{ route('postClienteFiles') }}" id="upload_form" enctype="multipart/form-data">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Carga de Documentos') }}</h4>
                <p class="card-category">{{ __('Informacion del Cliente') }}</p>
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
                  <label class="col-sm-2 col-form-label">{{ __('Cuenta') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select id="numCuenta" name="numCuenta" class="form-control" required>
                          <option> </option>
                          @foreach($dataClientes as $item)
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
                  </div>

                  <div class="card-body table-responsive-sm">
                  <table class="table table-hover table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Select</th>
                            <th>Documento</th>
                            <th>Requerido</th>
                            {{-- <th>Emitido</th> --}}
                            <th>Vence</th>
                            <th>Archivo</th>
                            <th>Cargar</th>
                            {{-- <th>mensaje</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($dataRaices as $item)
                        <tr>
                            <td><input type="radio" id="carpetas" name="carpetas" value="{{ $item->carpeta_raiz }}" required></td>
                            <td><label for="carpetas">{{ $item->carpeta_raiz }}</label><br></td>
                            <td>{{ $item->requerido }}</td>
                            {{-- <td><input type="date" name = "fecEmitido" id="fecEmitido"></td> --}}
                            @if ($item->fec_expiracion == '1')
                            <td><input type="date" name = "fecExpira" id="fecExpira"></td>
                            @else
                            <td>No Aplica</td>
                            @endif
                            {{-- <td><input type="date" name = "fecExpira" id="fecExpira"></td> --}}
                            <td><input id="file" name="file" type="file"></td>
                            <td><button type="submit" class="btn btn-primary mb-4" id="ajaxSubmit">{{ __('Cargar') }}</button></td>
                           
                        </tr>
                        @endforeach      
                    </tbody>
                </table>
              </div>








                </div>
                {{-- <div class="row">
                  <div class="col-sm-8">
                 
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Documento</th>
                            <th>Requerido</th>
                           
                            <th>Vence</th>
                            <th>Archivo</th>
                            <th>Cargar</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($dataRaices as $item)
                        <tr>
                            <td><input type="checkbox" id="carpetas" name="carpetas" value="{{ $item->carpeta_raiz }}"></td>
                            <td><label for="carpetas">{{ $item->carpeta_raiz }}</label><br></td>
                            <td>{{ $item->requerido }}</td>
                           
                            <td><input type="date" name = "fecExpira" id="fecExpira"></td>
                            <td><input id="file" name="file" type="file"></td>
                            <td><button type="submit" class="btn btn-primary mb-4" id="ajaxSubmit">{{ __('Cargar') }}</button></td>
                           
                        </tr>
                        @endforeach      
                    </tbody>
                </table>
              </div> --}}
                </div>
                
                {{-- FECHA DE EMISION --}}
                {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Emisión') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="text" id="datepicker1" name = "fecEmitido" class="form-control" required>
                      </div>
                    </div>
                  </div> --}}
                  {{-- FECHA DE EXPIRA --}}
                  {{-- <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Fecha de Expiración') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input type="text" id="datepicker2" name = "fecExpira" class="form-control" placeholder="Si aplica para la ruta selecionada">
                      </div>
                    </div>
                  </div> --}}
                {{-- <div class="row">
                    <label class="col-sm-2 col-form-label mt-3">{{ __('Cargar documento') }}</label>
                    <div class="col-sm-7 mt-4">

                        <input id="file-input" name="file" type="file" required/>

                    </div>
                  </div> --}}
              {{-- </div>
              <div class="card-footer ml-auto mr-auto">

                <button type="submit" class="btn btn-primary mb-4">{{ __('Cargar Documentos') }}</button>
              </div> --}}
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  @push('js')
 
{{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

   

  $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

  });

 

  $(".btn-submit").click(function(e){



      e.preventDefault();

 
      var numCuenta = $("input[name=numCuenta]").val();
      var carpetas = $("input[name=carpetas]").val();
      var fecEmitido = $("input[name=fecEmitido]").val();
      var fecExpira = $("input[name=fecExpira]").val();
      var file = $("input[name=file]").val();

 

      $.ajax({

         type:'POST',

         url:'/postClienteFiles',

         data:{numCuenta:numCuenta, carpetas:carpetas, fecEmitido:fecEmitido, fecExpira:fecExpira, file:file},

         success:function(data){

            alert(data.success);

         }

      });



});

</script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
  // $(document).ready(function(){
  
  //     $('form').ajaxForm({
  //       beforeSend:function(){
  //         $('#success').empty();
  //       },
  //       uploadProgress:function(event, position, total, percentComplete)
  //       {
  //         $('.progress-bar').text(percentComplete + '%');
  //         $('.progress-bar').css('width', percentComplete + '%');
  //       },
  //       success:function(data)
  //       {
  //         if(data.errors)
  //         {
  //           $('.progress-bar').text('0%');
  //           $('.progress-bar').css('width', '0%');
  //           $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
  //         }
  //         if(data.success)
  //         {
  //           $('.progress-bar').text('Uploaded');
  //           $('.progress-bar').css('width', '100%');
  //           $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
  //           $('#success').append(data.image);
  //         }
  //       }
  //     });
  
  // });
  
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
function validarFechaMenorActual(date){
      var x=new Date();
      var fecha = date.split("/");
      x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
      var today = new Date();
 
      if (x >= today)
        return false;
      else
      alert("Documento vencido");
}

  </script>

  @endpush
@endsection