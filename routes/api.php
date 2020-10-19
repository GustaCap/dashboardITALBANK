<?php

use Illuminate\Http\Request;


Route::get('v1.0/producto/{carpeta_raiz}/documentos', 'ApiController@productoDoc')->name('api.v1.0.prod.carpeta.raiz.doc');

/**
 * Ruta: v1.0/estructuras/{carpeta_raiz}/documentos
 * Devuelve todos los documentos asociados a un estructura en particular
 * @param {carpeta_raiz}
 */
Route::get('v1.0/estructura/{carpeta_raiz}/documentos', 'ApiController@estructuraDoc')->name('api.v1.0.estruc.carpeta.raiz.doc');


/**
 * Estructuras Documentales
 * EndPoints para gestionar todas las estructuras documentales.
 *
 * @param id de la estructura documental
 *
 */
Route::get('v1.0/estructuras/documentales', 'ApiController@estructurasDocumentales')->name('api.v1.0.estructuras.documentales');
Route::get('v1.0/estructuras/documentales/{id}', 'ApiController@productoid')->name('api.v1.0.producto.id');
Route::post('v1.0/estructura/documental/create', 'ApiController@createEstructuraDoc')->name('api.v1.0.estructura.documental.create');
Route::put('v1.0/estructura/documental/{id}/update', 'ApiController@updateEstructuraDoc')->name('api.v1.0.estructura.documental.update.id');
Route::delete('v1.0/estructura/documental/{id}/delete', 'ApiController@deleteEstructuraDoc')->name('api.v1.0.estructura.documental.delete.id');


/**
 * Productos
 * EndPoints para gestionar los productos.
 *
 * @param id del producto
 *
 */
Route::get('v1.0/productos', 'ApiController@productos')->name('api.v1.0.productos');
Route::get('v1.0/producto/{id}', 'ApiController@productoid')->name('api.v1.0.producto.id');
Route::post('v1.0/producto/create', 'ApiController@createProducto')->name('api.v1.0.producto.create');
Route::put('v1.0/producto/{id}/update', 'ApiController@updateProducto')->name('api.v1.0.producto.update.id');
Route::delete('v1.0/producto/{id}/delete', 'ApiController@deleteProducto')->name('api.v1.0.producto.delete.id');


/**
 * Tipo de Clientes
 * Los actuales son INDIVIDUO, EMPRESA, PENSIONADO
 * EndPoints para gestionar los tipos de clientes.
 *
 * @param id del tipo de cliente
 *
 */
Route::get('v1.0/cliente/tipos', 'ApiController@tipoClientes')->name('api.v1.0.tipoClientes');
Route::get('v1.0/cliente/tipo/{id}', 'ApiController@tipoClienteid')->name('api.v1.0.tipoClientes.id');
Route::post('v1.0/cliente/tipo/create', 'ApiController@createTipoCliente')->name('api.v1.0.tipoClientes.create');
Route::put('v1.0/cliente/tipo/{id}/update', 'ApiController@updateTipoCliente')->name('api.v1.0.tipoClientes.update.id');
Route::delete('v1.0/cliente/tipo/{id}/delete', 'ApiController@deleteTipoCliente')->name('api.v1.0.tipoClientes.delete.id');


/**
 * Endpoints
 * para manejar informacion para la carga de productos y estructuras.
 */
Route::get('v1.0/niveles/relacion', 'ApiController@nivelesdeRelacion');
Route::get('v1.0/requerimiento/tipos', 'ApiController@requerimientos');
Route::get('v1.0/fecha/expiracion', 'ApiController@fechaExpiracion');
Route::get('v1.0/frecuencia', 'ApiController@frecuencia');





