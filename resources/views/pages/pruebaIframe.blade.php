@extends('layouts.app', ['activePage' => 'getClienteIND', 'titlePage' => __('Carga de Documentos Cliente IND')])

@section('content')
<div class="iframe" style="position:fixed;top:62px; left:0; width:100%; height:100%;" >
    <iframe src="http://10.200.0.78/dashboard/public/crear/estructura/gcamacho" width="100%" height="300"></iframe>
</div>
@endsection
