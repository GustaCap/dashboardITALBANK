@extends('layouts.app', ['activePage' => 'searchFechaRegistro', 'titlePage' => __('Consultar Fecha de Registro ')])

@section('content')
<div class="content">
  <div class="container-fluid">

    {{-- Muestra los errores en la vista --}}

      @if( count( $errors ) > 0 )
            <div class="alert alert-warning" role="alert">
               @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>
        @endif </br>

    {{-- ------------------------------------ --}}

    <div class="row">
        <div class="col-md-12">
             {{-- formulario de busqueda --}}
      <form class="navbar-form" method="POST" action="{{ route('fechaRegistroConsultar') }}">
        @csrf {{-- Para mostrar los errores si enviamos en formulario vasio --}}
        <div class="input-group no-border">
        <input type="text" id="datepicker" name = "fecha" class="form-control" placeholder="Introduzca la fecha de Registro">
        {{-- <p>Date: <input type="text" id="datepicker"></p> --}}
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          {{-- <div class="ripple-container"></div> --}}
        </button>
        </div>
      </form> {{-- fin del formulario --}}
        </div>

      </div>
  </div>
</div>
@push('js')
<script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
@endpush


@endsection
