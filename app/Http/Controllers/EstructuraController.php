<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Archivo;
use App\Raiz;
use App\Tipocliente;
use Illuminate\Support\Facades\Session;

class EstructuraController extends Controller
{
    public function index(Request $request, $user)
    {
        $ip = $request->ip();
        $navegador = $request->header('User-Agent');
        $tipocliente = Tipocliente::all();
        return view('pages.getCrearEstructura')->with('tipocliente', $tipocliente);

    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'tipocliente_id' => 'required',
            'carpeta_raiz' => 'required',
            'nivel_relacion' => 'required',
            // 'requerido' => 'required',
            // 'frecuencia' => 'required',
            // 'fec_expiracion' => 'required'
        ]);

        // $carpeta_raiz = $request->nivel1.'/'.$request->nombre_doc;

        $dataraiz = Raiz::create([

            'tipocliente_id' => $request->tipocliente_id,
            'carpeta_raiz' => $request->carpeta_raiz,
            'tipo_carpeta' => 'base',
            'nivel_relacion' => $request->nivel_relacion,
            // 'fec_expiracion' => $request->fec_expiracion,
            // 'requerido' => $request->requerido,
            // 'frecuencia' =>  $request->frecuencia,
            'nombre_doc' =>  $request->carpeta_raiz

            ]);

        $dataraiz->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }





}
