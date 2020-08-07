@extends('layouts.app', ['activePage' => 'listarRuta', 'titlePage' => __('Consultar Rutas ')])

@section('content')
<div class="container">
    <h1>Directorios</h1>
    <div class="fondo">
        <div class="row">
            <div class="col">

            </div>
        </div>
    </div>
    <h1>Archivos</h1>
    <div class="fondo">
        <div class="row">
            <div class="col">

                    @foreach ($archivos as $item)
                    <a href="{{ $item }}">Ver detalles</a>

                    @endforeach

            </div>
        </div>
    </div>
</div>
@endsection



