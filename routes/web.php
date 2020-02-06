<?php

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


/**
 * Ruta para mostrar el total de registros en cada plataforma
 * Esta ruta se comunica con el HomeController en la funcion totalDocumentos...
 */
Route::get('/home', 'HomeController@totalDocumentos')->name('home')->middleware('auth');




/**
 * Este grupo de rutas utilizan el Middleware Auth el cual impide que este conjunto de rutas
 * sean accesadas por usuarios que no esten logueados
 */
Route::group(['middleware' => 'auth'], function () {

	Route::get('table-list', function () {
		return view('pages.table_list');
    })->name('table');

    // Agregada la ruta DNI
    Route::get('dni', function () {
		return view('pages.dni');
    })->name('dni');


    /**
     * Ruta agregada para realiar la busqueda de los documento de acuerdo al id introducido
     * por el usuario.
     * Nombre de la Ruta: 'searchDocID'
     */
    Route::get('searchDocID', function () {
        return view('pages.searchDocID');
    })->name('searchDocID');


     /**
     * Ruta agregada para realiar la busqueda de los documento de acuerdo al id introducido
     * por el usuario.
     * Nombre de la Ruta: 'searchDocID'
     */
    Route::get('searchFechaRegistro', function () {
        return view('pages.searchFechaRegistro');
    })->name('searchFechaRegistro');



	Route::get('typography', function () {
		return view('pages.typography');
    })->name('typography');


	Route::get('icons', function () {
		return view('pages.icons');
    })->name('icons');


	Route::get('map', function () {
		return view('pages.map');
    })->name('map');


	Route::get('notifications', function () {
		return view('pages.notifications');
    })->name('notifications');


	Route::get('rtl-support', function () {
		return view('pages.language');
    })->name('language');


	Route::get('upgrade', function () {
		return view('pages.upgrade');
    })->name('upgrade');



    /**
     * Ruta para consultar el id del documento
     * Nombre de la Ruta: 'idDocumentConsultar'
     * Controlador: 'DocumentController'
     */
    Route::post('idDocument', 'DocumentController@consultar') -> name('idDocumentConsultar');


     /**
     * Ruta para consultar el id del documento
     * Nombre de la Ruta: 'fechaRegistroConsultar'
     * Controlador: 'DocumentController'
     */
    Route::post('FechaRegistroDocument', 'DocumentController@fechaRegistro') -> name('fechaRegistroConsultar');

});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

