<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;
use App\Archivo;
use App\Raiz;
use App\Tipocliente;
use PDF;


class PdfController extends Controller
{

    public function estructurasPDF()
    {
        // $data = ['title' => 'coding driver test title'];
        $data = Raiz::all()->sortBy("nivel_relacion");
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('generate_pdf', $data );
        // $pdf = PDF::loadView('pages.generate_pdf', $data)->stream('archivo.pdf');
        // $pdf->loadView('pages.generate_pdf', $data)->stream('archivo.pdf');
        $pdf = PDF::loadView('pages.generate_pdf', compact('data'));
        return $pdf->stream('prueba.pdf');

        // $pdf = PDF::loadView('pages.generate_pdf')->with('data', $data);

        // return $pdf->download('codingdriver.pdf');
        // return $pdf;
    }

    public function tipoclientesPDF()
    {
        $data = Tipocliente::all()->sortBy("id");
        $pdf = PDF::loadView('pages.tipoClientespdf', compact('data'));
        // return $pdf->download('TipoClientes.pdf');
        return $pdf->stream('TipoClientes.pdf');
    }

    public function documentosPDF()
    {

        // $data = Archivo::all()->where('raiz_id', '<>', 125)->sortBy("cliente_id_itbk");
        $query = "select * from archivos where raiz_id <> '125'";
        $data = DB::connection('italdocv6')->select($query);
        $pdf = PDF::loadView('pages.documentospdf', compact('data'));
        return $pdf->stream('Documentos.pdf');

    }

    public function transferenciasPDF()
    {

        // $data = Archivo::all()->sortBy("nivel_relacion");
        $query = "select * from archivos where raiz_id = '125'";
        $data = DB::connection('italdocv6')->select($query);
        $pdf = PDF::loadView('pages.transferenciaspdf', compact('data'));
        return $pdf->setPaper('a4', 'landscape')->stream('transferencias.pdf');

    }

    public function generarepoPerDoc(Request $request)
    {
        $cliente_id_itbk = $request->cliente_id_itbk;
        $n_cuenta = $request->n_cuenta;
        $fechaini = $request->fechaini;
        $fechafin = $request->fechafin;
        $usuario = $request->usuario;
        // dd($cliente_id_itbk, $fechaini, $fechafin, $nivel_relacion);
        // $query = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk'
        //             and nivel_relacion = '$nivel_relacion'
        //             and created_at
        //             between '$fechaini' and '$fechafin 24:00:00'";
        //             dd($query);

        $query = "select * from archivos
        where n_cuenta = '$n_cuenta'
        and cliente_id_itbk = '$cliente_id_itbk'
        and created_at
        between '$fechaini' and '$fechafin 24:00:00'
        union
        select * from archivos
        where cliente_id_itbk = '$cliente_id_itbk'
        and nivel_relacion = 'cliente'
        and created_at
        between '$fechaini' and '$fechafin 24:00:00'
        order by nivel_relacion asc";
        $data = DB::connection('italdocv6')->select($query);
        $query2 = "select * from clientes where cliente_id_itbk = '$cliente_id_itbk'";
        $dataCliente = DB::connection('italdocv6')->select($query2);
        $pdf = PDF::loadView('pages.Perdocumentospdf', compact('data','fechaini', 'fechafin', 'dataCliente', 'usuario'));
        return $pdf->stream('Documentos.'.$cliente_id_itbk.'.pdf');
    }

    public function generarepoPerTrans(Request $request)
    {
        $cliente_id_itbk = $request->cliente_id_itbk;
        $viaPayment = $request->viaPayment;
        $channel = $request->channel;
        $fechaini = $request->fechaini;
        $fechafin = $request->fechafin;
        $usuario = $request->usuario;
        // dd($cliente_id_itbk, $fechaini, $fechafin, $nivel_relacion);
        $query = "select * from archivos where cliente_id_itbk = '$cliente_id_itbk'
                    and via_payment = '$viaPayment'
                    and channel = '$channel'
                    and created_at
                    between '$fechaini' and '$fechafin'";
        $data = DB::connection('italdocv6')->select($query);
        $query2 = "select * from clientes where cliente_id_itbk = '$cliente_id_itbk'";
        $dataCliente = DB::connection('italdocv6')->select($query2);
        $pdf = PDF::loadView('pages.Pertransferenciaspdf', compact('data','fechaini', 'fechafin', 'dataCliente', 'usuario'));
        return $pdf->setPaper('a4', 'landscape')->stream('Documentos.'.$cliente_id_itbk.'.pdf');
    }




}
