@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        {{-- primera fila --}}
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6"><!--inicio card cell4-->
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i><!--icono-->
              </div>
              <p class="card-category">Registros</p>
              <h3 class="card-title">@foreach ($query as $item )
                  {{ $item->count }}
              @endforeach
                <small>Documentos Registrados</small>
              </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                Fecha Ultima Actualizacion:<span class="badge badge-success">{{$fecha}}</span>

                </div>
            </div>
          </div>
        </div><!--fin card cell4-->
        <div class="col-lg-6 col-md-6 col-sm-6"><!--inicio card SharedField-->
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i><!--icono-->
              </div>
              <p class="card-category">Clientes</p>
              <h3 class="card-title">3
                <small>Tipos de Clientes</small>
              </h3>

            </div>
            <div class="card-footer">
              <div class="stats">
                Fecha Ultima Actualizacion:<span class="badge badge-success">{{$fecha}}</span>
              </div>
            </div>
          </div>
        </div><!--fin card SharedField-->
        {{-- <div class="col-lg-3 col-md-6 col-sm-6"><!--inicio card SharedField-->
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
        </div><!--fin card ibs--> --}}
      </div>

      {{-- segunda fila --}}
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6"><!--inicio card cell4-->
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i><!--icono-->
              </div>
              <p class="card-category">Cliente Individuo</p>
              <h3 class="card-title">@foreach ($query2 as $item)
                  {{ $item->count }}
              @endforeach
                <small>Documentos Registrados</small>
              </h3>
            </div>
            <div class="card-footer">
                <div class="stats">

                    Fecha Ultima Actualizacion:<span class="badge badge-success">{{$fecha}}</span>

                </div>
            </div>
          </div>
        </div><!--fin card cell4-->
        <div class="col-lg-4 col-md-6 col-sm-6"><!--inicio card SharedField-->
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i><!--icono-->
              </div>
              <p class="card-category">Cliente Corporativo</p>
              <h3 class="card-title">@foreach ($query3 as $item)
                {{ $item->count }}
            @endforeach
                <small>Documentos Registrados</small>
              </h3>

            </div>
            <div class="card-footer">
              <div class="stats">
                Fecha Ultima Actualizacion:<span class="badge badge-success">{{$fecha}}</span>
              </div>
            </div>
          </div>
        </div><!--fin card SharedField-->
        <div class="col-lg-4 col-md-6 col-sm-6"><!--inicio card SharedField-->
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">view_carousel</i>
              </div>
              <p class="card-category">Cliente Individuo - Penciionado</p>
              <h3 class="card-title">@foreach ($query4 as $item)
                {{ $item->count }}
            @endforeach
                <small>Documentos Registrados</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                Fecha Ultima Actualizacion:<span class="badge badge-success">{{$fecha}}</span>
              </div>
            </div>
          </div>
        </div><!--fin card SharedField-->

      </div>

      {{-- Inicio de las tablas --}}
      <div class="row">
        <div class="col-lg-4 col-md-12"><!--Inicio tabla Cliente Individuo-->
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Documentos para Cliente Individuo</h4>
              <p class="card-category">Total 35 documentos</p>
              <div class="add-ruta">
                <i class="material-icons icon ">add_circle_outline</i>
              </div>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-danger">
                    <th><strong>Descripción</strong></th>
                </thead>
                <tbody>
                @foreach ($query5 as $item )
                    <tr>
                    <td>{{ $item->doc_name }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div><!--Fin tabla Cliente Individuo-->

        <div class="col-lg-4 col-md-12"><!--Inicio tabla Cliente Corporativo-->
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Documentos para Cliente Corporativo</h4>
                <p class="card-category">Total 30 documentos</p>
                <div class="add-ruta">
                    <i class="material-icons icon ">add_circle_outline</i>
                  </div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-danger">
                  <th><strong>Descripción</strong></th>
                  </thead>
                  <tbody>
                    @foreach ($query6 as $item )
                        <tr>
                        <td>{{ $item->doc_name }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div><!--Fin tabla Cliente Corporativo-->

        <div class="col-lg-4 col-md-12"><!--Inicio tabla Cliente Individuo - Pencionado-->
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Documentos para Cliente Individuo - Pencionado</h4>
                <p class="card-category">Total 8 doccumentos</p>
                <div class="add-ruta">
                    <i class="material-icons icon ">add_circle_outline</i>
                  </div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-danger">
                  <th><strong>Descripción</strong></th>

                  </thead>
                  <tbody>
                    @foreach ($query7 as $item )
                        <tr>
                        <td>{{ $item->doc_name }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div><!--Fin tabla Cliente Individuo - Pencionado-->
      </div><!--FIN DE LAS TABLAS-->
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
