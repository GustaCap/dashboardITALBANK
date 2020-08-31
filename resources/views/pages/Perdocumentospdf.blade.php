

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>DOCUMENTOS</title>
        <style>
        h3{
        text-align: center;
        text-transform: uppercase;
        font-size: 1rem;
        }
        h4{
        text-align: center;
        text-transform: uppercase;
        font-size: 1rem;
        }
        tr{
            text-align: center;
        }
        p{
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .contenido{
        font-size: 0.6rem;
        }
        #primero{
        background-color: #ccc;
        }
        #segundo{
        color:#44a359;
        }
        #tercero{
        text-decoration:line-through;
        }
        .table-sm th, .table-sm td
        {
            padding: 0.4rem;
        }
        .table
        {
            width: 100%;
            margin-bottom: 1rem;
            line-height: 1.1;
        }
    </style>
    </head>
    <body>
        <div class="container-fluid">
            <h3>Reporte de Documentos Cargados</h3>
            <h3>Fecha: {{ $fechaini }} - {{ $fechafin }}</h3>
            <h3>Generado por: {{ $usuario }}</h3>
        {{-- <h1>{{ $title }}</h1> --}}
        <hr>
        <div class="contenido">
            @foreach ($dataCliente as $item)
            <p>Nombre: {{ $item->nombre }}</p>
            <p>DNI: {{ $item->dni }}</p>
            <p>ID Italbank: {{ $item->cliente_id_itbk }}</p>
            @endforeach
        <hr>
            <table class="table table-striped table-sm table-bordered">
                <thead >
                  <tr>
                    <th>ID Cliente Italbank</th>
                    <th>Tipo de Cliente</th>
                    {{-- <th>Cuenta Italbank</th> --}}
                    <th>Estructura</th>
                    <th>Documento</th>
                    <th>Vencimiento</th>
                    <th>Cargado</th>
                    <th>Usuario</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($data as $item)
                    <tr>
                    <td valign="middle" class="text-center">{{ $item->cliente_id_itbk }}</td>
                    <td valign="middle">{{ $item->tipo_cliente}}</td>
                    {{-- <td valign="middle">{{ $item->n_cuenta}}</td> --}}
                    <td valign="middle">{{ $item->file }}</td>
                    <td valign="middle">{{ $item->name_archivo }}</td>
                    <td valign="middle">{{ $item->fecha_vence }}</td>
                    <td valign="middle">{{ $item->created_at }}</td>
                    <td valign="middle">{{ $item->usuario }}</td>
                </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>

