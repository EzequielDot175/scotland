@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
			@include('admin.inc.nav')
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ng-controller="IncluyeController">

			<div class="panel panel-default">
				<div class="panel-body">
					<a href="new" type="button" class="btn btn-default">ABM Cargar Nuevo Paquete</a>
					<a href="tipos" type="button" class="btn btn-default">ABM Tipos de Paquete</a>
					<a href="#" type="button" class="btn btn-default">ABM Incluye</a>
					<br>
					<br>
				</div>
			</div>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre incluye</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(key, val) in incluye.collection" ng-init="val.inEdit = false">
						<td><% val.id %></td>
						<td><% val.name %></td>
						<td>
							<button ng-click="incluye.makeEdit(val)" type="button" class="btn btn-default btn-lg" title="<% (val.inEdit ? 'Confirmar' : 'Editar') %>" >
							  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							</button>
							<button ng-click="incluye.del(key,val)" type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
				</tbody>
			</table>



			<div class="alert" ng-class="alert.classes" role="alert"><% alert.message %></div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

				<input type="text" name="" class="form-control" value="" required="required" ng-model="form.name" placeholder="Nombre del incluye">

				<div class="form-group">
					<label for="">Carga de icono</label>
					<input type="file" class="form-control" nv-file-select uploader="uploader" >
					<div class="progress">
					  <div class="progress-bar" id="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					    <span class="sr-only">0% Complete</span>
					  </div>
					</div>
				</div>

			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<img ng-src="{{url('/upload/images')}}/<% form.image %>" height="200" width="200" alt="<% incluye.image %>">
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3>Tipos de opciones incluye</h3>

				<div class="form-group">
					<input type="radio" name="typeOption" value="none" ng-model="options.input_type"  ng-change="options.changeOption()" >
					<p>Sin Opciones</p>
				</div>
				<div class="form-group">
					<input type="radio" name="typeOption" value="select" ng-model="options.input_type" ng-change="options.changeOption()" >
					<p>Tipo Select</p>
					<br>
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-show="options.type.select">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<label for="">Seleccion Multiple</label>
							<input type="checkbox" value="1" ng-model="form.multiple" />
							<form  ng-submit="form.select.submit()">
								<br>
								<input type="text" name="" id="input" class="form-control" value="" ng-model="form.select.input" required="required"  placeholder="Valor del campo">
								<br>
								<button type="submit" class="btn btn-primary">Agregar opción</button>
							</form>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							
							<ul class="list-group">
							  <li class="list-group-item" ng-repeat="(key, value) in options.select">
							    <span class="badge"><a href="#" ng-click="options.remove.select(key)"><span class="glyphicon glyphicon-remove"></span></a></span>
							    	<% value %>
							  </li>
							</ul>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<input type="radio" name="typeOption" value="places" ng-model="options.input_type"  ng-change="options.changeOption()" >
					<p>Tipo Google Maps</p>

					<div class="form-group" ng-show="options.type.places">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<form ng-submit="form.places.submit()">
									<input type="text" g-places-autocomplete autocomplete="off"  ng-model="form.places.input" id="input" class="form-control">
									<br>
									<button type="submit" class="btn btn-primary">Agregar</button>
								</form>
							</div>

							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<div id="maps" style="height:300px;"></div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<ul class="list-group">
								  <li class="list-group-item" ng-repeat="(key, value) in options.places">
								    <span class="badge"><a href="#" ng-click="options.remove.places(key)"><span class="glyphicon glyphicon-remove"></span></a></span>
								    	<% value.address %>
								  </li>
								</ul>
							</div>

						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="radio" name="typeOption" value="airports" ng-model="options.input_type" ng-change="options.changeOption()" >
					<p>Tipo de Aeropuertos (Seleccion multiple)</p>

					<div class="form-group" ng-show="options.type.airports">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<form ng-submit="form.airports.submit()">
									<input placeholder="Nombre de la opcion" type="text" ng-model="form.airports.input" class="form-control" required="required">
									<br>
									<button type="submit" class="btn btn-primary">Agregar</button>
								</form>
							</div>

							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<ul class="list-group">
								  <li class="list-group-item" ng-repeat="(key, value) in options.airports">
								    <span class="badge"><a href="#" ng-click="options.remove.airports(key)"><span class="glyphicon glyphicon-remove"></span></a></span>
								    	<% value %>
								  </li>
								</ul>
							</div>

						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-primary" ng-if="!incluye.inEdit" ng-click="factory.create()">Crear</button>
				<button type="submit" class="btn btn-primary" ng-if="incluye.inEdit" ng-click="incluye.edit()">Editar</button>

			</div>

		</div>
	</div>

@endsection