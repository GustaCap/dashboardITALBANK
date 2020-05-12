<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Archivo;
Use App\Tipocliente;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Documentidscannedmod;
use App\Documentroutemod;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;


// use App\Exceptions\Handler;

class DocumentController extends Controller
{

    public function consultaGeneral()
    {
        $archivos = Archivo::All();
        // dd($archivos);
        return view('pages.searchDocID', compact('archivos'));
        # code...
    }

    public function consultar_backup(Request $request)
    {
        // Validacion de campo id para que no sea vasio ......................................

        $validate = \Validator::make($request->all(), [

            'id' => 'required|numeric',
        ]);

        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        // fin de la validación ..............................................................


        $id= $request -> id;

        try {

            $query = "select * from dolgram.documentroutemod INNER JOIN dolgram.documentidscannedmod ON dolgram.documentroutemod.id_tipo_doc = dolgram.documentidscannedmod.id_doc and dolgram.documentidscannedmod.documentid = '$id'";

        } catch (Exception $e) {

            report($e);

            return false;
        }


        // $query = "select * from dolgram.documentidscannedmod where documentid = '$id'";
        $query = DB::connection('italsis')->select($query);

        if ($query==NULL) {

            abort(404);

        }

        // ************************************************************************************************************/
        // Generar tipo de cliente de acuerdo con la cadena de caracteres contenia en el paht

        $tipo1 = '/1/1.'; // Cliente Individuo
        $tipo2 = '/2/2.'; // Cliente Corporativo
        $tipo3 = '/3/3.'; // Cliente Individuo - Pensionado

        foreach ($query as $item) {

            // Esta variable almacena la ruta completa del documento consultado por el usuario
            $cadena = $item->path;
            # code...
        }

        $cadenatipo1 = Str::contains($cadena, $tipo1);
        if ($cadenatipo1) {

            $tipoCliente = 'Cliente Individuo';
            # code...
        }

        $cadenatipo2 = Str::contains($cadena, $tipo2);
        if ($cadenatipo2) {

            $tipoCliente = 'Cliente Corporativo';
            # code...
        }

        $cadenatipo3 = Str::contains($cadena, $tipo3);
        if ($cadenatipo3) {

            $tipoCliente = 'Cliente Individuo - Pensionado';
            # code...
        }

        //******************************************************************************************************************/


        return view('pages.dni', ['query' => $query],['tipoCliente' => $tipoCliente] );

    }


    public function fechaRegistro(Request $request)
        {
             // Validacion de campo id para que no sea vasio ......................................

        $validate = \Validator::make($request->all(), [

            'fecha' => 'required',
        ]);

        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        // fin de la validación ..............................................................

        $fecha= $request -> fecha;
        $newDate = date("Ymd", strtotime($fecha));

        $fecha2 = $newDate + 1;

        $pr = strlen($newDate);

        try {

            $query = "select * from dolgram.documentroutemod INNER JOIN dolgram.documentidscannedmod ON dolgram.documentroutemod.id_tipo_doc = dolgram.documentidscannedmod.id_doc and dolgram.documentidscannedmod.uploaddate between '$newDate' and '$fecha2'";

        } catch (Exception $e) {

            report($e);

            return false;
        }

        // $query = "select * from dolgram.documentidscannedmod where documentid = '$id'";
        $query = DB::connection('italsis')->select($query);

        foreach ($query as $key) {

            $c = $key->uploaddate;

            // dd($c);
            # code...
        }
        // $fecha = Carbon($c);
        $f1 = Carbon::now();
        if ($c > $f1) {

            dd('vencido', $c, $f1);
            # code...
        }else {
            dd('es menor y esta vencido');
        }

        // dd($c);

        }

    public function getClienteINDbackup()
    {

        // $query1 = "select * from clientes where tipocliente_id = '1'";
        $query2 = "select * from raices where tipocliente_id = '1' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataRaices = DB::connection('italdocv5')->select($query2);
        return view('pages.getClienteIND', ['dataRaices' => $dataRaices]);


        // dd($dataCliente);
    }

    public function getClienteIND()
    {

        $query1 = "select * from clientes where tipocliente_id = '1'";
        $query2 = "select * from raices where tipocliente_id = '1' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataClientes = DB::connection('italdocv6')->select($query1);
        $dataRaices = DB::connection('italdocv6')->select($query2);
        // return view('pages.getClienteIND',['dataClientes' => $dataClientes], ['dataRaices' => $dataRaices]);
        return view('pages.getClienteIND')->with('dataClientes', $dataClientes)->with('dataRaices', $dataRaices);


        // dd($dataCliente);
    }



