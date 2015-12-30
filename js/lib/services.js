
app.service('gmap',[function(ajax){
	
	this.map = "";
	this.key = "AIzaSyBzNVW6bkBBLSqPMAY7SO4vhGvoL315yNk";
	var object = this;

	this.display = function(lat,lng,id,zoom){
		var myLatLng = {lat: lat, lng: lng};
		this.map = new google.maps.Map(document.getElementById(id||'maps'), {
		    center: myLatLng,
		    zoom: zoom||6
		  });
		var marker = new google.maps.Marker({
		    position: myLatLng,
		    map: object.map
		  });
	}


	this.getPhotos = function(lat,lng,callback,maxWidth){

		var request = {
		    location: new google.maps.LatLng(lat,lng),
		    radius: '50000',
		    type : ['museum','art_gallery','beauty_salon','stadium','place_of_worship']

		  };

		service = new google.maps.places.PlacesService(this.map);
  		service.nearbySearch(request, function(data){
  			var collection = [];

  			angular.forEach(data,function(elem,ind){

  				if(elem.photos != undefined && elem.photos.length > 0){
  					var object = {name: elem.name, photo: elem.photos[0].getUrl({maxWidth: maxWidth || 400})};
  					collection.push(object);
  				}

  			});

  			callback.call('collection', collection);
  		});
	}


}]);


app.service('ajax', ['$http', function(http){
	var prefix = '/ajax/';
	var object = this;
	



	this.post = function(module,method,parameters,success){
		var params = parameters || {};
			params.method = method;

		var req = {
		 method: 'POST',
		 url: prefix+module,
		 headers: {
		 	'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		 },
		 data: params
		}

		http(req).then(function(res){
			if (res.status == 200) {
				success.call('data',res.data);
			}else{
				console.error('Error: ajax', res.data);
			}
		}, function(res){
			console.error('error',res);
		});
	}

	this.hoteles = function(method,params,callback){
		this.post('hoteles',method,params,callback);
	}
	this.image_load = function(method,params,callback){
		this.post('images',method,params,callback);
	}
	/**
	 * Mejor, ahorremos tiempo y creemos todos estos metodos por modulo con esta función y en todo caso pasamos un objeto simple para extender las funcionalidades
	 * Object {NombreDeLaFuncion: Funcion }
	 */
	this.crudStructure = function(nameModule,ObjectExtension){
		var obj = {
			create: function(params,callback){
				object.post(nameModule,'create',params,callback);
			},
			edit: function(params,callback){
				object.post(nameModule,'save',params,callback);
			},
			all: function(callback){
				object.post(nameModule,'all',{},callback);
			},
			del: function(id,callback){
				object.post(nameModule, 'del',{id: id}, callback);
			},
		}
		
		if (ObjectExtension != undefined) {
			 
			angular.forEach(ObjectExtension,function(val,key){
				obj[key] = val;
			});
		};

		return obj;
	}


		this.tipos = object.crudStructure('paquetes');
		this.tags = object.crudStructure('tags');
		this.divisas = object.crudStructure('divisas');
		this.impuestos = object.crudStructure('impuestos');
		this.promociones = object.crudStructure('promociones',{
			activate: function(id,value,callback){
				object.post('promociones','activate',{active: value, id: id}, callback);
			}
		});
		this.incluye = object.crudStructure('incluye');
		this.hoteles = object.crudStructure('hoteles');
		this.comodidades = object.crudStructure('comodidades');



}]);


