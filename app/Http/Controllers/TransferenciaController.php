<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;
use App\Archivo;
use App\Cliente;

class TransferenciaController extends Controller
{

    public function index(Request $request, $user)
    {
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $clientes = Cliente::all();
        $query = "select * from raices where nivel_relacion = 'transferencia'";
        $dataRaices = DB::connection('italdocv6')->select($query);
        return view('pages.getCargarTransferencia')->with('usuario', $usuario)->with('clientes', $clientes)->with('dataRaices', $dataRaices);
        # code...
    }

    public function store(Request $request)
    {



        $this->validate($request, [

            'file.*' => 'required|mimes:doc,docx,pdf,txt,png,jpg,jpeg,csv,gif|max:2048',

        ]);

        $querycliente = "select * from clientes where n_cuenta = '$request->numCuenta'";
        $data = DB::connection('italdocv6')->select($querycliente);
        foreach ($data as $item) {
            $cliente_id_itbk = $item->cliente_id_itbk;
            $tipocliente = $item->tipocliente_id;
            $n_cuenta = $item->n_cuenta;
        }

        // $carpeta = 'Transferencias';
        $carpeta = $request->nombredoc;
        $query = "select * from raices where carpeta_raiz = '$carpeta'";
        $dataraices = DB::connection('italdocv6')->select($query);
        foreach ($dataraices as $item) {
             $raiz_id = $item->id;
             $nombreinicial = $item->nombre_doc;
             $nombrefinal = trim($nombreinicial); /**Elimino los espacios en blanco con trim() */
        }

        if ($request->hasfile('file')) {


            $file = $request->file('file');
            $numeroTransfer = $request->transfer;
            // $documento = $request->nombredoc;

            $ext = $file->getClientOriginalExtension();
            $nombreimage = $nombrefinal.'.'.$ext;
            $ruta = public_path().'/'.$carpeta;
            $file->move($ruta, $nombreimage);

        }

            $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

            $data = Archivo::create([

                'cliente_id_itbk' => $cliente_id_itbk,
                'tipo_cliente' => $tipocliente,
                'n_cuenta' => $n_cuenta,
                'raiz_id' => $raiz_id,
                'name_archivo' => $nombreimage,    //comentado por canbios 13/05/2020
                'n_transfer' => $numeroTransfer,
                'file' =>  $rutaFinal,
                'estatus_doc' => 1,
                'usuario' => $request->usuario,
                'via_payment' => $request->viaPayment,
                'channel' => $request->channel,
                'cuenta_bene' => $request->cuenta_bene,
                'nombre_bene' => $request->nombre_bene,
                'banco_bene' => $request->banco_bene,
                'proposito' => $request->proposito

            ]);

        $data->save();
        return redirect()->back()->with('status', 'Carga successfully')->withInput($request->input());


        # code...
    }

    public function show(Request $request, $user)
    {

        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $query = "select id, n_transfer, name_archivo, file, usuario, created_at from archivos";
        $data = DB::connection('italdocv6')->select($query);
        return view('pages.getListarTransferencias')->with('data', $data)->with('usuario', $usuario);


        # code...
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
        // dd($data);
    }



}
