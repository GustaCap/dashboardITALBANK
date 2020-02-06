<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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

    public function totalDocumentos()
    {

        try {

            $query = "select COUNT(*) from dolgram.documentidscannedmod";

        } catch (Exception $e) {

            report($e);

            return false;
        }

        $query = DB::connection('italsis')->select($query);
        // $data = implode($query);
        // dd($query);
        return view('dashboard', compact('query'));


    }
}
