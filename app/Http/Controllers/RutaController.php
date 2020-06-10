<?php

namespace App\Http\Controllers;

use App\Raiz;
use App\Tipocliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipocliente = Tipocliente::all();
        // dd($tipocliente);
        return view('pages.getRegistroRuta')->with('tipocliente', $tipocliente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nivel1' => 'required',
            'tipocliente_id' => 'required',
            'nivel_relacion' => 'required',
            'requerido' => 'required',
            'frecuencia' => 'required',
            'fec_expiracion' => 'required',
            'nombre_doc' => 'required'
        ]);

        $carpeta_raiz = $request->nivel1.'/'.$request->nombre_doc;

        $dataraiz = Raiz::create([

            'carpeta_raiz' => $carpeta_raiz,
            'nivel_relacion' => $request->nivel_relacion,
            'fec_expiracion' => $request->fec_expiracion,
            'tipocliente_id' => $request->tipocliente_id,
            'requerido' => $request->requerido,
            'frecuencia' =>  $request->frecuencia,
            'nombre_doc' =>  $request->nombre_doc

            ]);

        $dataraiz->save();
        return redirect()->back()->with('status', 'Carga successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $dataRaices = Raiz::all();
        $user = Session::get('usuario');
        return view('pages.getlistarRuta')->with('dataRaices', $dataRaices)->with('user', $user);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUsuarioro()
    {
        
        $users = session()->all();
        return $users;
    }
}
