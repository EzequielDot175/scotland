<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AjaxController extends Controller {


	public function images(Request $request){

		// print_r($request->all());
		if($request->hasFile('file')){

			$image = new \App\Imagen();
			$file = $request->file('file');
			$name = $image->random().".".$file->getClientOriginalExtension();
			$file->move($image->getUploadImageDir(), $name);
			echo $name;
		}
		die;



	}

	public function paquetes(Request $request){

		$all = (Object)$request->all();


		switch ($all->method) {
			case 'create':
					$newCat = new \App\catPaquete();
					$newCat->name = $all->name;
					if ($newCat->save()) {
						echo $newCat->all()->toJson();
					}else{
						echo "false";
					}
				break;

			case 'all':
					$allTypePackages = new \App\catPaquete();
					echo $allTypePackages->all()->toJson();
				break;

			case 'save':
					$saveTypePackage = \App\catPaquete::find($all->id);
					$saveTypePackage->name = $all->name;
					echo ($saveTypePackage->save() ? 'true' : 'false');
				break;
			case 'del':
					$count_packages = \App\Paquete::where('cat_paquete', '=', $all->id)->count();
					if ($count_packages == 0 ) {
						$delete = \App\catPaquete::find($all->id)->delete();
						echo ($delete ? 'true' : 'Error al borrar la categoria');
					}else{
						echo "Existen paquetes con esta categoria.";
					}
				break;


			default:
				# code...
				break;
		}
	}

	public function tags(Request $req){
		self::crudStructure(new \App\Tag(),['name'],$req);
	}

	public function divisas(Request $req){
		self::crudStructure(new \App\Divisa(),['name','value'],$req);
	}
	public function impuestos(Request $req){
		self::crudStructure(new \App\Impuesto(),['name','percent'],$req);
	}
	public function promociones(Request $req){
		self::crudStructure(new \App\Promocion(),['name','description','image','expire','percent','number'],$req);
	}
	public function incluye(Request $req){
		self::crudStructure(new \App\Incluye(),['type','multiple','values','name','image'],$req);
	}
	public function comodidades(Request $req){
		self::crudStructure(new \App\Comodidad(),['name','icon'],$req);
	}

	public function hoteles(Request $req){
		self::crudStructure(new \App\Hotel(),['name','description','place','comodidades','stars','web'],$req);
	}
	

	/**
	 * Simple CRUD ABM
	 */ 
	private static function crudStructure($myClass,$nameParams,$req){
		$all = (Object)$req->all();
		$object = $myClass;

		switch ($all->method) {
			case 'create':
				$create = $object;

				foreach($nameParams as $key => $val):
					$create->{$val} = $all->{$val};
				endforeach;

				$create->save();
				echo $create->all()->toJson();
				break;
			case 'save':
				$save = $object->find($all->id);
				foreach($nameParams as $key => $val):
					$save->{$val} = $all->{$val};
				endforeach;
				echo ($save->save() ? 'true' : 'false');
				break;
			case 'all':
				echo $object->all()->toJson();
				break;
			case 'del':
				$del = $object->find($all->id);
				echo ($del->delete() ? 'true' : 'false');
				break;
			case 'activate':
				$act = $object->find($all->id);
				$act->active = $all->active;
				echo ($act->save() ? 'true' : 'false');
				break;
			
			default:
				# code...
				break;
		}
	}


}
