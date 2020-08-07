<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Archivo;

class AudilogController extends Controller
{

    public function docEliminados(Request $request)
    {
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $data = Archivo::all()->where('estatus_doc', 2);
        return view('pages.audilog')->with('data', $data);
        // dd($data);
    }

    

}