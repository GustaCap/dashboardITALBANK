<?php

namespace App\Http\Controllers;

use App\User;
use App\Tipocliente;
use App\Raiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Documentidscannedmod;
use App\Documentroutemod;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ApiTipoClienteController extends Controller
{

    public function tipoClientes()
    {
        return response()->json([
            'data' => Tipocliente::all()->map(function ($tipocliente)
            {
                return [
                    'type' => 'Tipo de Cliente',
                    'id'   => (string) $tipocliente->getRouteKey(),
                    'attributes' => [
                        'tipo' => $tipocliente->tipo
                    ],
                    'links' => [
                        'self' => '{{baseUrl}}/cliente/tipo/'.$tipocliente->getRouteKey()
                    ],
                    'jsonapi' => [
                        'version' => '1.0'
                    ]
                ];
            })
        ]);
    }

    public function tipoClienteid($id)
    {
        $tipoclienteid = Tipocliente::find($id);
        //validacion
        if (is_null($tipoclienteid)) {

            return response()->json([
                'errors' => [
                      'status' => '404',
                      'title' => 'Resource not found',
                      'detail'=> 'The requested resource is not registered in the database.'
                  ]
                ],HttpFoundationResponse::HTTP_NOT_FOUND);
        }

        // return response()->json($tipos, 200);
        return response()->json([
            'data' =>  [
                    'type' => 'Tipo de Cliente',
                    'id'   => (string) $tipoclienteid->getRouteKey(),
                    'attributes' => [
                        'tipo' => $tipoclienteid->tipo
                    ],
                    'jsonapi' => [
                        'version' => '1.0'
                    ]
                ]
        ]);
    }

}
