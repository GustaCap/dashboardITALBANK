<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\DB;
use App\Tipocliente;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TipoclienteController extends Controller
{

    public function index(Request $request, $user)
    {
        $ip = $request->ip();
        $usuario = $user;
        $navegador = $request->header('User-Agent');
        $tipocliente = Tipocliente::all()->where('estatus', '1');
        return view('pages.getCrearTipocliente')->with('tipocliente', $tipocliente)->with('usuario', $usuario);

    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'tipo' => 'required'
        ]);

        $dataTipocliente = Tipocliente::create([

            'tipo' => $request->tipo,
            'estatus' => 1,
            'usuario' => $request->usuario

            ]);

        $dataTipocliente->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }

    public function eliminartipocliente($id, $usuario)
    {
        $query = "update
                    tipoclientes
                    set estatus = '2', usuario = '$usuario'
                    where id = '$id'";
        $data = DB::connection('italdocv6')->select($query);
        return redirect()->back()->with('status', 'Delete successfully');
    }



}
