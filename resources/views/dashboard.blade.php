@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card cell4-->
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i><!--icono-->
              </div>
              <p class="card-category">ItalDocumentos</p>
              <h3 class="card-title">@foreach ($query as $item )
                  {{ $item->count }}
              @endforeach
                <small>Registros</small>
              </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="href-style" href="{{ route('dashboarditalDoc') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
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
                <a class="href-style" href="{{ route('home') }}"><i class="material-icons">assignment_turned_in</i> Infomacion Detallada</a>
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


    {{--tablas cell4 y sharedfield--}}
        <div class="row">
        <div class="col-lg-6 col-md-12"><!--Inicio table cell4-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Plataforma CELL4</h4>
              <p class="card-category">ultimos 50 registros</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                {{-- <thead class="text-warning"> --}}
                  <thead class="text-danger">
                  <th><strong>ID</strong></th>
                  <th><strong>Nombre</strong></th>
                  <th><strong>Apellido</strong></th>
                  <th><strong>Nro. De Cuenta</strong></th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div><!--fin table cell4-->
        <div class="col-lg-6 col-md-12"><!--Inicio table sharedfield-->
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Plataforma SharedField</h4>
                <p class="card-category">ultimos 50 registros</p>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-danger">
                  <th><strong>ID</strong></th>
                  <th><strong>Nombre</strong></th>
                  <th><strong>Apellido</strong></th>
                  <th><strong>Nro. De Cuenta</strong></th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>$36,738</td>
                      <td>Niger</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Minerva Hooper</td>
                      <td>$23,789</td>
                      <td>Curaçao</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Sage Rodriguez</td>
                      <td>$56,142</td>
                      <td>Netherlands</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Philip Chaney</td>
                      <td>$38,735</td>
                      <td>Korea, South</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div><!--fin table sharedfield-->


    {{--tablas Italdoc y Ibs--}}
      <div class="row">
        <div class="col-lg-6 col-md-12"><!--Inicio table ItalDocumentos-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Plataforma ItalDocumentos</h4>
              <p class="card-category">ultimos 50 registros</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-danger">
                    <th><strong>ID</strong></th>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Apellido</strong></th>
                    <th><strong>Nro. De Cuenta</strong></th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div><!--Fin table ItalDocumentos-->
        <div class="col-lg-6 col-md-12"><!--Inicio table IBS-->
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Plataforma IBS</h4>
                <p class="card-category">ultimos 50 registros</p>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-danger">
                  <th><strong>ID</strong></th>
                  <th><strong>Nombre</strong></th>
                  <th><strong>Apellido</strong></th>
                  <th><strong>Nro. De Cuenta</strong></th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>$36,738</td>
                      <td>Niger</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Minerva Hooper</td>
                      <td>$23,789</td>
                      <td>Curaçao</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Sage Rodriguez</td>
                      <td>$56,142</td>
                      <td>Netherlands</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Philip Chaney</td>
                      <td>$38,735</td>
                      <td>Korea, South</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div><!--FIN table IBS-->

    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
