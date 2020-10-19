<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Archivo;
use App\Cliente;

/**
 * Agregado para manejo del API. servicio web que trae los clientes
 * URI: http://10.200.0.46:4438/api/v1/CustomerInfo
 */
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;

/**
 * Agregado para manejo de Cache
*/
use Illuminate\Support\Facades\Cache;


class TransferenciaController extends Controller
{

    public function index(Request $request, $user)
    {
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;

        /**
         * Cache::remember
         * para manejo de cache y minimizar el tiempo de consulta del servicio web
         */
        $clientes = Cache::remember('clientes', 60, function () {

            $client = new Client([
                'base_uri' => 'http://10.200.0.46:4438/api/v1/'
            ]);
            $response = $client->request('POST', 'CustomerInfo');
            $json = json_decode($response->getBody()->getContents());
            return $json;

        });

        $query = "select * from raices where nivel_relacion = 'transferencia' and tipo_carpeta = 'subnivel'";
        $dataRaices = DB::connection('italdocv6')->select($query);
        return view('pages.getCargarTransferencia')->with('usuario', $usuario)->with('clientes', $clientes)->with('dataRaices', $dataRaices);
        # code...
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'file.*' => 'required|mimes:pdf,png,jpg,jpeg|max:2048',

        ]);

        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);
        $response = $client->request('POST', 'CustomerInfo', ['json' => ['param' => $request->cliente_id_itbk]]);
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $item) {
            $cliente_id_itbk = $item->IDCLIENTE;
            $clasificacion = $item->Clasificacion;
            $n_cuenta = $item->CUENTA;
        }
        $querydata= "select * from tipoclientes where tipo = '$clasificacion'";
        $result = DB::connection('italdocv6')->select($querydata);
        foreach ($result as $item) {
            $tipocliente = $item->id;
        }

        $carpeta = $request->nombredoc;

        $query = "select * from raices where carpeta_raiz like '%$carpeta%'";
        $dataraices = DB::connection('italdocv6')->select($query);
        foreach ($dataraices as $item) {
             $raiz_id = $item->id;
             $nombreinicial = $item->nombre_doc;
             $nombrefinal = trim($nombreinicial); /**Elimino los espacios en blanco con trim() */
             $nivel_relacion = $item->nivel_relacion;
        }

        if ($request->hasfile('file')) {

            $file = $request->file('file');
            $numeroTransfer = $request->transfer;
            $ext = $file->getClientOriginalExtension();
            $nombreimage = $nombrefinal.'.'.$ext;
            $ruta = public_path().'/'.$carpeta;
            $file->move($ruta, $nombreimage);

        }

            $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

            $data = Archivo::create([

                'cliente_id_itbk'   => $cliente_id_itbk,
                'tipo_cliente'      => $tipocliente,
                'n_cuenta'          => $n_cuenta,
                'raiz_id'           => $raiz_id,
                'name_archivo'      => $nombreimage,
                'n_transfer'        => $numeroTransfer,
                'file'              =>  $rutaFinal,
                'estatus_doc'       => 1,
                'usuario'           => $request->usuario,
                'via_payment'       => $request->viaPayment,
                'channel'           => $request->channel,
                'cuenta_bene'       => $request->cuenta_bene,
                'nombre_bene'       => $request->nombre_bene,
                'banco_bene'        => $request->banco_bene,
                'proposito'         => $request->proposito,
                'nivel_relacion'    =>$nivel_relacion

            ]);

        $data->save();
        return redirect()->back()->with('status', 'Carga successfully')->withInput($request->input());

    }

    public function show(Request $request, $user)
    {

        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $query = "select id, n_transfer, name_archivo, file, usuario, created_at from archivos";
        $data = DB::connection('italdocv6')->select($query);

        return view('pages.getListarTransferencias')->with('data', $data)->with('usuario', $usuario);

    }

    public function eliminarDocumento(Request $request, $id, $user)
    {

        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $query =    "update archivos
                    set estatus_doc = '2', usuario = '$usuario'
                    where id = '$id'";

        $result = DB::connection('italdocv6')->select($query);

        return redirect()->back()->with('status', 'Documento Eliminado successfully');

    }

    public function docEliminados(Request $request)
    {
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $data = Archivo::all()->where('estatus_doc', 2);

        return view('pages.audilog')->with('data', $data);

    }



}
