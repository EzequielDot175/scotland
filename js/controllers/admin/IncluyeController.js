app.controller('IncluyeController', ['$scope','gmap','FileUploader','ajax', function(scp,map,FileUploader,ajax){

	var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


	scp.uploader = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});

	scp.uploader.onSuccessItem = function(item, res, status, headers){
		scp.form.image = res;
	}
	scp.uploader.onProgressAll = function(progress){
		$('#progress').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader.onAfterAddingFile = function(item){
		scp.uploader.clearQueue();
		scp.uploader.queue.push(item);
	}



	scp.alert = {
		message: '',
		classes:{
			'alert-success' : false,
			'alert-info' : false,
			'alert-warning' : false,
			'alert-danger' : false,
		},
		make: function(type,msg,time){
			angular.forEach(this.classes,function(el,ind){
				console.info(el,ind);
				if(ind.search(type) != -1){
					scp.alert.classes[ind] = true;
				}else{
					scp.alert.classes[ind] = false;
				}
			});

			this.message = msg;
			setTimeout(scp.alert.clear, time || 3000);
		},
		clear: function(){
			scp.$apply(function(){
				angular.forEach(scp.alert.classes,function(el,ind){
					scp.alert.classes[ind] = false;
				});
				scp.alert.message = "";
			});
		}
	}


	scp.incluye = {
		collection: [],
		inEdit: false,
		idEdit: '',
		filter_incluye: '',
		selected_filters: [],
		all: function(){
			ajax.incluye.all(function(res){
				console.info('Reporting collection:', res);
				scp.incluye.collection = res;
			});
		},
		del: function(k,val){
			if(confirm('¿Esta seguro de borrar este item?')){
				ajax.incluye.del(val.id,function(res){
					if(res == "true"){
						scp.incluye.collection.splice(k, 1);
					}
				});
			}
		},
		makeEdit: function(val){	
			val.inEdit = !val.inEdit;
			this.inEdit = val.inEdit;

			if(this.inEdit){

				this.idEdit = val.id;
				scp.form.name = val.name;
				scp.form.image = val.image;
				scp.form.multiple = Boolean(val.multiple);
				scp.options[val.type] = JSON.parse(val.values);
				scp.options.type[val.type] = true;
			}else{
				scp.form.clean();
				scp.incluye.inEdit = false;
			}

		},
		edit: function(){
			var params = scp.factory.dataEdit();
			console.info('Reporting id:', params);
			if(params){
				ajax.incluye.edit(params,function(res){
					if(res == "true"){
						scp.alert.make('success', 'Item modificado correctamente');
						scp.form.clean();
						scp.incluye.inEdit = false;
						scp.incluye.all();
					}
				});
			}
		},
		format_add: function(val){
			var param = {
				image: (val.image.length > 0 ? 'upload/images/'+val.image : ''),
				name: val.name,
				multiple: val.multiple,
				id: val.id,
				type: val.type,
				options: (val.values.length > 0 ? JSON.parse(val.values) : [])
			}
			return param;
		},
		add: function(val){
			this.filter_incluye = "";
			console.info('Reporting this.format_add(val):', this.format_add(val));
			this.selected_filters.push(this.format_add(val));
		},
		rem: function(k){
			this.selected_filters.splice(k, 1);
		},
		dropdown: function(){
			console.log(this.collection);
			if(this.filter_incluye.length < 1){
				return false;
			}else{
				return true;
			}
		}
	}
	


	scp.options = {
		/**
		 * {val:'random', text: 'text'}
		*/
		select: [],
		places:[],
		airports: [],
		type: {
			none: false,
			select: false,
			places: false,
			airports: false
		},
		input_type: '',
		remove: {
			select: function(k){
				scp.options.select.splice(k, 1);
			},
			places: function(k){
				scp.options.places.splice(k, 1);
			},
			airports: function(k){
				scp.options.airports.splice(k, 1);
			}
		},
		changeOption:function(){

			angular.forEach(this.type,function(elem,ind){
				scp.options.type[ind] = false;
			});

			scp.options.type[this.input_type] = true;
		}

	}


	scp.form = {
		image: '',
		name: '',
		multiple: false,
		select: {

			input: '',

			submit: function(){
				if(scp.options.select.indexOf(this.input) ==  -1 && this.input.length > 0){
					scp.options.select.push(this.input);
					this.input = "";
				}
			}

		},
		clean: function(){
			this.name = "";
			this.image = "";
			this.multiple = 0;
			scp.options.select = [];
			scp.options.places =[];
			scp.options.airports = [];
			scp.options.airports = [];
			scp.options.type = {
				none: false,
				select: false,
				places: false,
				airports: false
			}
		},
		places: {
			input: '',
			array_map: [],
			submit: function(){
				if(this.input.geometry != undefined){
					var place = this.input;
					if(this.array_map.indexOf(place.id) == -1){
						// console.info('Reporting place:', place);
						scp.options.places.push({
							lat: place.geometry.location.lat(),
							lng: place.geometry.location.lng(),
							address: place.formatted_address,
							url: place.url,
							name: place.name,
							address_components: place.address_components,
							id: place.place_id
						});
						this.input = "";
						this.array_map.push(place.place_id);

					}
				}
			}
		},
		airports: {
			input: '',
			map_array: [],
			submit: function(){

				if(scp.options.airports.indexOf(this.input.val) == -1 && this.input.length > 0){
					scp.options.airports.push(this.input);
					this.map_array.push(this.input);

					this.input = '';
				}
			}
		}

	}


	scp.factory = {
		error: '',
		get: {
			type: function(){
				var type = '';
				angular.forEach(scp.options.type,function(el,ind){
					if(el){
						type = ind;
						return;
					}
				});

				return type;
			}
		},
		check: {
			image: function(){
				if(scp.form.image.length < 1){
					scp.factory.error += 'Por favor, cargar imagen. \n';
				}
			},
			name: function(){
				if(scp.form.name.length < 1){
					scp.factory.error += 'Falta nombre. \n';
				}
			},
			type: function(){
				if(scp.factory.get.type().length < 1){
					scp.factory.error += 'Falta tipo de dato. \n';
				}
			}
		},
		dataEdit: function(){
			this.error = '';
			this.check.image();
			this.check.name();
			this.check.type();

			if(this.error.length > 0){
				alert(this.error);
				return false;
			}else{
				console.log('creating...');
				console.log(this.get.type());

				var nameOption = this.get.type();
				var param = {
					type: scp.factory.get.type(),
					values: '',
					id: scp.incluye.idEdit,
					image: scp.form.image,
					multiple: (scp.form.multiple ? 1 : 0),
					name: scp.form.name 
				}

				if(nameOption != 'none'){
					param.values = JSON.stringify(scp.options[nameOption]);
				}

				return param;
			}
		},
		create: function(){
			this.error = '';
			this.check.image();
			this.check.name();
			this.check.type();

			if(this.error.length > 0){
				alert(this.error);
			}else{
				console.log('creating...');
				console.log(this.get.type());

				var nameOption = this.get.type();
				var param = {
					type: scp.factory.get.type(),
					values: '',
					image: scp.form.image,
					multiple: (scp.form.multiple ? 1 : 0),
					name: scp.form.name, 
				}

				if(nameOption != 'none'){
					param.values = JSON.stringify(scp.options[nameOption]);
				}

				ajax.incluye.create(param,function(res){
					scp.incluye.collection = res;
					scp.form.clean();
					console.info('Reporting res:', res);
				});
			}
		}


	}


	/**
	 * Watch Map
	 */
	
	scp.$watch(function(){
		return scp.form.places.input;
	},function(n,o){
		if(n.geometry != undefined){
			map.display(n.geometry.location.lat(),n.geometry.location.lng());
		}
	});




	scp.incluye.all();


}])