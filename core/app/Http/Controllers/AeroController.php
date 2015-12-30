<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AeroController extends Controller {

	
	public function index()
	{
		return view('admin.aeroterrestre.index')->with('controller',['AeroController']);
	}

	/**
	 * Paquetes functions
	 */

	public function paquetes()
	{
		return view('admin.aeroterrestre.paquetes')->with('controller',['AeroController']);
	}

	public function paquetesNew()
	{
		return view('admin.aeroterrestre.paquetesNew')->with('controller',[
			'AeroController',
			'PaquetesController',
			'TiposPaqController',
			'TagsController',
			'IncluyeController'
			]);
	}
	public function paquetesIncluye(){
		return view('admin.aeroterrestre.incluye')->with('controller',[
			'AeroController',
			'IncluyeController'
			]);
	}

	public function paquetesTipos(){
		return view('admin.aeroterrestre.paquetesTipos')->with('controller',['AeroController','TiposPaqController']);
	}
	
	public function hoteles(){
		return view('admin.aeroterrestre.hoteles')->with('controller',['AeroController','HotelsController']);
	}

	public function divisas(){
		return view('admin.aeroterrestre.divisas')->with('controller',['AeroController','DivisasController','ImpuestosController','PromocionesController']);
	}
	/**
	 * End Paquetes functions
	 */

	/**
	 * Tags 
	 */
	public function tags(){
		return view('admin.aeroterrestre.tags')->with('controller',[
			'AeroController',
			'PaquetesController',
			'TagsController'
			]);
	}

	public function destroy($id)
	{
		//
	}

}
