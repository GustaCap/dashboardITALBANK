<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\DB;
use App\Tipocliente;
use App\Cliente;
use App\Archivo;
use App\Raiz;
use App\Usuario;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Documentidscannedmod;
use App\Documentroutemod;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class HistoricoController extends Controller
{

    public function index(Request $request, $user)
    {

        // $query = "select * from dolgram.documentidscannedmod where documentid = '11413'";
        // $prueba = DB::connection('italsis')->select($query);
        // return $prueba;
        $usuario = $user;
        return view('pages.getHistorico')->with('usuario', $usuario);

    }

    public function show(Request $request)
    {
        // dd( $request->cliente_id_itbk);
        $queryCliente = "select * from clientes where cliente_id_itbk = '$request->cliente_id_itbk'";
        $cliente = DB::connection('italdocv6')->select($queryCliente);
        // dd($cliente);
        // $cliente = Cliente::where('cliente_id_itbk', $request->cliente_id_itbk);

        $query = "select * from dolgram.documentidscannedmod where documentid = '$request->cliente_id_itbk'";
        $data = DB::connection('italsis')->select($query);
        // return view('pages.historicos')->with('Cliente', $Cliente)->with('data', $data);
        return view('pages.historicos', compact('cliente', 'data'));

    }

}
