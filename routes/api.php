<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('1.0/cliente/tipos', 'ApiController@tipoClientes');


Route::get('1.0/documento/tipos', 'ApiController@tipoDocumentos');


/**
 * Ruta API-italdoc para la carga de documentos
 * @param precliente_id
 * @param cliente_id_itbk
 * @param numCuenta
 * Cualquiera de los tres parametros anteriores debe ser enviado a travez del post
 * @param tipo_cliente => refiere al id del tipo de cliente (obligatorio)
 * @param carpeta => refiere al campo carpeta_raiz en la tabla raices (este valor se optine de la ruta '1.0/documento/tipos')
 * @param fecha_emitido (si aplica)
 * @param fecha_vence (si aplica)
 *  @param usuario
 */

Route::post('1.0/documentos/carga', 'ApiController@cargaDocumentos');




