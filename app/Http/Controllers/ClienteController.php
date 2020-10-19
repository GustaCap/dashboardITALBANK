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

//Agregado para pruebas con api
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;



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
        // $dataCliente = Cliente::all();
        $usuario = $user;

        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);
        $response = $client->request('POST', 'CustomerInfo');
        $dataCliente = json_decode($response->getBody()->getContents());

        return view('pages.getlistarCliente')->with('dataCliente', $dataCliente)->with('usuario', $usuario);

    }


    public function clienteDetalle(Request $request, $id, $user)
    {

        $navegador = $request->header('User-Agent');
        $ip = $request->ip();
        $usuario = $user;

        /*
         * Servicio para consultar el cliente.
         * Fuente. Api DATAPRO.
         */

        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);
        $response = $client->request('POST', 'CustomerInfo', ['json' => ['param' => $id]]);
        $cliente = json_decode($response->getBody()->getContents());

        /************************************************************************************/

        foreach ($cliente as $item)
        {
            $n_cuenta = $item->CUENTA;
            $clasificacion = $item->Clasificacion;
        }

        $tipoClasificacion = "select id from tipoclientes where tipo = '$clasificacion'";

        $res = DB::connection('italdocv6')->select($tipoClasificacion);

        foreach ($res as $items)
        {
            $tipoCliente = $items->id;
        }


        $query = "select ra.id, ra.carpeta_raiz, ra.nivel_relacion, ra.fec_expiracion, ra.requerido, ra.frecuencia, ra.nombre_doc
        from raices as ra
        join asociaciones as aso
        on ra.id = aso.raiz_id
        and aso.n_cuenta = '$n_cuenta'
        union
        select id, carpeta_raiz, nivel_relacion, fec_expiracion, requerido, frecuencia, nombre_doc
        from raices
        where nivel_relacion = 'cliente'
        and tipo_carpeta = 'subnivel'
        and tipocliente_id = '$tipoCliente'
        order by nivel_relacion asc";
        $result = DB::connection('italdocv6')->select($query);

        /**query2. Devuelve el id de las rutas que tengo cargadas por cliente */

        $query2 = "select raiz_id from archivos where cliente_id_itbk = '$id' and nivel_relacion = 'cliente'
        union
        select raiz_id from archivos where n_cuenta = '$n_cuenta' and nivel_relacion = 'producto'";
        $result2 = DB::connection('italdocv6')->select($query2);

        /*****************************************************************************************************/

        $query3 = "select * from archivos where cliente_id_itbk = '$id' and estatus_doc = '1'";
        $result3 = DB::connection('italdocv6')->select($query3);

        $array = Arr::pluck($result, 'id');
        $array2 = Arr::pluck($result2, 'raiz_id');

        /**prueba */
        $query4 = "select * from dolgram.documentidscannedmod where documentid = '$id'";
        $result4 = DB::connection('italsis')->select($query4);


        // return view('pages.getConsultaCliente', compact('cliente', 'result', 'array', 'array2', 'result3', 'usuario', 'result4'));
        return view('pages.getConsultaCliente', compact('cliente', 'result', 'array', 'array2', 'result3', 'usuario', 'result4'));
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
        $data = DB::connection('italdocv6')->select($query);

        $query2 = "select *
                    from raices
                    where tipocliente_id = '$id'
                    and nivel_relacion = 'producto'
                    and tipo_carpeta = 'base'";
        $data2 = DB::connection('italdocv6')->select($query2);
        return view('pages.getSelectClienteItbk')->with('data', $data)
                                                 ->with('data2', $data2)
                                                 ->with('usuario', $usuario);


    }

    public function postclienteItbk(Request $request)
    {
        $usuario = $request->usuario;
        $cliente_id_itbk = $request->cliente_id_itbk;
        $n_cuenta = $request->n_cuenta;


        // $carpeta_raiz = $request->carpeta_raiz;
        // $nivel_relacion = $request->nivel_relacion;
        // $query1 = "select * from clientes where cliente_id_itbk = '$cliente_id_itbk' ";
        // $data = DB::connection('italdocv6')->select($query1);
        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);
        $response = $client->request('POST', 'CustomerInfo', ['json' => ['param' => $cliente_id_itbk]]);
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $item) {
            $clasificacion = $item->Clasificacion;
            $nombre = $item->NOMBRE;
            $cliente_id_itbk = $item->IDCLIENTE;
        }
        // dd($clasificacion, $nombre, $cliente_id_itbk);

        $consulta = "select * from tipoclientes where tipo = '$clasificacion'";
        $res = DB::connection('italdocv6')->select($consulta);
        foreach ($res as $items) {
            $tipocliente_id = $items->id;
        }
        // dd($tipocliente_id);

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
                    and tipocliente_id = '$tipocliente_id'
                    order by nivel_relacion asc";

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

        $query4 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk' and nivel_relacion = 'cliente'
        union
        select raiz_id from archivos where n_cuenta = '$n_cuenta' and nivel_relacion = 'producto'";
        $data4 = DB::connection('italdocv6')->select($query4);

        /*****************************************************************************************************************/



        //comparacion de ambos arreglos
        $array = Arr::pluck($data2, 'id');
        $array2 = Arr::pluck($data4, 'raiz_id');


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
        //Comentado para pruebas 14/10/2020 para utilizar el servicio y listar a todos los clientes
        // $queryClientes = "select distinct * from clientes";
        // $clientes = DB::connection('italdocv6')->select($queryClientes);


        $client = new Client([

            'base_uri' => 'http://10.200.0.46:4438/api/v1/'

        ]);
        $response = $client->request('POST', 'CustomerInfo');
        $clientes = json_decode($response->getBody()->getContents());

        // $query = "select * from raices where nivel_relacion = 'producto' and tipo_carpeta = 'subnivel'";
        $query = "select * from raices where nivel_relacion = 'producto' and tipo_carpeta = 'base' and estatus = '1'";
        $raices = DB::connection('italdocv6')->select($query);
        $tipocliente = Tipocliente::all();
        return view('pages.asociarProductos')->with('clientes', $clientes)
                                             ->with('raices', $raices);

    }

    public function asociaciones(Request $request)
    {

        $usuario = $request->usuario;
        /**LINEA 351 COMENTADA EL 14/10/2020 PARA OBTENER LA DATA POR EL SERVICIO WEB */
        // $query = "select * from clientes where cliente_id_itbk = '$request->cliente_id_itbk' FETCH FIRST 1 ROWS ONLY";

        /**LINEA 354 COMENTADA EL 14/10/2020*/
        // $tipocliente = DB::connection('italdocv6')->select($query);
        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);
        $id = $request->cliente_id_itbk;
        $response = $client->request('POST', 'CustomerInfo', ['json' => ['param' => $id]]);
        $tipocliente = json_decode($response->getBody()->getContents());

        foreach ($tipocliente as $item) {
            $tipocliente_id = $item->IDCLIENTE;
        }

        $queryPrueba = "select id from
                        raices where
                        carpeta_raiz like '%$request->carpeta_raiz%'
                        and tipo_carpeta = 'subnivel'";
        $carperasAsociadas = DB::connection('italdocv6')->select($queryPrueba);
        foreach ($carperasAsociadas as $item) {
            $subniveles[] = $item->id;
        }

        // dd($p);

        $countPrueba = collect($carperasAsociadas);
        // dd($request, $tipocliente, $carperasAsociadas, $countPrueba );
        for ($i=0; $i < $countPrueba->count(); $i++) {

                $dataasociacion = Asociacion::create([

                    'raiz_id' => $subniveles[$i],
                    'n_cuenta' => $request->n_cuenta,
                    // 'cliente_id_itbk' => $request->cliente_id_itbk,
                    'cliente_id_itbk' => $id,
                    'tipocliente_id' => $tipocliente_id,
                    'usuario' => $usuario

                    ]);
                    $dataasociacion->save();

        }
        return redirect()->back()->with('status', 'Carga successfully');

    }

    public function getcuentas($id)
    {

            $cuentas = Cliente::where('cliente_id_itbk', $id)->pluck("n_cuenta","nombre");
            return response()->json($cuentas);

    }

    public function getcuentasJsonBACKUP($id)
    {

            $cuentasJson = Cliente::where('cliente_id_itbk', $id)->get();
            foreach ($cuentasJson as $item) {
                $cuentasJsonArray[$item->n_cuenta] = $item->n_cuenta;
            }
            return response()->json($cuentasJsonArray);

    }

    public function getcuentasJson($id)
    {
        $client = new Client([
            'base_uri' => 'http://10.200.0.46:4438/api/v1/'
        ]);

        $response = $client->request('POST', 'CustomerInfo', ['json' => ['param' => $id]]);
        $cuentasJson = json_decode($response->getBody()->getContents());
        foreach ($cuentasJson as $item) {
            $cuentasJsonArray[$item->CUENTA] = $item->CUENTA;
        }
        return response()->json($cuentasJsonArray);

    }

    public function getProductosJson($n_cuenta)
    {

            $query = "select * from clientes where n_cuenta = '$n_cuenta'";
            $cuenta = DB::connection('italdocv6')->select($query);
            foreach ($cuenta as $item) {
                $tipocliente_id = $item->tipocliente_id;
                # code...
            }

            $productosJson = Raiz::where('tipocliente_id', $tipocliente_id)->where('tipo_carpeta', 'base')->get();
            foreach ($productosJson as $item) {
                $productosJsonArray[$item->carpeta_raiz] = $item->carpeta_raiz;
            }
            return response()->json($productosJsonArray);

    }
















    public function asociacionesBACKUP(Request $request)
    {

        $usuario = $request->usuario;
        $query = "select * from clientes where cliente_id_itbk = '$request->cliente_id_itbk' FETCH FIRST 1 ROWS ONLY";

        $tipocliente = DB::connection('italdocv6')->select($query);

        foreach ($tipocliente as $item) {
            $tipocliente_id = $item->tipocliente_id;
        }

        $queryPrueba = "select id from
                        raices where
                        carpeta_raiz like '%$request->carpeta_raiz%'
                        and tipo_carpeta = 'subnivel'";
        $carperasAsociadas = DB::connection('italdocv6')->select($queryPrueba);
        foreach ($carperasAsociadas as $item) {
            $subniveles[] = $item->id;
        }

        // dd($p);

        $countPrueba = collect($carperasAsociadas);
        // dd($request, $tipocliente, $carperasAsociadas, $countPrueba );
        for ($i=0; $i < $countPrueba->count(); $i++) {

                $dataasociacion = Asociacion::create([

                    'raiz_id' => $subniveles[$i],
                    'n_cuenta' => $request->n_cuenta,
                    'cliente_id_itbk' => $request->cliente_id_itbk,
                    'tipocliente_id' => $tipocliente_id,
                    'usuario' => $usuario

                    ]);
                    $dataasociacion->save();

        }
        return redirect()->back()->with('status', 'Carga successfully');

    }

    public function postclienteItbkBACKUP(Request $request)
    {
        $usuario = $request->usuario;
        $cliente_id_itbk = $request->cliente_id_itbk;
        $n_cuenta = $request->n_cuenta;

        $query1 = "select * from clientes where cliente_id_itbk = '$cliente_id_itbk' ";
        $data = DB::connection('italdocv6')->select($query1);
        foreach ($data as $item) {
            $tipocliente_id = $item->tipocliente_id;
            $nombre = $item->nombre;
            $cliente_id_itbk = $item->cliente_id_itbk;
        }

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
                    and tipocliente_id = '$tipocliente_id'
                    order by nivel_relacion asc";

        $data2 = DB::connection('italdocv6')->select($query2);

        foreach ($data2 as $item) {

            $raiz_id = $item->id;

        }

        $query3 = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk'";
        $data3 = DB::connection('italdocv6')->select($query3);

        $query4 = "select raiz_id from archivos where cliente_id_itbk = '$cliente_id_itbk' and nivel_relacion = 'cliente'
        union
        select raiz_id from archivos where n_cuenta = '$n_cuenta' and nivel_relacion = 'producto'";
        $data4 = DB::connection('italdocv6')->select($query4);

        /*****************************************************************************************************************/

        //comparacion de ambos arreglos
        $array = Arr::pluck($data2, 'id');
        $array2 = Arr::pluck($data4, 'raiz_id');


         return view('pages.getClienteIND')->with('data', $data)
                                            ->with('data2', $data2)
                                            ->with('nombre', $nombre)
                                            ->with('tipocliente_id', $tipocliente_id)
                                            ->with('cliente_id_itbk', $cliente_id_itbk)
                                            ->with('usuario', $usuario)
                                            ->with('array', $array)
                                            ->with('array2', $array2);
    }


}
