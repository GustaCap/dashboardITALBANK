<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Cliente;
use App\Raiz;
use App\Tipocliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;

class ClienteController extends Controller
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
        return view('pages.getRegistroCliente')->with('tipocliente', $tipocliente);
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
        //
        $this->validate($request, [

            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'email' => 'required|email',
            'tipocliente_id' => 'required'
        ]);

        if (empty($request->cliente_id_itbk) && empty($request->n_cuenta) ) {

            return redirect()->back()->with('warning', 'Debe cargar el Id del Cliente ITALBANK o su Número de Cuenta')->withInput($request->input());
           
            # code...
        }

        $datacliente = Cliente::create([

            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'email' => $request->email,
            'tipocliente_id' => $request->tipocliente_id,
            'cliente_id_itbk' =>  $request->cliente_id_itbk,
            'n_cuenta' =>  $request->n_cuenta,

            ]);

        $datacliente->save();
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
        $dataCliente = Cliente::all();
        return view('pages.getlistarCliente')->with('dataCliente', $dataCliente);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clienteDetalle($id)
    {
        $cliente = Cliente::with('archivos')->find($id);

        // // dd($cliente);


        $tipoCliente = $cliente->tipocliente_id;

        $query = "select * from raices where tipocliente_id = '$tipoCliente'";
        $result = DB::connection('italdocv6')->select($query);

        $array = Arr::pluck($result, 'id');
        //dd($array);

        // if (in_array('CE Planillas de Verificacion de Requisitos', $result)) {
        //     echo 'si esta';
        // }
       

        // $total = Count($result);

        //$r = Str::contains('/CE Planillas de Verificacion de Requisitos/2020-05-08_12548796321510_JPG.jpg', 'CE Planillas de Verificacion de Requisitos');
        //$r = Str::containst
       //dd($r);

        //dd($cliente, $tipoCliente, $result, $total);

        // $archivos = Archivo::All();






        // return view('pages.getConsultaCliente', compact('cliente', 'result'));
        return view('pages.getConsultaCliente', compact('cliente', 'array'));
    }

    public function clienteDetalleBackup($id)
    {
        $cliente = Cliente::with('archivos')->find($id);
        return view('pages.getConsultaCliente', compact('cliente'));
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
}
