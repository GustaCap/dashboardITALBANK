@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-center mt-5">{{ __('Dashboard ItalDocumentos.') }}</h1>
      </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-8">
        <h3 class="text-center mt-5">{{ __('Bienvenidos') }}</h3>
    </div>
</div>
</div>
@endsection
