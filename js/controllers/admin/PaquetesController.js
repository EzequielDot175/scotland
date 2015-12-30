app.controller('PaquetesController', ['$scope','ajax','FileUploader', function(scp,ajax,FileUploader){

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
		scp.factory.image = res;
	}
	scp.uploader.onProgressAll = function(progress){
		$('#progress').width(progress+'%').attr('aria-valuenow', progress);
	}
	scp.uploader.onAfterAddingFile = function(item){
		scp.uploader.clearQueue();
		scp.uploader.queue.push(item);
	}


	scp.factory = {
		typePackage: "",
		title: "",
		image: "",
		description: "",
		image: "",
		tags: [],
		incluye: {
			places: null,
			airports: null,
			none: null,
			select: null
		}
	}


}]);