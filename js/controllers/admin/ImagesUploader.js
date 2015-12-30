app.controller('ImagesUploader', ['$scope','ajax','FileUploader', function(scp,ajax,FileUploader){

	var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	scp.galery = [];
	scp.uploader = new FileUploader({
	    // your code here...
	    url: '/ajax/images',
	    headers : {
	        'X-CSRF-TOKEN': csrf_token 
	    },
	    //...
	});



	scp.getScope = function(scope){
		scope.formData.push({name: 'image'+Math.random()});
		console.info('Reporting scope file:', scope);
	}

	scp.uploader.onSuccessItem = function(item, response, status, headers){
		console.info('Reporting response:', response);
	}


	scp.uploader.onBeforeUploadItem = function(item){
		item.formData[0] = {
			method: 'fileUpload',
			tags: item.tags.join(',') || '';
		};
	}


	scp.addTag = function(item,string){
		if (item.tags.indexOf(string) == -1) {
			item.tags.push(string);
		};
	}

	scp.lookScope = function(){
		console.info('Reporting scp.uploader:', scp.uploader);
		
	}


}]);