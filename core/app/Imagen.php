<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model {

	protected $table = "imagenes";





	public function getUploadImageDir(){
		$constant_files = "/upload/images/";
		$dir = str_replace('\core', '', dirname(public_path())).$constant_files;
		return $dir;
	}

	public static function random(){
		return substr(md5(rand(11111111,99999999).md5("RandomString")), 0, 8);
	}

	public function getAllFromDir($json = true){
		$files = scandir($this->getUploadImageDir());
		unset($files[0]);
		unset($files[1]);

		$collection = array();

		foreach($files as $key => $val):
			$collection[] = array('name' => $val, 'url' => url("/").$constant_files.$val);
		endforeach;
		if($json){
			return json_encode($collection);
		}else{
			return $collection;
		}
		
	}

}
