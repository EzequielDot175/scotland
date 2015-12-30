app.controller('AeroController', ['$scope', function(scp){
	scp.departure = [];
	scp.inputDeparture = "";
	scp.place = null;
	scp.places = [];
	scp.itinerario = [];
	scp.google_place = [];
	scp.convertibilidad = [];
	
	scp.aerocreatepackage = function(){

	}

	


	scp.addDeparture = function(){
		if(scp.inputDeparture == ""){
			alert('Por favor seleccione una fecha de salida.');
			return;
		}
		var date =  new Date(scp.inputDeparture);
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		var object = {date: day+"/"+month+"/"+year, data: date};
		scp.departure.push(object);
		scp.inputDeparture = "";
	}

	/**
	 * Onclick: agrego dias para itinerario
	 */

	scp.addDay = function(){
		scp.itinerario.push({value: '',places: [],title: 'Dia '+scp.itinerario.length + 1, day: scp.itinerario.length + 1});
		console.info('Reporting :', scp.itinerario);
	}


	scp.addPlace = function(k){

		if(scp.places[k] == undefined){
			scp.places[k] = [];
		}


		var map = scp.google_place[k];
		delete map['adr_address'];
		delete map['formatted_address'];
		delete map['geometry'];
		delete map['html_attributions'];
		delete map['icon'];
		delete map['reference'];
		delete map['scope'];

		var exist = false;
		angular.forEach(scp.places,function(elem, index){
			if(map.id == elem.id){
				exist = true;
			}
		});

		if(!exist){
			scp.places[k].push(map);
		}
		scp.google_place[k] = "";
	}

	scp.AddConv = function(){
		scp.convertibilidad.push({money: '',value: 0.00});
	}

}])