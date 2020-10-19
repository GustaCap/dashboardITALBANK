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
        $usuario = $user;
        $navegador = $request->header('User-Agent');
        $tipocliente = Tipocliente::all()->where('estatus', '1');
        return view('pages.getCrearEstructura')->with('tipocliente', $tipocliente)->with('usuario', $usuario);

    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'tipocliente_id' => 'required',
            'carpeta_raiz' => 'required',
            'nivel_relacion' => 'required',
        ]);

        $dataraiz = Raiz::create([

            'tipocliente_id' => $request->tipocliente_id,
            'carpeta_raiz' => $request->carpeta_raiz,
            'tipo_carpeta' => 'base',
            'nivel_relacion' => $request->nivel_relacion,
            'nombre_doc' =>  $request->carpeta_raiz,
            'usuario' => $request->usuario,
            'estatus' => 1

            ]);

        $dataraiz->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }

}
