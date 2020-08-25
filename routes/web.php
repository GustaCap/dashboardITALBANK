<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use App\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/prueba', 'HomeController@prueba')->name('prueba');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Auth::routes(); //Comentado para Eliminar el Login y el registro del Aplicativo. Fecha: 25/05/2020

 Route::get('/home', 'HomeController@index')->name('home');

//  Route::get('/', 'HomeController@prueba')->name('prueba');


// Route::get('listarCliente', 'ClienteController@show')-> name('getlistarCliente');


Route::get('/dashboarditalDoc', 'HomeController@indexItalDoc')->name('dashboarditalDoc')->middleware('auth');


/**
 * Ruta para mostrar el total de registros en cada plataforma
 * Esta ruta se comunica con el HomeController en la funcion totalDocumentos...
 */
Route::get('/home', 'HomeController@totalDocumentos')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
 	Route::resource('user', 'UserController', ['except' => ['show']]);
 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
 });



/**
    * Rutas para carga los documentos por cliente
    * Controlador: 'DocumentController'
    */
    Route::get('cargarDocumentos', 'DocumentController@getData');

    Route::post('cargarDocumentos', 'DocumentController@cargarDocumentos') -> name('cargarDocumentos');

    Route::get('getClienteIND', 'DocumentController@getClienteIND') -> name('getClienteIND');
    // Route::post('postClienteIND', 'DocumentController@postClienteIND') -> name('postClienteIND');

    Route::get('getClienteCE', 'DocumentController@getClienteCE') -> name('getClienteCE');
    // Route::post('postClienteCE', 'DocumentController@postClienteCE') -> name('postClienteCE');

    Route::get('getClienteCB', 'DocumentController@getClienteCB') -> name('getClienteCB');
    // Route::post('postClienteCB', 'DocumentController@postClienteCB') -> name('postClienteCB');

    Route::get('getClienteCM', 'DocumentController@getClienteCM') -> name('getClienteCM');
    // Route::post('postClienteCM', 'DocumentController@postClienteCM') -> name('postClienteCM');

    //Prueba...
    Route::post('postClienteFiles', 'DocumentController@postClienteFiles') -> name('postClienteFiles');

    Route::get('registroCliente', 'ClienteController@index')-> name('getRegistroCliente');
    Route::post('registroCliente', 'ClienteController@store')-> name('postRegistroCliente');
    //  Route::get('cliente/listar', 'ClienteController@show')-> name('getlistarCliente');
     Route::get('listarCliente', 'ClienteController@show')-> name('getlistarCliente');

    // Route::get('registroRuta', 'RutaController@index')-> name('getRegistroRuta');
    // Route::post('registroRuta', 'RutaController@store')-> name('postRegistroRuta');
    // Route::get('documentos/listar', 'RutaController@show')-> name('getlistarRuta');
    Route::get('listarRuta', 'RutaController@show')-> name('getlistarRuta');

    Route::get('consultaCliente/{id}/detalle', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');
    // Route::post('consultaCliente/{id}', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');



Route::get('registro/ruta/getTipoDocumento', 'DocumentController@getTipoDocumento')-> name('getTipoDocumento');

Route::get('cuentas', 'DocumentController@getCuenta');


Route::get('eliminar/{id}/documento', 'DocumentController@eliminarDocumento')-> name('getEliminarDocumento');

Route::get('audilog', 'DocumentController@audilog')-> name('audilog');

Route::get('usuario/{id}', 'ClienteController@getUsuario')-> name('getUsuario');

Route::get('usuariore', 'ClienteController@getUsuariore')-> name('getUsuariore');

Route::get('usuarioro', 'RutaController@getUsuarioro')-> name('getUsuarioro');

// Route::get('audilog', 'AudilogController@doceliminados')-> name('audilog');






/**
 * Ruta para el de Sesion del Usuario
 * @param {user}
 * @return vista 'welcome'
 */
/*****************************************************/

Route::get('/user/{user}', function ($user = '') {
    Session::put('usuario', $user);
    // $fun = new Usuario();
    // $fun->userString();
    return redirect()->back();
    // return redirect('/');
    // return view('pages.getlistarCliente');
    // return redirect()->view('welcome');
});

/*****************************************************/

//prueba
// Route::get('registroRuta/{user}', 'RutaController@index')-> name('getRegistroRuta');
Route::get('registro/ruta/{user}', 'RutaController@index')-> name('getRegistroRuta');
Route::post('registroRuta', 'RutaController@store')-> name('postRegistroRuta');
//  Route::get('registro/ruta', 'RutaController@index')-> name('getRegistroRuta');
// Route::get('listarRuta/{user}', 'RutaController@show')-> name('getlistarRuta');
Route::get('listar/ruta/{user}', 'RutaController@show')-> name('getlistarRuta');
// Route::get('listarCliente/{user}', 'ClienteController@show')-> name('getlistarCliente');
Route::get('listar/cliente/{user}', 'ClienteController@show')-> name('getlistarCliente');
// Route::get('getClienteIND/{user}', 'DocumentController@getClienteIND') -> name('getClienteIND');
Route::get('cliente/IND/{user}', 'DocumentController@getClienteIND') -> name('getClienteIND');
// Route::get('getClienteCE/{user}', 'DocumentController@getClienteCE') -> name('getClienteCE');
Route::get('cliente/CE/{user}', 'DocumentController@getClienteCE') -> name('getClienteCE');
// Route::get('getClienteCB/{user}', 'DocumentController@getClienteCB') -> name('getClienteCB');
Route::get('cliente/CB/{user}', 'DocumentController@getClienteCB') -> name('getClienteCB');
// Route::get('getClienteCM/{user}', 'DocumentController@getClienteCM') -> name('getClienteCM');
Route::get('cliente/CM/{user}', 'DocumentController@getClienteCM') -> name('getClienteCM');

/**
 * Ruta para CONSULTAR los documentos cargados por cada tipo de cliente
 * @param {id} del cliente
 * @param {user}, nombre de usuario
 */

Route::get('consulta/cliente/{id}/detalle/{user}', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');


/**
 * Ruta para ELIMINAR los documentos cargados por cada tipo de cliente
 * @param {id} del cliente
 * @param {user}, nombre de usuario
 */
Route::get('eliminar/cliente/{id}/documento/{user}', 'DocumentController@eliminarDocumento')-> name('getEliminarDocumento');

Route::get('audilog/{user}', 'AudilogController@doceliminados')-> name('audilog');

Route::get('crear/estructura/{user}', 'EstructuraController@index')-> name('getCrearEstructura');

Route::get('crear/cliente/{user}', 'TipoclienteController@index')-> name('getCrearTipocliente');

Route::post('crear/estructura', 'EstructuraController@store')-> name('postCreaEstructura');

Route::post('crear/cliente', 'TipoclienteController@store')-> name('postCrearTipocliente');

Route::get('upload/documentos/{user}', 'DocumentController@uploadIndex')-> name('uploadDocumentos');

Route::get('upload/tipo/cliente/{id}/documentos/carga/{user}', 'DocumentController@uploadDocClientes')-> name('uploadDocClientes');
// Route::get('upload/tipocliente/{tcid}/cliente/{id}/documentos/carga/{user}', 'DocumentController@uploadDocClientes')-> name('uploadDocClientes');

// Route::get('upload/documentos', 'DocumentController@getDocumentos')-> name('getDocumentos');
Route::get('upload/documentos/getTipoDocumento', 'DocumentController@getDocumento')-> name('getTipoDocumento');


/**
 * Rutas para el manejo de transferencias
 * Agregadas: 23/07/2020
 * Requerido por: Daniel Ledesma
 */
Route::get('cargar/transferencia/{user}', 'TransferenciaController@index')-> name('getCargarTransferencia');

Route::post('upload/transferencia', 'TransferenciaController@store')-> name('postUploadTransferencia');

Route::get('listar/transferencias/{user}', 'TransferenciaController@show')-> name('getListarTransferencias');

Route::get('eliminar/transferencia/{id}/{user}', 'TransferenciaController@eliminarTransferencia')-> name('getEliminarTransferencia');


/**
 * Rutas Agregadas para prueba de funcionalidad
 */

Route::get('tipocliente/{id}/cliente/italbank/{user}', 'ClienteController@clienteItbk')-> name('getClienteItbk');

Route::post('cuenta/cliente', 'ClienteController@postclienteItbk')-> name('postClienteItbk');


Route::get('prueba6767', function () {
    return view('pages.pruebaIframe');
});



/**
 * Rutas Agregadas para prueba de pdf
 */


Route::get('pdf', function() {

    $pdf = App::make('dompdf.wrapper');

    $pdf->loadView('pages.generate_pdf');

    return $pdf->stream();

});

Route::get('estructuras/pdf','PdfController@estructurasPDF');
Route::get('cliente/tipos/pdf','PdfController@tipoclientesPDF');
Route::get('documentos/pdf','PdfController@documentosPDF');
Route::get('transferencias/pdf','PdfController@transferenciasPDF');

Route::get('reporte/per/doc/{user}','DocumentController@reportePerDoc')->name('getrepoperdoc');
Route::post('reporte/per/doc','PdfController@generarepoPerDoc')->name('postrepoperdoc');

Route::get('reporte/per/trans/{user}','DocumentController@reportePerTrans')->name('getrepopertrans');
Route::post('reporte/per/trans','PdfController@generarepoPerTrans')->name('postrepopertrans');




Route::post('postDocClienteFiles', 'DocumentController@postDocClienteFiles') -> name('postDocClienteFiles');




