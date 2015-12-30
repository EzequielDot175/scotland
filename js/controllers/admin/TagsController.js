app.controller('tagsController', ['$scope','ajax','$filter', function(scp,ajax,filter){
	
	scp.tags =   {
			collection: [],
			search_result: [],
			input: '',
			name: '',
			displayList: function(){
				
				if (this.search_result.length > 0 && this.input.length > 0) {
					return {'display':'block'};
				}else{
					return {'display':'none'};
				}
			},
			add: function(val){
				scp.$parent.factory.tags.push(val);
				this.input = "";
			},
			searchObject: function(search){
				// angular.forEach(this.collection,function(){

				// });
			},
			search: function(){
				var result =  filter('filter')(this.collection,this.input);
				/**
				 * Delete clone
				 */
				 
				angular.forEach(scp.$parent.factory.tags,function(elem,ind){
					angular.forEach(result,function(elem1,ind1){
						if(elem == elem1){
							result.splice(ind1, 1);
						}
					});
				});

				this.search_result = result;
			},
			all: function(){
				ajax.tags.all(function(data){
					console.info('Reporting tags:', data);
					scp.tags.collection = data;
				});
			},
			create: function(){
				if(scp.tags.name.length > 0){
					ajax.tags.create({name:this.name},function(data){
						if(data != "false"){
							scp.tags.collection = data;
						}
					});
				}
			},
			edit: function(val){
				if(!val.disabled){
					if(val.name.length > 0){
						ajax.tags.edit({id: val.id, name: val.name},function(res){
							if(res.trim() == 'true'){
								val.disabled = true;
							}
						});
					}
				}else{
					val.disabled = false;
				}
			},
			removeTag: function(k){
				scp.$parent.factory.tags.splice(k, 1);
			},
			del: function(val,key){
				if(confirm('¿Esta seguro que desea borrar este tipo de paquete?')){
					ajax.tags.del(val.id, function(res){
						if(res != 'true'){
							alert(res);
						}else{
							scp.tags.collection.splice(key, 1);
						}
					});
				}
			}
			
		}

	scp.tags.all();

}])