<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Asociacion;
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
        $n_cuenta = $request->n_cuenta;
        // $carpeta_raiz = $request->carpeta_raiz;
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

        //Cambio fecha: 27082020
        // $query2 = "select * from raices
        //                 where tipocliente_id = '$tipocliente_id'
        //                 and tipo_carpeta = 'subnivel'
		// 			    and nivel_relacion = 'cliente'
        //             union
        //             select * from raices
        //                 where tipocliente_id = '$tipocliente_id'
        //                 and tipo_carpeta = 'subnivel'
		// 			    and nivel_relacion = 'producto'
        //                 and carpeta_raiz like '%$carpeta_raiz%'";

        $query2 =   "select ra.id, ra.carpeta_raiz, ra.nivel_relacion, ra.fec_expiracion, ra.requerido, ra.frecuencia, ra.nombre_doc
                    from raices as ra
                    join asociaciones as aso
                    on ra.id = aso.raiz_id
                    and aso.n_cuenta = '$n_cuenta'
                    union
                    select id, carpeta_raiz, nivel_relacion, fec_expiracion, requerido, frecuencia, nombre_doc
                    from raices
                    where nivel_relacion = 'cliente'
                    and tipo_carpeta = 'subnivel'
                    and tipocliente_id = '$tipocliente_id'";

        $data2 = DB::connection('italdocv6')->select($query2);

        /**
         * Foreach de prueba
         */
        foreach ($data2 as $item) {

            $raiz_id = $item->id;
            # code...
        }
        // dd($data2);

        $query3 = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        $data3 = DB::connection('italdocv6')->select($query3);

        //data para comparar con el query3 y saber cuales doc estan cargados
        // $query4 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        // $query4 = "select raiz_id from archivos where n_cuenta = '$n_cuenta'";



        /**
         * Arreglo para buscar en la tabla de archivos
         */

        // $query4 = "select raiz_id from archivos where raiz_id = $raiz_id;";
        $query4 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk' and nivel_relacion = 'cliente'
        union
        select raiz_id from archivos where n_cuenta = '$n_cuenta' and nivel_relacion = 'producto'";
        $data4 = DB::connection('italdocv6')->select($query4);

        /*****************************************************************************************************************/



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

    public function asociarProductos(Request $request, $user)
    {
        $ip = $request->ip();
        $navegador = $request->header('User-Agent');
        $usuario = $user;
        // $clientes = Cliente::distinct();
        $queryClientes = "select distinct * from clientes";
        $clientes = DB::connection('italdocv6')->select($queryClientes);
        $query = "select * from raices where nivel_relacion = 'producto' and tipo_carpeta = 'subnivel'";
        $raices = DB::connection('italdocv6')->select($query);
        $tipocliente = Tipocliente::all();
        return view('pages.asociarProductos')->with('clientes', $clientes)
                                             ->with('raices', $raices);


        # code...
    }

    public function asociaciones(Request $request)
    {
        $usuario = $request->usuario;
        $query = "select * from clientes where cliente_id_itbk = '$request->cliente_id_itbk' FETCH FIRST 1 ROWS ONLY";
        $tipocliente = DB::connection('italdocv6')->select($query);
        foreach ($tipocliente as $item) {
                $tipocliente_id = $item->tipocliente_id;
            }
        $count = collect($request->id);
        for ($i=0; $i < $count->count(); $i++) {

            $dataasociacion = Asociacion::create([

            'raiz_id' => $request->id[$i],
            'n_cuenta' => $request->n_cuenta,
            'cliente_id_itbk' => $request->cliente_id_itbk,
            'tipocliente_id' => $tipocliente_id

            ]);
            $dataasociacion->save();
        }
        return redirect()->back()->with('status', 'Carga successfully');

        // $carpeta_raiz = $request->carpeta_raiz;
        // $n_cuenta = $request->n_cuenta;
        // $query = "select * from raices where carpeta_raiz = '$carpeta_raiz'";
        // $raices = DB::connection('italdocv6')->select($query);
        // foreach ($raices as $item) {
        //     $raiz_id = $item->id;
        // }
        // $query2 = "select * from clientes where n_cuenta = '$n_cuenta' FETCH FIRST 1 ROWS ONLY";
        // $cliente = DB::connection('italdocv6')->select($query2);
        // foreach ($raices as $item) {
        //     $tipocliente_id = $item->tipocliente_id;
        // }

        // $dataasociacion = Asociacion::create([

        //     'raiz_id' => $raiz_id,
        //     'n_cuenta' => $n_cuenta,
        //     'tipocliente_id' => $tipocliente_id,
        //     'carpeta_raiz' => $carpeta_raiz

        //     ]);

        // $dataasociacion->save();
        // return redirect()->back()->with('status', 'Carga successfully');


        # code...
    }

    public function getcuentas($id)
    {

            $cuentas = Cliente::where('cliente_id_itbk', $id)->pluck("n_cuenta","nombre");
            return response()->json($cuentas);

    }

    public function getcuentasJson($id)
    {

            $cuentasJson = Cliente::where('cliente_id_itbk', $id)->get();
            foreach ($cuentasJson as $item) {
                $cuentasJsonArray[$item->n_cuenta] = $item->n_cuenta;
            }
            return response()->json($cuentasJsonArray);

    }


}