    public function getClienteCEBackup()
    {

        // $tipoCliente = Tipocliente::all();
        // $query1 = "select * from clientes where tipocliente_id = '2'";
        $query2 = "select * from raices where tipocliente_id = '2' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataRaices = DB::connection('italdocv5')->select($query2);
        return view('pages.getClienteCE', ['dataRaices' => $dataRaices]);

    }

    public function getClienteCE()
    {

        $query1 = "select * from clientes where tipocliente_id = '2'";
        $query2 = "select * from raices where tipocliente_id = '2' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataClientes = DB::connection('italdocv6')->select($query1);
        $dataRaices = DB::connection('italdocv6')->select($query2);
        // return view('pages.getClienteIND',['dataClientes' => $dataClientes], ['dataRaices' => $dataRaices]);
        return view('pages.getClienteCE')->with('dataClientes', $dataClientes)->with('dataRaices', $dataRaices);

    }

    public function getClienteCB()
    {

        $query1 = "select * from clientes where tipocliente_id = '3'";
        $query2 = "select * from raices where tipocliente_id = '3' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataClientes = DB::connection('italdocv6')->select($query1);
        $dataRaices = DB::connection('italdocv6')->select($query2);
        // return view('pages.getClienteIND',['dataClientes' => $dataClientes], ['dataRaices' => $dataRaices]);
        return view('pages.getClienteCB')->with('dataClientes', $dataClientes)->with('dataRaices', $dataRaices);

    }

    public function getClienteCM()
    {

        $query1 = "select * from clientes where tipocliente_id = '4'";
        $query2 = "select * from raices where tipocliente_id = '4' ";
        // $dataCliente = DB::connection('italdocv2')->select($query1);
        $dataClientes = DB::connection('italdocv6')->select($query1);
        $dataRaices = DB::connection('italdocv6')->select($query2);
        // return view('pages.getClienteIND',['dataClientes' => $dataClientes], ['dataRaices' => $dataRaices]);
        return view('pages.getClienteCM')->with('dataClientes', $dataClientes)->with('dataRaices', $dataRaices);

    }


    // public function postClienteFiles(Request $request)
    // {

    //     $this->validate($request, [

    //         'file.*' => 'required|mimes:doc,docx,pdf,txt,png,jpg,jpeg,csv,gif|max:2048'
    //     ]);

    //     if ($request->hasfile('file')) {


    //         $file = $request->file('file');

    //         $numCuenta = $request->numCuenta;
    //         //  dd($numCuentacliente);

    //         $nombre = $file->getClientOriginalName();
    //         // $nombreimage = date('Y-m-d').'_'.$cliente_id.'_'.$nombre;
    //         $nombreimage = date('Y-m-d').'_'.$numCuenta.'_'.$nombre;

    //         $carpeta = $request->carpeta;

    //         $ruta = public_path().'/'.$carpeta;

    //         $file->move($ruta, $nombreimage);
    //     }

    //     $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

    //     $data = Archivo::create([

    //         // 'cliente_id' => $cliente_id,
    //         'nombreArchivo' => $nombre,
    //         'numCuenta' => $numCuenta,
    //         'file' =>  $rutaFinal

    //         ]);

    //     $data->save();
    //     return redirect()->back()->with('status', 'Carga successfully');

    // }

    public function getSharedFile()
    {
        $dirBase = 'sharedfile';

        $fileGroup1 = array_slice(scandir($dirBase), 2);

        $longitud = count($fileGroup1);

        for($i=0; $i<$longitud; $i++)
        {

	        $directorios[] = $fileGroup1[$i];

        }

        // dd($directorios);

      return view('pages.prueba')->with('directorios',  $directorios);

    }

