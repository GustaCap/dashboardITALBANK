<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Documentidscannedmod;
use App\Documentroutemod;

use Carbon\Carbon;

// use App\Exceptions\Handler;

class DocumentController extends Controller
{

    public function consultar(Request $request)
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

            // Validate the value...
            // $query = "select * from dolgram.documentidscannedmod where documentid = '$id'";
            $query = "select * from dolgram.documentroutemod INNER JOIN dolgram.documentidscannedmod ON dolgram.documentroutemod.id_tipo_doc = dolgram.documentidscannedmod.id_doc and dolgram.documentidscannedmod.documentid = '$id'";
            // $query = documentroutemod::join('documentidscannedmod', 'documentidscannedmod.id_doc', '=', 'documentroutemod.id_tipo_doc')->select('documentidscannedmod.*')->get();
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





}
