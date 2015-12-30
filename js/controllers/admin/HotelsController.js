app.controller('HotelsController', ['$scope','gmap','ajax','FileUploader', function(scp,gmap,ajax,FileUploader){



	var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


	scp.uploader = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});

	scp.uploader_edit = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});


	scp.uploader_hoteles = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});


	// Uploader
	scp.uploader.onSuccessItem = function(item, res, status, headers){
		console.info('Reporting onSuccessItem:', res);
		if (status == 200) {
			scp.comodidades.factory.icon = res;
		};
	}
	scp.uploader.onProgressAll = function(progress){
		$('#progress').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader.onAfterAddingFile = function(item){
		scp.uploader.clearQueue();
		scp.uploader.queue.push(item);
	}
	// Uploader

	scp.uploader_edit.onSuccessItem = function(item, res, status, headers){
		if (status == 200) {
			scp.comodidades.inEditItem.icon = res;
		};
	}
	scp.uploader_edit.onProgressAll = function(progress){
		$('#progress-edit').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader_edit.onAfterAddingFile = function(item){
		scp.uploader_edit.clearQueue();
		scp.uploader_edit.queue.push(item);
	}

	// Hoteles
	
	scp.uploader_hoteles.onSuccessItem = function(item, res, status, headers){
		if (status == 200) {
			scp.comodidades.inEditItem.icon = res;
		};
	}
	scp.uploader_hoteles.onProgressAll = function(progress){
		$('#progress-hoteles').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader_hoteles.onAfterAddingFile = function(item){
		scp.uploader_hoteles.clearQueue();
		scp.uploader_hoteles.queue.push(item);
	}

	/**
	 * Hotel Characters
	 * hotel: {
	 * 		name: string,
	 * 		starts: [num],
	 * 		image: [string],
	 * 		descripcion: [string],
	 * 		
	 * 		
	 * }
	 */



	scp.comodidades = {
		collection: [],
		inEdit: false,
		inEditItem : [{name: "", icon: "", id: ""}],
		factory: {
			name: "",
			icon: ""
		},
		add:function(){
			if ( this.factory.name != "" &&  this.factory.icon != "") {
				ajax.comodidades.create(this.factory, function(res){
					scp.comodidades.collection = res;
					scp.comodidades.factory.name = "";
					scp.comodidades.factory.icon = "";
					scp.uploader.clearQueue();
					$('#progress').width('0%').attr('aria-valuenow', 0);
				});
			}else{
				alert("Completar los campos");
			}
		},
		all: function(){
			ajax.comodidades.all(function(res){
				scp.comodidades.collection = res;
			});
		},
		makeEdit: function(val){
			this.inEdit = true;
			this.inEditItem = val;
		},
		edit: function(){
			ajax.comodidades.edit(this.inEditItem, function(res){
				console.info('Reporting edit:', res);
			});
		},
		del: function(k,val){
			if(confirm("¿Esta seguro que desea borrar esta comodidad?")){
				ajax.comodidades.del(val.id,function(res){
					console.info('Reporting del:', val.id);
					scp.comodidades.collection.splice(k, 1);
				});
			}
		}
	}

	scp.hoteles = {
		collection: [],
		inEdit: false,
		factory: {
			name: "",
			stars: 1,
			description: "",
			place: [],
			web: "",
			comodidades: []
		},
		comodidades: {
			map: [],
			add: function(val){
				if(this.map.indexOf(val.id) == -1){
					scp.hoteles.factory.comodidades.push(val);
					this.map.push(val.id);
					console.info('Reporting add:', val);
				}
			},
			rem: function(k,id){
				scp.hoteles.factory.comodidades.splice(k, 1);
				this.map.splice(this.map.indexOf(id), 1);
			}
		},
		format: function(val){
			var collection = [];
			angular.forEach(val,function(el,ind){
				collection.push({
					comodidades: JSON.parse(el.comodidades),
					created_at: el.created_at,
					description: el.description,
					id: el.id,
					name: el.name,
					place: JSON.parse(el.place),
					stars: el.stars,
					updated_at: el.updated_at,
					web: el.web
				});
			});


			return collection;
		},
		create: function(){
			
			var factory = scp.hoteles.factory;
			var params = {
				name: factory.name,
				stars: factory.stars,
				description: factory.description,
				place: JSON.stringify(factory.place),
				web: factory.web,
				comodidades: JSON.stringify(factory.comodidades)
			}
			ajax.hoteles.create(params, function(res){
				scp.hoteles.collection = res;
				scp.uploader_hoteles.clearQueue();
				scp.hoteles.factory = {
					name: "",
					stars: 1,
					description: "",
					place: [],
					web: "",
					comodidades: []
				}
			});
		},
		all: function(){

			ajax.hoteles.all(function(res){
				scp.hoteles.collection = scp.hoteles.format(res);

				console.info('Reporting scp.hoteles.collection:', scp.hoteles.collection );
			});
		},


		/**
		 * funcion para cambiar la cantidad de estrellas
		 */
		changeStars : function(k,num){
			this.factory.stars = num;
		}
	}


	


	scp.$watch(function(){
		return scp.hoteles.factory.place;
	},function(n,o){
		if(n.geometry != undefined){
			gmap.display(n.geometry.location.lat(),n.geometry.location.lng());
		}
	});


}])