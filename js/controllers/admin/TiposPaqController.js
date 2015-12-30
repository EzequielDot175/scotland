app.controller('TiposPaqController', ['$scope','ajax', function(scp,ajax){
	
	scp.tipos = {
			collection: [],
			name: '',

			all: function(){
				ajax.tipos.all(function(data){
					scp.tipos.collection = data;
				});
			},

			create: function(){
				if(scp.tipos.name.length > 0){
					ajax.tipos.create({name: scp.tipos.name},function(data){
						if(data != "false"){
							scp.tipos.collection = data;
						}
					});
				}
			},
			edit: function(val){
				if(!val.disabled){
					if(val.name.length > 0){
						ajax.tipos.edit({id: val.id, name: val.name},function(res){
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
				if(confirm('¿Esta seguro que desea borrar este tipo de paquete?')){
					ajax.tipos.del(val.id, function(res){
						// console.info('Reporting res:', res);
						if(res != 'true'){
							alert(res);
						}else{
							scp.tipos.collection.splice(key, 1);
						}
					});
				}
			}
		}

	scp.tipos.all();

}])