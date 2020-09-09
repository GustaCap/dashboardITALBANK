<?php

namespace App\Http\Controllers;

use App\User;
use App\Tipocliente;
use App\Raiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Documentidscannedmod;
use App\Documentroutemod;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class ApiController extends Controller
{

    public function tipoClientes()
    {
        return response()->json([
            'data' => Tipocliente::all()->map(function ($tipocliente)
            {
                return [
                    'type' => 'Tipo de Cliente',
                    'id'   => (string) $tipocliente->getRouteKey(),
                    'attributes' => [
                        'tipo' => $tipocliente->tipo
                    ],
                    'links' => [
                        'self' => '{{baseUrl}}/cliente/tipo/'.$tipocliente->getRouteKey()
                    ]
                ];
            })
        ]);
    }

    public function tipoClienteid($id)
    {

        $tipoclienteid = Tipocliente::find($id);
        // return response()->json($tipos, 200);
        return response()->json([
            'data' =>  [
                    'type' => 'Tipo de Cliente',
                    'id'   => (string) $tipoclienteid->getRouteKey(),
                    'attributes' => [
                        'tipo' => $tipoclienteid->tipo
                    ],
                ]
        ]);
    }

    public function productos()
    {

        $productosBase = Raiz::where('nivel_relacion', 'producto')->where('tipo_carpeta', 'base')->get();
        return response()->json([
            'data' => $productosBase->map(function ($productos)
            {
                return [
                    'type' => 'Productos',
                    'id'   => (string) $productos->getRouteKey(),
                    'attributes' => [

                        'carpeta_raiz' => $productos->carpeta_raiz,
                        'nivel_relacion' => $productos->nivel_relacion,
                        'fec_expiracion' => $productos->fec_expiracion,
                        'tipocliente_id' => $productos->tipocliente_id,
                        'requerido' => $productos->requerido,
                        'frecuencia' => $productos->frecuencia,
                        'nombre_doc' => rtrim($productos->nombre_doc),
                        'nivel' => $productos->nivel,
                        'tipo_carpeta' => rtrim($productos->tipo_carpeta),
                        'created_at' => $productos->created_at,
                        'updated_at' => $productos->updated_at

                    ],
                    'links' => [
                        'end point' => '{{baseUrl}}/producto/'.$productos->getRouteKey(),
                        'self' => route('api.v1.0.producto.id', $productos->getRouteKey())
                    ]
                ];
            })
        ]);


    }

    public function productoid($id)
    {
        $productoid = Raiz::find($id);
        return response()->json([
            'data' =>  [
                    'type' => 'Producto',
                    'id'   => (string) $productoid->getRouteKey(),
                    'attributes' => [

                        'carpeta_raiz' => $productoid->carpeta_raiz,
                        'nivel_relacion' => $productoid->nivel_relacion,
                        'fec_expiracion' => $productoid->fec_expiracion,
                        'tipocliente_id' => $productoid->tipocliente_id,
                        'requerido' => $productoid->requerido,
                        'frecuencia' => $productoid->frecuencia,
                        'nombre_doc' => rtrim($productoid->nombre_doc),
                        'nivel' => $productoid->nivel,
                        'tipo_carpeta' => rtrim($productoid->tipo_carpeta),
                        'created_at' => $productoid->created_at,
                        'updated_at' => $productoid->updated_at

                    ],
                ]
        ]);
    }

    public function estructuras()
    {
        $estructuras = Raiz::where('nivel_relacion', 'cliente')->where('tipo_carpeta', 'base')->get();
        return response()->json([
            'data' => $estructuras->map(function ($estructuras)
            {
                return [
                    'type' => 'Estructuras',
                    'id'   => (string) $estructuras->getRouteKey(),
                    'attributes' => [

                        'carpeta_raiz'      => $estructuras->carpeta_raiz,
                        'nivel_relacion'    => $estructuras->nivel_relacion,
                        'fec_expiracion'    => $estructuras->fec_expiracion,
                        'tipocliente_id'    => $estructuras->tipocliente_id,
                        'requerido'         => $estructuras->requerido,
                        'frecuencia'        => $estructuras->frecuencia,
                        'nombre_doc'        => rtrim($estructuras->nombre_doc),
                        'nivel'             => $estructuras->nivel,
                        'tipo_carpeta'      => rtrim($estructuras->tipo_carpeta),
                        'created_at'        => $estructuras->created_at,
                        'updated_at'        => $estructuras->updated_at

                    ],
                    'links' => [
                        'Api' => '{{baseUrl}}/estructura/'.$estructuras->getRouteKey(),
                        'self' => route('api.v1.0.estructura.id', $estructuras->getRouteKey()),
                        'Api documentos' => '{{baseUrl}}/estructura/'.$estructuras->carpeta_raiz.'/documentos'
                    ]
                ];
            })
        ]);
    }

    public function estructuraid($id)
    {
        $estructuraid = Raiz::find($id);
        return response()->json([
            'data' =>  [
                    'type' => 'Estructura',
                    'id'   => (string) $estructuraid->getRouteKey(),
                    'attributes' => [

                        'carpeta_raiz'      => $estructuraid->carpeta_raiz,
                        'nivel_relacion'    => $estructuraid->nivel_relacion,
                        'fec_expiracion'    => $estructuraid->fec_expiracion,
                        'tipocliente_id'    => $estructuraid->tipocliente_id,
                        'requerido'         => $estructuraid->requerido,
                        'frecuencia'        => $estructuraid->frecuencia,
                        'nombre_doc'        => rtrim($estructuraid->nombre_doc),
                        'nivel'             => $estructuraid->nivel,
                        'tipo_carpeta'      => rtrim($estructuraid->tipo_carpeta),
                        'created_at'        => $estructuraid->created_at,
                        'updated_at'        => $estructuraid->updated_at

                    ],
                ]
        ]);
    }

    public function productoDoc($carpeta_raiz)
    {

        $query = "select * from raices where carpeta_raiz like '%$carpeta_raiz/%' and tipo_carpeta = 'subnivel'";
        $documentos = DB::connection('italdocv6')->select($query);
        $collect = collect($documentos);
        return response()->json([
            'data' => $collect->map(function ($productodoc)
            {
                return [
                    'type' => 'Documento',
                    'id'   => (string) $productodoc->id,
                    'attributes' => [

                        'carpeta_raiz'      => $productodoc->carpeta_raiz,
                        'nivel_relacion'    => $productodoc->nivel_relacion,
                        'fec_expiracion'    => $productodoc->fec_expiracion,
                        'tipocliente_id'    => $productodoc->tipocliente_id,
                        'requerido'         => $productodoc->requerido,
                        'frecuencia'        => $productodoc->frecuencia,
                        'nombre_doc'        => rtrim($productodoc->nombre_doc),
                        'nivel'             => $productodoc->nivel,
                        'tipo_carpeta'      => rtrim($productodoc->tipo_carpeta),
                        'created_at'        => $productodoc->created_at,
                        'updated_at'        => $productodoc->updated_at

                    ],
                ];
            })
        ]);
    }

    public function estructuraDoc($carpeta_raiz)
    {
        $query = "select * from raices where carpeta_raiz like '%$carpeta_raiz/%' and tipo_carpeta = 'subnivel'";
        $documentos = DB::connection('italdocv6')->select($query);
        $collect = collect($documentos);
        return response()->json([
            'data' => $collect->map(function ($estructuradoc)
            {
                return [
                    'type' => 'Documento',
                    'id'   => (string) $estructuradoc->id,
                    'attributes' => [

                        'carpeta_raiz'      => $estructuradoc->carpeta_raiz,
                        'nivel_relacion'    => $estructuradoc->nivel_relacion,
                        'fec_expiracion'    => $estructuradoc->fec_expiracion,
                        'tipocliente_id'    => $estructuradoc->tipocliente_id,
                        'requerido'         => $estructuradoc->requerido,
                        'frecuencia'        => $estructuradoc->frecuencia,
                        'nombre_doc'        => rtrim($estructuradoc->nombre_doc),
                        'nivel'             => $estructuradoc->nivel,
                        'tipo_carpeta'      => rtrim($estructuradoc->tipo_carpeta),
                        'created_at'        => $estructuradoc->created_at,
                        'updated_at'        => $estructuradoc->updated_at

                    ],
                ];
            })
        ]);
    }

    public function nivelesdeRelacion()
    {
        return response()->json([
            'data' =>  [
                    'type' => 'Niveles de Relacion',
                    'attributes' => [
                        'opcion1' => 'cliente',
                        'opcion2' => 'producto',
                        'opcion3' => 'transferencia'
                    ],
                ]
        ]);
    }

    public function requerimientos()
    {
        return response()->json([
            'data' =>  [
                    'type' => 'Tipos de Requerimiento',
                    'attributes' => [
                        'opcion1' => 'obligatorio',
                        'opcion2' => 'no obligatorio'
                    ],
                ]
        ]);
    }

    public function fechaExpiracion()
    {
        return response()->json([
            'data' =>  [
                    'type' => 'Atributo para uso de fecha de expiracion',
                    'attributes' => [
                        'opcion1' => 'aplica',
                        'opcion2' => 'no aplica'
                    ],
                ]
        ]);
    }

    public function frecuencia()
    {
        return response()->json([
            'data' =>  [
                    'type' => 'Atributo para la frecuencia de exigencia del documento',
                    'attributes' => [
                        'opcion1' => 'anual',
                        'opcion2' => '2 años',
                        'opcion3' => '3 años',
                        'opcion4' => '4 años',
                        'opcion5' => '5 años',
                        'opcion6' => 'no aplica'
                    ],
                ]
        ]);

    }

    public function pruebalog(Request $request)
    {
        $ip = $request->ip();
        $navegador = $request->header('User-Agent');
        $prueba = $request->server('REMOTE_ADDR');
        dd($ip, $navegador, $request,$prueba);
    }



















    public function tipoDocumentos()
    {

        $tipos = Raiz::all();
        return response()->json($tipos, 200);
    }

    public function cargaDocumentos(Request $request)
    {

        $this->validate($request, [

            'file.*' => 'required|mimes:pdf,png,jpg,jpeg|max:2048',

        ]);

        $numCuenta = $request->numCuenta;
        $precliente_id = $request->precliente_id;
        $cliente_id_itbk = $request->cliente_id_itbk;
        $tipocliente = $request->tipo_cliente;
        $fecEmitido = $request->fecEmitido;
        $fecExpira = $request->fecExpira;
        $usuario = $request->usuario;

        $carpeta = $request->carpetas;
        $query = "select * from raices where carpeta_raiz = '$carpeta'";
        $dataraices = DB::connection('italdocv6')->select($query);
        foreach ($dataraices as $item)
        {
             $raiz_id = $item->id;
             $nombreinicial = $item->nombre_doc;
             $nombrefinal = trim($nombreinicial);
        }
        if ($request->hasfile('file')) {


            $file = $request->file('file');

            //Pruebas para cambiar el nombre de la imagen
            //**************************************************************************************************/

                $ext = $file->getClientOriginalExtension();
                $nombreimage = 'API_'.$nombrefinal.'.'.$ext;
                //$nombreimage = $nombree.'_'.$nombre;

            //**************************************************************************************************/

            $ruta = public_path().'/'.$carpeta;
            $file->move($ruta, $nombreimage);
        }

        $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

        $data = Archivo::create([

            'precliente_id'     => $precliente_id,
            'cliente_id_itbk'   => $cliente_id_itbk,
            'raiz_id'           => $raiz_id,
            'tipo_cliente'      => $tipocliente,
            'name_archivo'      => $nombrefinal,
            'n_cuenta'          => $numCuenta,
            'fecha_emitido'     => $fecEmitido,
            'fecha_vence'       => $fecExpira,
            'file'              => $rutaFinal,
            'estatus_doc'       => 1,
            'usuario'           => $usuario

            ]);

        $data->save();
        return response()->json($data, 200);

    }

    public function documentosTipocliente($id)
    {
        $tipos = Raiz::all()->where('tipocliente_id', $id);
        return response()->json($tipos, 200);

    }


}
