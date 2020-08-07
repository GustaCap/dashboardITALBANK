<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Tipocliente;
use Illuminate\Support\Facades\Session;

class TipoclienteController extends Controller
{

    public function index(Request $request, $user)
    {
        $ip = $request->ip();
        $navegador = $request->header('User-Agent');
        $tipocliente = Tipocliente::all()->sortBy('tipo');
        return view('pages.getCrearTipocliente')->with('tipocliente', $tipocliente);

    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'tipo' => 'required'
        ]);

        $dataTipocliente = Tipocliente::create([

            'tipo' => $request->tipo

            ]);

        $dataTipocliente->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }



}
