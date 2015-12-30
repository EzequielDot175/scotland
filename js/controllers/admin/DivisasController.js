app.controller('DivisasController', ['$scope','ajax', function(scp,ajax){
	
	scp.divisas = {
			collection: [],
			input: {
				name: '',
				value: ''
			},
			all: function(){
				ajax.divisas.all(function(data){
					scp.divisas.collection = data;
				});
			},
			edit: function(val){
				if(!val.disabled){
					if(val.name.length > 0){
						ajax.divisas.edit({id: val.id, name: val.name, value:val.value},function(res){
							if(res.trim() == 'true'){
								val.disabled = true;
							}
						});
					}
				}else{
					val.disabled = false;
				}
			},
			del: function(val,key){
				if(confirm('¿Esta seguro que desea borrar esta divisa?')){
					ajax.divisas.del(val.id, function(res){
						if(res != 'true'){
							alert(res);
						}else{
							scp.divisas.collection.splice(key, 1);
						}
					});
				}
			},
			create: function(){
				ajax.divisas.create(this.input,function(data){
					scp.divisas.collection = data;
				});
			}
		}

	scp.divisas.all();

}])