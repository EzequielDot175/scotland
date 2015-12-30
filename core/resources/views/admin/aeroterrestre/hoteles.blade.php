@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
			@include('admin.inc.nav')
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ng-controller="HotelsController">
			
			
			<div role="tabpanel">
			    <!-- Nav tabs -->
			    <ul class="nav nav-tabs" role="tablist">
			        <li role="presentation" class="active">
			            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a>
			        </li>
			        <li role="presentation">
			            <a href="#comodidades" aria-controls="comodidades" role="tab" data-toggle="tab">ABM Comodidades</a>
			        </li>
			        <li role="presentation" >
			            <a href="#regimenes" aria-controls="regimenes" role="regimenes" data-toggle="tab">ABM Regimenes</a>
			        </li>
			    </ul>
				
			    <!-- Tab panes -->
			    <div class="tab-content">
			        <div role="tabpanel" class="tab-pane active" id="home">
			        	
						<!-- lista -->
							<h3>ABM Hoteles</h3>
							<input type="text" class="form-control" placeholder="Search" >
							
							<table class="table table-hover" ng-init="hoteles.all();">
								<thead>
									<tr>
										<th>Hotel</th>
										<th>Ubicacion</th>
										<th>Estrellas</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="(key, val) in hoteles.collection">
										<td><% val.name %></td>
										<td><% val.place.formatted_address %></td>
										<td ng-star-rating="<% val.stars %>|6"></td>
										<td>
											<button class="btn btn-default" ng-click="hoteles.edit(key,val)">
												<span class="glyphicon glyphicon-pencil"></span>
											</button>
											<button class="btn btn-default" ng-click="hoteles.del()">
												<span class="glyphicon glyphicon-trash"></span>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						<!-- lista -->
						

						<!--// New Hotel //-->
							
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input type="text" class="form-control" placeholder="Nombre del Hotel" ng-model="hoteles.factory.name">
						</div>
						
						<br>
						<br>
						<br>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<input type="file" class="form-control" nv-file-select uploader="uploader_hoteles" >
							<div class="progress">
									<div class="progress-bar" id="progress-hoteles" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									  <span class="sr-only">0% Complete</span>
									</div>
							</div>
							
							<h3>Cantidad de estrellas</h3>
							<br>
							<div ng-star-rating="<% hoteles.factory.stars %>|6" ng-star-action="hoteles.changeStars"></div>

						</div>

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<!-- Preview Image -->
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<label for="">Descripción</label>
							<textarea name="" id="" cols="30" rows="10" class="form-control" ng-model="hoteles.factory.description"></textarea>
							<br>
							<br>

							<label for="">Ubicacion</label>
							<input type="text" name="" ng-model="hoteles.factory.place" class="form-control" g-places-autocomplete="" autocomplete="off" >
							<div id="maps"></div>

							<br>
							<br>
							<label for="">Direccion Web</label>
							<input type="text" name="" ng-model="hoteles.factory.web" class="form-control"  >

							<br>
							<br>

							<div class="dropdown">
								<label for="">Comodidades</label>
								<input type="text" class="form-control" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ng-model="search_input">
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" >
								    <li ng-repeat="(key, val) in comodidades.collection | filter:search_input"><a href="#" ng-click="hoteles.comodidades.add(val)"><% val.name %></a></li>
								  </ul>
							</div>
							<ul class="list-group">
							  <li class="list-group-item" ng-repeat="(k, v) in hoteles.factory.comodidades">
							    <% v.name %>
							    <span class="glyphicon glyphicon-trash" style="cursor: pointer;" ng-click="hoteles.comodidades.rem(k,val.id)"></span>
							  </li>
							</ul>

							<button type="button" class="btn btn-default" ng-click="hoteles.create()">Guardar</button>
							<button type="button" class="btn btn-default" ng-click="hoteles.edit()" ng-show="hoteles.inEdit">Editar</button>
						</div>
						

						<!--// New Hotel //-->


			        </div>
			        <div role="tabpanel" class="tab-pane" id="comodidades" ng-init="comodidades.all();">
			        	<!-- lista -->
							<h3>ABM Comodidades</h3>
							<input type="text" class="form-control" placeholder="Search" >
							
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Icono</th>
										<th>Nombre</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="(key, val) in comodidades.collection">
										<td>
											<img height="40" ng-src="{{asset('upload/images')}}/<% val.icon %>" alt="Icono">
										</td>
										<td><% val.name %></td>
										<td>
											<button class="btn btn-default" ng-click="comodidades.makeEdit(val);">
												<span class="glyphicon glyphicon-pencil"></span>
											</button>
											<button class="btn btn-default" ng-click="comodidades.del(key,val)">
												<span class="glyphicon glyphicon-trash"></span>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						<!-- lista -->

						<!-- new -->
							<form role="form" ng-submit="comodidades.add();" ng-show="!comodidades.inEdit">
							
								<div class="form-group">
									<label for="">Nombre de comodidad</label>
									<input type="text" class="form-control" placeholder="Nombre de la comodidad" ng-model="comodidades.factory.name" >
									<input type="file" class="form-control" nv-file-select uploader="uploader" >
									<div class="progress">
									  <div class="progress-bar" id="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    <span class="sr-only">0% Complete</span>
									  </div>
									</div>
								</div>
							
								<button type="submit" class="btn btn-primary">Crear Comodidad</button>
							</form>
						<!-- new -->

						<!-- edit -->
							<form role="form" ng-submit="comodidades.edit();" ng-show="comodidades.inEdit">
							
								<div class="form-group">
									<label for="">Nombre de comodidad</label>
									<input type="text" class="form-control" placeholder="Nombre de la comodidad" ng-model="comodidades.inEditItem.name" >
									<img ng-src="{{asset('upload/images')}}/<% comodidades.inEditItem.icon %>" alt="Icon" ng-if="comodidades.inEdit" height="40">
									<input type="file" class="form-control" nv-file-select uploader="uploader_edit" >
									<div class="progress">
									  <div class="progress-bar" id="progress-edit" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    <span class="sr-only">0% Complete</span>
									  </div>
									</div>
								</div>
							
								<button type="submit" class="btn btn-primary">Editar Comodidad</button>
							</form>
						<!-- edit -->


			        </div>
			        <div role="tabpanel" class="tab-pane" id="regimenes">
			        	3
			        </div>
			    </div>
			</div>
			
		</div>
	</div>

@endsection