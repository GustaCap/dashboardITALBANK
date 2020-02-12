<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    public function indexItalDoc()
    {
        try {

            $query  =  "select COUNT(*) from dolgram.documentidscannedmod";
            /**
             * Total de documentos por tipo de cliente
             * /1/1. -> Cliente Individuo
             * /2/2. -> Cliente Corporativo
             * /3/3. -> Cliente Individuo - Pencionado
             */
            $query2 = "select COUNT(*) from dolgram.documentidscannedmod where path like '%/1/1.%'";

            $query3 = "select COUNT(*) from dolgram.documentidscannedmod where path like '%/2/2.%'";

            $query4 = "select COUNT(*) from dolgram.documentidscannedmod where path like '%/3/3.%'";


            /**
             * Lista de documentos por tipo de cliente
             */
            $query5 = "select distinct(doc_name) from dolgram.documentroutemod where spath like '%Cliente Corporativo%' order by doc_name asc";

            $query6 = "select distinct(doc_name) from dolgram.documentroutemod where spath like '%Cliente Individuo%' order by doc_name asc";

            $query7 = "select distinct(doc_name) from dolgram.documentroutemod where spath like '%Cliente Individuo - Pensionado%' order by doc_name asc";

        } catch (Exception $e) {

            report($e);

            return false;
        }

        $query = DB::connection('italsis')->select($query);

        $query2 = DB::connection('italsis')->select($query2);
        $query3 = DB::connection('italsis')->select($query3);
        $query4 = DB::connection('italsis')->select($query4);

        $query5 = DB::connection('italsis')->select($query5);
        $query6 = DB::connection('italsis')->select($query6);
        $query7 = DB::connection('italsis')->select($query7);

        // Obtengo la fecha actual del dia
        $fecha = Carbon::now();

        return view('dashboarditalDoc', compact('query', 'fecha', 'query2', 'query3', 'query4', 'query5', 'query6', 'query7'));
    }

    public function totalDocumentos()
    {

        try {

            /**
             * Query para traer el total de documentos registrados en base de datos
             */
            $query = "select COUNT(*) from dolgram.documentidscannedmod";

        } catch (Exception $e) {

            report($e);

            return false;
        }

        $query = DB::connection('italsis')->select($query);

        return view('dashboard', compact('query'));

    }

    public function prueba()
    {
        // return 'prueba';

        // Storage::disk('public')->put('file.txt', 'prueba gustavo hola mundo louremdvsdf nfndbkjgksjdjfsjhvkjhhkjkjnjknjn g dgrgr er g g greg reg reg r');
        $ruta = Storage::disk('public2');
        // $size = Storage::size('file.txt');
        dd($ruta);
        # code...
    }
}
