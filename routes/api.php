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

/**
 * Ruta: v1.0/cliente/tipos
 * Devuelve todos los tipos de clientes registrados
 */
Route::get('v1.0/cliente/tipos', 'ApiController@tipoClientes')->name('api.v1.0.cliente.tipos');
Route::get('v1.0/cliente/tipo/{id}', 'ApiController@tipoClienteid')->name('api.v1.0.cliente.tipo.id');

/**
 * Ruta: v1.0/productos
 * Devuelve todos los productos registrados
 */
Route::get('v1.0/productos', 'ApiController@productos');
Route::get('v1.0/producto/{id}', 'ApiController@productoid')->name('api.v1.0.producto.id');

/**
 * Ruta: v1.0/estructuras
 * Devuelve todos los estructutas registrados
 */
Route::get('v1.0/estructuras', 'ApiController@estructuras');
Route::get('v1.0/estructura/{id}', 'ApiController@estructuraid')->name('api.v1.0.estructura.id');

/**
 * Ruta: v1.0/productos/{carpeta_raiz}/documentos
 * Devuelve todos los documentos asociados a un producto en particular
 * @param {carpeta_raiz}
 */
Route::get('v1.0/producto/{carpeta_raiz}/documentos', 'ApiController@productoDoc')->name('api.v1.0.prod.carpeta.raiz.doc');

/**
 * Ruta: v1.0/estructuras/{carpeta_raiz}/documentos
 * Devuelve todos los documentos asociados a un estructura en particular
 * @param {carpeta_raiz}
 */
Route::get('v1.0/estructura/{carpeta_raiz}/documentos', 'ApiController@estructuraDoc')->name('api.v1.0.estruc.carpeta.raiz.doc');

/**
 * Ruta: v1.0/estructuras
 * Devuelve todos los estructutas registrados
 */
Route::get('v1.0/niveles/relacion', 'ApiController@nivelesdeRelacion');

Route::get('v1.0/requerimiento/tipos', 'ApiController@requerimientos');

Route::get('v1.0/fecha/expiracion', 'ApiController@fechaExpiracion');

Route::get('v1.0/frecuencia', 'ApiController@frecuencia');









/**
 * Ruta: 1.0/documentos/carga
 * Para la carga de documentos
 *
 * @param precliente_id
 * @param cliente_id_itbk
 * @param numCuenta
 * Cualquiera de los tres parametros anteriores debe ser enviado a travez del post
 * @param tipo_cliente => refiere al id del tipo de cliente (obligatorio)
 * @param carpeta => refiere al campo carpeta_raiz en la tabla raices (este valor se optine de la ruta '1.0/documento/tipos')
 * @param fecha_emitido (si aplica)
 * @param fecha_vence (si aplica)
 * @param usuario
 */
Route::post('1.0/documentos/carga', 'ApiController@cargaDocumentos');


// Route::get('productos/estructuras/{id}', 'RutaController@productosDinamicos');




