app.controller('PromocionesController', ['$scope','ajax','FileUploader', function(scp,ajax,FileUploader){
	
	var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	
	scp.uploader_promociones = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});

	scp.uploader_edit_promociones = new FileUploader({
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    autoUpload: true,
	    queueLimit: 2
	});

	scp.uploader_promociones.onSuccessItem = function(item, res, status, headers){
		scp.promociones.input.image = res;
	}
	scp.uploader_promociones.onProgressAll = function(progress){
		$('#progress').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader_edit_promociones.onSuccessItem = function(item, res, status, headers){
		scp.promociones.inputEdit.image = res;
	}
	scp.uploader_edit_promociones.onProgressAll = function(progress){
		$('#progress-edit').width(progress+'%').attr('aria-valuenow', progress);
	}

	scp.uploader_promociones.onAfterAddingFile = function(item){
		scp.uploader_promociones.clearQueue();
		scp.uploader_promociones.queue.push(item);
	}


	scp.promociones = {
			collection: [],
			inEdit: false,
			input: {
				name: '',
				image: '',
				expireInput: '',
				expire: '',
				description: '',
				percent: 0,
				number: 0,
			},
			inputEdit:{
				name: '',
				image: '',
				expireInput: '',
				expire: '',
				description: '',
				percent: 0,
				number: 0,
			},
			all : function(){
				ajax.promociones.all(function(res){
					scp.promociones.collection =  res;
				});
			},
			create: function(){
				this.formatDate();
				ajax.promociones.create(this.input,function(res){
					console.info('Reporting res:', res);
					scp.promociones.collection =  res;
					scp.promociones.clean();
				});
			},
			del: function(val,key){
				if(confirm('¿Esta seguro que desea borrar este impuesto?')){
					ajax.promociones.del(val.id, function(res){
						if(res != 'true'){
							alert(res);
						}else{
							scp.promociones.collection.splice(key, 1);
						}
					});
				}
			},
			edit: function(val){
				val.disabled = !val.disabled;
				this.inEdit = !this.inEdit;
				this.inputEdit = {
					name: val.name,
					image: val.image,
					expireInput: this.formatReverse(val.expire),
					expire: val.expire,
					description: val.description,
					percent: val.percent,
					number: val.number,
					id: val.id
				}
				console.info('Reporting in edit:', this.inputEdit);
			},
			formatDate: function(){
				if(this.input.expireInput.length > 0){
					var expire = this.input.expireInput.split('/');
					this.input.expire = expire.reverse().join('-');
				}
			},
			formatEditDate: function(){
				if(this.inputEdit.expireInput.length > 0){
					var expire = this.inputEdit.expireInput.split('/');
					this.inputEdit.expire = expire.reverse().join('-');
				}
			},
			formatReverse: function(input){
				var reverse = "";
				if(input.length > 0){
					var expire = input.split('-');
					console.info('Reporting expire:', expire);
					result = expire.reverse().join('/');
					console.info('Reporting expire result:', result);

				}
				return result;
			},
			editForm: function(){
				this.formatEditDate();
				console.info('Reporting editForm:', this.inputEdit);
				
				ajax.promociones.edit(this.inputEdit,function(res){
					if (res == 'true') {
						scp.promociones.cleaEdit();
						scp.promociones.allOfEdit();
					};
					console.info('Reporting result edit:', res);
					// scp.promociones.collection =  res;
				});
			},
			active: function(val){
				ajax.promociones.activate(val.id, ((val.active + 1) % 2), function(res){
					if(res == "true"){
						val.active = ((val.active + 1) % 2);
					}
					// console.info('response  activate:', res);
				});
			},
			clean: function(){
				angular.forEach( this.input,function(value, key){
					scp.promociones.input[key] = "";
				});
				scp.uploader_promociones.clearQueue();
			},
			allOfEdit: function(){
				angular.forEach(this.collection,function(value, key){
					value.inEdit = false;
				});
			},
			cleaEdit: function(){
				angular.forEach( this.inputEdit,function(value, key){
					scp.promociones.inputEdit[key] = "";
				});
				scp.uploader_edit_promociones.clearQueue();
				this.inEdit = !this.inEdit;
			}

		}

	scp.promociones.all();
}])