    public function prueba()
    {
        $nu = 200004132;

    $client = new Client();
    // $client->setDefaultOption('verify', false);
    $response = $client->request('GET', 'https://64.135.7.40/api/Customer?AccountNumber='.$nu, ['verify' => false]);

    // $xml = $response->getBody()->getContents();

    $xml = simplexml_load_string($response->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
    $json = json_encode($xml);

    dd($json);

    }

    /**
     * PRUEBA PARA CARGA DE DOCUMENTO CON FECHA DE EXPIRACION
     */

    public function postClienteFiles(Request $request)
    {

        $this->validate($request, [

            // 'numCuenta' => 'required',
            'file.*' => 'required|mimes:doc,docx,pdf,txt,png,jpg,jpeg,csv,gif|max:2048',
            // 'carpeta' => 'required'
        ]);

        /**
         * Validacion para documentos que tengas fecha de expiracion.
         * ****************************************************************************************************
         */
        $carpeta = $request->carpetas;
         

        // $query = "select fec_expiracion from raices where carpeta_raiz = '$carpeta'";

        // $validaFecha = DB::connection('italdocv5')->select($query);

        //print_r($carpeta);
        // dd($carpeta, $validaFecha);

        //  foreach ($validaFecha as $item) {

        //     if ($item->fec_expiracion == 1) {

        //          $this->validate($request, [

        //               'fecExpira' => 'required'
        //           ]);

        //      }

        // }
         /**
         * Fin de la validacion de fecha de Expiracion
         * ****************************************************************************************************
         */

        if ($request->hasfile('file')) {


            $file = $request->file('file');

            $numCuenta = $request->numCuenta;
            $query1 = "select * from clientes where n_cuenta = '$numCuenta' ";
            $datotipocliente = DB::connection('italdocv6')->select($query1);
            foreach ($datotipocliente as $item) {

                $cliente_id = $item->id;

                if ($item->tipocliente_id == 1) {
    
                     $tipocliente = 1;
    
                 }
                 if ($item->tipocliente_id == 2) {
    
                    $tipocliente = 2;
   
                }
                if ($item->tipocliente_id == 3) {
    
                    $tipocliente = 3;
   
                }
                if ($item->tipocliente_id == 4) {
    
                    $tipocliente = 4;
   
                }
    
            }
            // $datacliente = DB::connection('italdocv6')->select($query1);
            // dd('$datacliente');
            //$tipocliente = $request->tipocliente;
            $fecEmitido = $request->fecEmitido;
            $fecExpira = $request->fecExpira;

            $nombre = $file->getClientOriginalName();
            // $nombreimage = date('Y-m-d').'_'.$cliente_id.'_'.$nombre;
            $nombreimage = date('Y-m-d').'_'.$numCuenta.'_'.$nombre;

            $ruta = public_path().'/'.$carpeta;
            // $ruta = storage_path().'/'.$carpeta;

            $file->move($ruta, $nombreimage);
        }

        $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

        $data = Archivo::create([

            'cliente_id' => $cliente_id,
            
            'tipo_cliente' => $tipocliente,
            'name_archivo' => $nombre,
            'n_cuenta' => $numCuenta,
            'fecha_emitido' => $fecEmitido,
            'fecha_vence' => $fecExpira,
            'file' =>  $rutaFinal

            ]);

        $data->save();
        $output = array(
            'success' => 'Carga successfully',
            // 'image'  => '<img src="/dashboard/public/'.$rutaFinal.'" class="img-thumbnail" />'
           );
   
           return response()->json($output);
        // return redirect()->back()->with('status', 'Carga successfully')->withInput($request->input());

    }
    
    public function postClienteFiles_backup(Request $request)
    {

        $this->validate($request, [

            'file.*' => 'required|mimes:doc,docx,pdf,txt,png,jpg,jpeg,csv,gif|max:2048'
        ]);

        /**
         * Validacion para documentos que tengas fecha de expiracion.
         * ****************************************************************************************************
         */
        $carpeta = $request->carpetas;

        $query = "select fec_expiracion from raices where carpeta_raiz = '$carpeta'";

        $validaFecha = DB::connection('italdocv5')->select($query);

         foreach ($validaFecha as $item) {

            if ($item->fec_expiracion == 1) {

                 $this->validate($request, [

                      'fecExpira' => 'required'
                  ]);

             }

        }
         /**
         * Fin de la validacion de fecha de Expiracion
         * ****************************************************************************************************
         */

        if ($request->hasfile('file')) {


            $file = $request->file('file');

            $numCuenta = $request->numCuenta;
            $tipocliente = $request->tipocliente;
            $fecEmitido = $request->fecEmitido;
            $fecExpira = $request->fecExpira;

            $nombre = $file->getClientOriginalName();
            // $nombreimage = date('Y-m-d').'_'.$cliente_id.'_'.$nombre;
            $nombreimage = date('Y-m-d').'_'.$numCuenta.'_'.$nombre;

            $ruta = public_path().'/'.$carpeta;

            $file->move($ruta, $nombreimage);
        }

        $rutaFinal = '/'.$carpeta.'/'.$nombreimage;

        $data = Archivo::create([

            'tipo_cliente' => $tipocliente,
            'nombre_archivo' => $nombre,
            'num_cuenta' => $numCuenta,
            'fec_emitido' => $fecEmitido,
            'fec_expira' => $fecExpira,
            'file' =>  $rutaFinal

            ]);

        $data->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }




}
