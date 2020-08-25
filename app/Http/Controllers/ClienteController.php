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


    public function show(Request $request, $user)
    {

        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $dataCliente = Cliente::all();
        $usuario = $user;
        // $query = "select distinct nombre, cliente_id_itbk
        // from clientes
        // where tipocliente_id = '$id'
        // order by nombre asc";
        // $dataCliente = DB::connection('italdocv6')->select($query);

        return view('pages.getlistarCliente')->with('dataCliente', $dataCliente)->with('usuario', $usuario);

    }


    public function clienteDetalle(Request $request, $id, $user)
    {

        // $cliente = Cliente::with('archivos')->find($id);
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $cliente = Cliente::all()->find($id);


        $tipoCliente = $cliente->tipocliente_id;
        $cliente_id_itbk = $cliente->cliente_id_itbk;

        $query = "select * from raices where tipocliente_id = '$tipoCliente' order by nivel_relacion asc";
        $result = DB::connection('italdocv6')->select($query);

        /**Este query devuelve el id de las rutas que tengo cargadas por cliente */
        // $query2 = "select raiz_id from archivos where cliente_id = '$id'";
        $query2 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        $result2 = DB::connection('italdocv6')->select($query2);

        // $query3 = "select * from archivos where cliente_id = '$id' and estatus_doc = '1'";
        $query3 = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk' and estatus_doc = '1'";
        $result3 = DB::connection('italdocv6')->select($query3);

        $array = Arr::pluck($result, 'id');
        $array2 = Arr::pluck($result2, 'raiz_id');

        return view('pages.getConsultaCliente', compact('cliente', 'result', 'array', 'array2', 'result3', 'usuario'));
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

    public function clienteItbk(Request $request, $id, $user)
    {
        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;
        $query = "select distinct nombre, cliente_id_itbk
        from clientes
        where tipocliente_id = '$id'
        order by nombre asc";

        $query2 = "select *
                    from raices
                    where tipocliente_id = '$id'
                    and nivel_relacion = 'producto'
                    and tipo_carpeta = 'base'";
        $data = DB::connection('italdocv6')->select($query);
        $data2 = DB::connection('italdocv6')->select($query2);
        return view('pages.getSelectClienteItbk')->with('data', $data)->with('data2', $data2)->with('usuario', $usuario);


    }

    public function postclienteItbk(Request $request)
    {
        $usuario = $request->usuario;
        $cliente_id_itbk = $request->cliente_id_itbk;
        $carpeta_raiz = $request->carpeta_raiz;
        // $nivel_relacion = $request->nivel_relacion;
        $query1 = "select * from clientes where cliente_id_itbk = '$cliente_id_itbk' ";
        $data = DB::connection('italdocv6')->select($query1);
        foreach ($data as $item) {
            $tipocliente_id = $item->tipocliente_id;
            $nombre = $item->nombre;
            $cliente_id_itbk = $item->cliente_id_itbk;
        }
        //Original fecha: 20082020
        // $query2 = "select * from raices
        //             where tipocliente_id = '$tipocliente_id'
        //             and tipo_carpeta not like '%base%'
        //             and nivel_relacion not like '%transferencia%'
        //             order by nivel_relacion asc";

        //Cambio fecha: 20082020
        // $query2 = "select * from raices
        //             where tipocliente_id = '$tipocliente_id'
        //             and tipo_carpeta not like '%base%'
        //             and nivel_relacion between 'cliente' and '$nivel_relacion'
        //             order by nivel_relacion asc";

        // $query2 = "select * from raices
        //             where tipocliente_id = '$tipocliente_id'
        //             and tipo_carpeta not like '%base%'
        //             and nivel_relacion = '$nivel_relacion'
        //             order by nivel_relacion asc";

        $query2 = "select * from raices
                        where tipocliente_id = '$tipocliente_id'
                        and tipo_carpeta = 'subnivel'
					    and nivel_relacion = 'cliente'
                    union
                    select * from raices
                        where tipocliente_id = '$tipocliente_id'
                        and tipo_carpeta = 'subnivel'
					    and nivel_relacion = 'producto'
                        and carpeta_raiz like '%$carpeta_raiz%'";
        $data2 = DB::connection('italdocv6')->select($query2);

        $query3 = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        $data3 = DB::connection('italdocv6')->select($query3);

        //data para comparar con el query3 y saber cuales doc estan cargados
        $query4 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        $data4 = DB::connection('italdocv6')->select($query4);

        //comparacion de ambos arreglos
        $array = Arr::pluck($data2, 'id');
        $array2 = Arr::pluck($data4, 'raiz_id');

        // if ($nivel_relacion == 'cliente') {

        //     return view('pages.cargaDocCliente')->with('data', $data)->with('data2', $data2)->with('nombre', $nombre)->with('tipocliente_id', $tipocliente_id)->with('cliente_id_itbk', $cliente_id_itbk)->with('usuario', $usuario);

        // } else {

        //     return view('pages.getClienteIND')->with('data', $data)->with('data2', $data2)->with('nombre', $nombre)->with('tipocliente_id', $tipocliente_id)->with('cliente_id_itbk', $cliente_id_itbk)->with('usuario', $usuario);

        // }


         return view('pages.getClienteIND')->with('data', $data)
                                            ->with('data2', $data2)
                                            ->with('nombre', $nombre)
                                            ->with('tipocliente_id', $tipocliente_id)
                                            ->with('cliente_id_itbk', $cliente_id_itbk)
                                            ->with('usuario', $usuario)
                                            ->with('array', $array)
                                            ->with('array2', $array2);
    }

    // public function tipoClientes()
    // {

    //     $tipos = Tipocliente::all();
    //     return response()->json($tipos, 200);
    // }


}
