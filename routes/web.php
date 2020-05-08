<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/dashboarditalDoc', 'HomeController@indexItalDoc')->name('dashboarditalDoc')->middleware('auth');


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
    // Route::get('searchDocID', function () {
    //     return view('pages.searchDocID');
    // })->name('searchDocID');

    Route::get('searchDocID', 'DocumentController@consultaGeneral') -> name('searchDocID');


     /**
     * Ruta agregada para realiar la busqueda de los documento de acuerdo al id introducido
     * por el usuario.
     * Nombre de la Ruta: 'searchDocID'
     */
    Route::get('searchFechaRegistro', function () {
        return view('pages.searchFechaRegistro');
    })->name('searchFechaRegistro');

      /**
     * Ruta agregada para realiar la carga de documentos del cliente en la nueva base de datos
     * Italdocv2
     * Nombre de la Ruta: 'cargaDocumentos'
     */
    Route::get('cargarDocumentos', function () {
        return view('pages.cargarDocumentos');
    })->name('cargarDocumentos');



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

    Route::get('consultaCliente/{id}', 'ClienteController@clienteDetalle')-> name('getConsultaCliente');



    Route::get('cargaDeDocumentos', function () {

      return  view('pages.cargaDeDocumentos');
        
    })->name('cargaDeDocumentos');

});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

// Route::get('/prueba', 'DocumentController@getSharedFile');

Route::get('/prueba', function () {

    $path = 'sharedfile';
    $r = is_dir($path); //devuelve verdadero si es un directorio
    dd($r);
    $directorios = scandir($path);
    dd($directorios);

    $manuals = [];
    $filesInFolder = \File::files('sharedfile/Adolfo Garza - Cuentas Nuevas');
    // dd($filesInFolder);

    $dir1   = 'sharedfile';
    $files1 = array_slice(scandir($dir1), 1);

// foreach ($files1 as $key) {
//     $i = 0;
//     return $key[$i];
//     $i++;

//     # code...
// }



// return $files1[0];

$longitud = count($files1);

// //Recorro todos los elementos
for($i=0; $i<$longitud; $i++)
      {
      //saco el valor de cada elemento
	  $r[] = $files1[$i];
	//   echo "<br>";
      }

      return view('pages.prueba')->with('r', $r);

    //   dd($r[]);







// $dir2  = 'sharedfile/3 lane LTD - Pedro Saro';
// $files2 = array_slice(scandir($dir2), 2);

// $filesInFolder = \File::files('sharedfile/3 lane LTD - Pedro Saro/0 - Planilla de Verificacion de Requisitos');


//  dd($files1, $files2, $filesInFolder);


});

Route::get('/prueba2', function () {

    $listar = null;
    $dir = scandir("sharedfile/3 lane LTD - Pedro Saro");

    // $r = readdir($dir);
    dd($dir);

});

Route::get('/prueba3', function () {

$ruta = 'sharedfile/';

  // return view('pages.prueba')->with('files', $files);

  if (is_dir($ruta)) {
    if ($dh = opendir($ruta)) {
       while (($file = readdir($dh)) !== false) {
          //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
          //mostraría tanto archivos como directorios
          // echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
          if (is_dir($ruta . $file) && $file!="." && $file!=".."){
             //solo si el archivo es un directorio, distinto que "." y ".."
             echo "<br>Directorio: $ruta$file";
             dd($ruta . $file . "/");
          }
       }
    closedir($dh);
    }
 }else
    echo "<br>No es ruta valida";

});



Route::get('/prueba4', function () {


    $nu = 5754;

    $client = new \GuzzleHttp\Client();
    // $client->setDefaultOption('verify', false);
    // $response = $client->request('GET', 'https://64.135.7.40/api/Customer?AccountNumber='."$nu",['verify' => false]);
    // $array = $response->json();

    // $response = $client->get('https://github.com/mtdowling.atom');
    // $response = $client->request('GET', 'https://64.135.7.40/api/Customer?AccountNumber='."$nu",['verify' => false]);
    $response = $client->get('https://64.135.7.40/api/Customer?AccountNumber='.$nu,['verify' => false]);
    $xml = Array($response->getBody()->getContents());
    // dd($xml);
    // $xml = simplexml_load_string((string)$response->getBody()->getContents());
    // $t = $xml->ns2;
    dd($xml);



//    return $response->getBody();
// $json = (string)$response->getBody()->getContents();
// $json = json_decode($response->getBody());
// $xml = simplexml_load_string($response->getBody());

// dd($json, $xml);
// $prueba = new SimpleXMLElement($response->getBody());
// echo $prueba;
// $resul = file_get_contents($json);
// $resul2 = simplexml_load_string($json);
// $p1 = json_encode($json, true);
// $p= json_decode($p1, true);
// $collection = collect($p);
// dd(json_encode($json, true));
 //dd($p);
// dd($p);



    // dd(($response->getBody()->getContents()));
    // $json = json_encode(simplexml_load_string($response->getBody()->getContents()));
    // return $json;

    // echo $response->getStatusCode(); // 200

    // $response = $client->get('https://64.135.7.40/api/Customer?AccountNumber=4095');



    // echo $response->getStatusCode(); // 200
    // return $response->getBody();
    // $info = json_decode($response->getBody()->getContents());
    // dd($info);


});

Route::get('prueba5', 'DocumentController@prueba') -> name('prueba5');










