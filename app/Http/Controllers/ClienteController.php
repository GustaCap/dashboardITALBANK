<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Cliente;
use App\Raiz;
use App\Tipocliente;
use App\Usuario;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
// use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Session;

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

    
    public function show()
    {
        $dataCliente = Cliente::all();
        // $value = Session::get('usuario');
        $value = new Usuario();
        $user = $value->userSesion();
        // $valuess = Str::contains($user, '1');
        // dd($valuess);


        // $users = $this->getUsuariore();
        // $re = array($users);
        // dd($user);
        return view('pages.getlistarCliente')->with('dataCliente', $dataCliente)->with('user', $user);

    }


    public function clienteDetalle($id)
    {

        // $cliente = Cliente::with('archivos')->find($id);
        $cliente = Cliente::all()->find($id);


        $tipoCliente = $cliente->tipocliente_id;

        $query = "select * from raices where tipocliente_id = '$tipoCliente'";
        $result = DB::connection('italdocv6')->select($query);

        /**Este query devuelve el id de las rutas que tengo cargadas por cliente */
        $query2 = "select raiz_id from archivos where cliente_id = '$id'";
        $result2 = DB::connection('italdocv6')->select($query2);

        $query3 = "select * from archivos where cliente_id = '$id' and estatus_doc = '1'";
        $result3 = DB::connection('italdocv6')->select($query3);



        $array = Arr::pluck($result, 'id');
        $array2 = Arr::pluck($result2, 'raiz_id');
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
        return view('pages.getConsultaCliente', compact('cliente', 'result', 'array', 'array2', 'result3'));
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

    public function getUsuario($id)
    {
        
        $user = $id;
        return $user;
    }

    public function getUsuariore()
    {
        $value = Session::get('usuario');
        // $users = session()->all();
        // return $users;
        return $value;
    }

    // public function tipoClientes()
    // {

    //     $tipos = Tipocliente::all();
    //     return response()->json($tipos, 200);
    // }

    
}
