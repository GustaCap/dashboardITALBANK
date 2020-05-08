@extends('layouts.app', ['activePage' => 'cargaDeDocumentos', 'titlePage' => __('Reistro Cliente')])

@section('content')
<div class="row justify-content-center">
    
    <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card cell4-->
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">view_carousel</i><!--icono-->
          </div>
          <p class="card-category">ItalDocumentos</p>
          <h3 class="card-title">2
            <small>Registros</small>
          </h3>
        </div>
        <div class="card-footer">
            <div class="stats">
              <a class="href-style" href="{{ route('getClienteIND') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
              {{-- <i class="material-icons">assignment_turned_in</i> Infomacion Detallada --}}

            </div>
        </div>
      </div>
    </div><!--fin card cell4-->
    <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card SharedField-->
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">view_carousel</i><!--icono-->
          </div>
          <p class="card-category">SharedFile</p>
          <h3 class="card-title">236
            <small>Registros</small>
          </h3>

        </div>
        <div class="card-footer">
          <div class="stats">
            <a class="href-style" href="{{ route('getClienteIND') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
            {{-- <i class="material-icons">assignment_turned_in</i>Total Clientes --}}
          </div>
        </div>
      </div>
    </div><!--fin card SharedField-->
    <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card SharedField-->
      <div class="card card-stats">
        <div class="card-header card-header-danger card-header-icon">
          <div class="card-icon">
            <i class="material-icons">view_carousel</i>
          </div>
          <p class="card-category">Onboarding</p>
          <h3 class="card-title">236
            <small>Registros</small>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">assignment_turned_in</i>Total Clientes
          </div>
        </div>
      </div>
    </div><!--fin card SharedField-->
    <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card ibs-->
      <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
          <div class="card-icon">
            <i class="material-icons">view_carousel</i>
          </div>
          <p class="card-category">IBS</p>
          <h3 class="card-title">236
            <small>Registros</small>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">assignment_turned_in</i> Total Clientes
          </div>
        </div>
      </div>
    </div><!--fin card ibs-->
    
  </div>
@endsection