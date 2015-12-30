<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\User;



Route::get('/', function(){

	$array = array();
	for ($i=0; $i < 100; $i++) { 
		$array[$i] = "String_".$i;
	}

	echo "<pre>";
	print_r($array);
	echo "</pre>";
	

});


Route::group(['prefix' => 'admin'],function(){

	/**
	 * Administrador
	 */
	
	Route::get('/','AdminController@index');

	Route::group(['prefix' => 'crucero'],function(){

		Route::get('/', 'CruceroController@index');

	});

	Route::group(['prefix' => 'aeroterrestre'],function(){
		Route::get('/', 'AeroController@index');
		/**
		 * Paquetes
		 */
		Route::get('/paquetes', 'AeroController@paquetes');
		Route::get('/paquetes/tipos', 'AeroController@paquetesTipos');
		Route::get('/paquetes/new', 'AeroController@paquetesNew');
		Route::get('/paquetes/incluye', 'AeroController@paquetesIncluye');

		/**
		 * Etiquetas
		 */
		Route::get('/etiquetas', 'AeroController@tags');
		/**
		 * Incluye
		 */
		Route::get('/incluye',  'AeroController@paquetesIncluye');
		/**
		 * Hoteles
		 */
		Route::get('/hoteles', 'AeroController@hoteles');
		/**
		 * Tipo de cambio (Divisas)
		 */
		Route::get('/divisas','AeroController@divisas');
	});

});


Route::group(['prefix' => 'ajax'],function(){
	Route::post('hoteles', 'AjaxController@hoteles');
	Route::post('images', 'AjaxController@images');
	Route::post('paquetes', 'AjaxController@paquetes');
	Route::post('tags', 'AjaxController@tags');
	Route::post('divisas', 'AjaxController@divisas');
	Route::post('impuestos', 'AjaxController@impuestos');
	Route::post('promociones', 'AjaxController@promociones');
	Route::post('incluye', 'AjaxController@incluye');
	Route::post('comodidades', 'AjaxController@comodidades');
});

