<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
// use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($request)
    {
        //
        // $query = "select id from dolgram.documentidscannedmod where documentid = "
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        $id = $request;
        dd($id);
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
        dd($id);
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

    public function consultar(Request $request)
    {
        // Validacion de campo id para que no sea vasio ......................................

        $validate = \Validator::make($request->all(), [

            'id' => 'required|numeric',
        ]);

        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        // fin de la validación ..............................................................


        $id= $request -> id;
        $query = "select * from dolgram.documentidscannedmod where documentid = '$id'";
        $query = DB::connection('italsis')->select($query);

        // $prueba = class_basename($h);
        // $value = str::contains($h, '1/1948/3/3.2/3.2.4/');

        // dd($value,  $h, $prueba, $query);

        // return view('pages.dni')->with('query', $query);
        // return view('pages.dni', compact('query'));
        return view('pages.dni', ['query' => $query]);
        // dd($query);
    }
}
