@extends('layouts.app', ['activePage' => 'getHistorico', 'titlePage' => __('Historicos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
          <form method="POST" action="{{ route('historico.italdocumentos') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input name="usuario" value="{{ $usuario }}" hidden>
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Historicos Italdocumentos') }}</h4>
                <p class="card-category">{{ __('Historicos') }}</p>
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
                @if (session('warning'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('warning') }}</span>
                      </div>
                    </div>
                  </div>
                @endif


                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Cliente id') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" id="cliente_id_itbk" name = "cliente_id_itbk" class="form-control">
                      </div>
                    </div>
                  </div>



                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary mb-4">{{ __('Consultar') }}</button>
                </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
//Select Dinamico
$(document).ready(function() {
    $('.seleccion').select2();
});
</script>
@endpush
@endsection
