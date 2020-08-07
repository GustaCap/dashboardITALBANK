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

class ApiController extends Controller
{

    public function tipoClientes()
    {

        $tipos = Tipocliente::all();
        return response()->json($tipos, 200);
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
