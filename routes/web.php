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
     Route::get('listarCliente', 'ClienteController@show')-> name('getlistarCliente');

    Route::get('registroRuta', 'RutaController@index')-> name('getRegistroRuta');
    Route::post('registroRuta', 'RutaController@store')-> name('postRegistroRuta');
    Route::get('listarRuta', 'RutaController@show')-> name('getlistarRuta');

    Route::get('consultaCliente/{id}/detalle', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');
    // Route::post('consultaCliente/{id}', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');



Route::get('getTipoDocumento', 'DocumentController@getTipoDocumento')-> name('getTipoDocumento');


Route::get('eliminar/{id}/documento', 'DocumentController@eliminarDocumento')-> name('getEliminarDocumento');

Route::get('audilog', 'DocumentController@audilog')-> name('audilog');

Route::get('usuario/{id}', 'ClienteController@getUsuario')-> name('getUsuario');

Route::get('usuariore', 'ClienteController@getUsuariore')-> name('getUsuariore');

Route::get('usuarioro', 'RutaController@getUsuarioro')-> name('getUsuarioro');

Route::get('audilog', 'AudilogController@doceliminados')-> name('audilog');






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
});

/*****************************************************/














