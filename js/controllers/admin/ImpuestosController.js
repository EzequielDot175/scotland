app.controller('ImpuestosController', ['$scope','ajax', function(scp,ajax){
	
	scp.impuestos = {
			collection: [],
			input: {
				name: '',
				percent: ''
			},
			all: function(){
				ajax.impuestos.all(function(data){
					scp.impuestos.collection = data;
				});
			},
			edit: function(val){
				if(!val.disabled){
					if(val.name.length > 0){
						ajax.impuestos.edit({id: val.id, name: val.name, percent:val.percent},function(res){
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
				if(confirm('¿Esta seguro que desea borrar este impuesto?')){
					ajax.impuestos.del(val.id, function(res){
						if(res != 'true'){
							alert(res);
						}else{
							scp.impuestos.collection.splice(key, 1);
						}
					});
				}
			},
			create: function(){
				ajax.impuestos.create(this.input,function(data){
					scp.impuestos.collection = data;
				});
			}
		}
	scp.impuestos.all();

}])