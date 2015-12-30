@extends('admin.inc.layout')

@section('content')

<style>
	.image-selected-active{
		border: 2px solid red;
	}
</style>
<section ng-controller="ImagesUploader" class="container-fluid">
	

	<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h3>Subir imagenes</h3>
		
		<div>
			<input type="file" nv-file-select uploader="uploader" >
			
			

			<div class="queue col-xs-3 col-sm-3 col-md-3 col-lg-3" ng-repeat="(kitem,item) in uploader.queue">
				<div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }">
	            		<canvas width="100" height="100" class="thumbnail"></canvas>
	            	</div>
	            	<br>
	            	<div class="tags" ng-init="item.tags = []">
	            		<span ng-repeat="(ktag,tag) in item.tags" class="label label-primary"><% tag %> <a ng-click="item.tags.splice(1,ktag)" href="#">x</a></span>
	            		
	            	</div>
	            	<br>
	            	<input type="text" ng-model="item.inputTag" class="form-control">
					<button ng-click="addTag(item,item.inputTag)" class="form-control">Agregar tag</button>

	            	<p><% item.file.name %></p>
	                <button ng-click="item.upload()">upload</button>
	                <button ng-click="scope(item)">scope</button>
			</div>

			
		</div>
	</article>

	<article  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h3>Imagenes disponibles</h3>
		
		<div ng-repeat="(key, value) in galery" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<p><% value.name %></p>
			<img  image-selectable="galery" ng-src="<% value.url %>" alt="<% value.name %>" class="thumbnail" width="100%" >
		</div>

	</article>


</section>

@endsection