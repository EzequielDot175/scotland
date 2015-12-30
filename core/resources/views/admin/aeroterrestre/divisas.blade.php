@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
			@include('admin.inc.nav')
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
			
			<div role="tabpanel">
			    <!-- Nav tabs -->
			    <ul class="nav nav-tabs" role="tablist">
			        <li role="presentation" class="active">
			            <a href="#cambio" aria-controls="cambio" role="tab" data-toggle="tab">ABM Tipos de cambio</a>
			        </li>
			        <li role="presentation" >
			            <a href="#impuestos" aria-controls="impuestos" role="tab" data-toggle="tab">ABM Impuestos</a>
			        </li>
			        <li role="presentation" >
			            <a href="#promociones" aria-controls="promociones" role="tab" data-toggle="tab">ABM Promociones</a>
			        </li>

			    </ul>
			
			    <!-- Tab panes -->
			    <div class="tab-content" >
			        <div role="tabpanel" class="tab-pane active" id="cambio" ng-controller="DivisasController">
			        	<!-- Tipos de cambio -->

						<table class="table table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Nombre</th>
									<th>Valor</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="(key, val) in divisas.collection">
									<td><% val.id %></td>
									<td><input type="text" ng-model="val.name" class="form-control" value="" required="required" ng-init="val.disabled = true" ng-disabled="val.disabled">	 </td>
									<td><input type="number" step="0.01" ng-model="val.value" class="form-control" value="" required="required" ng-init="val.disabled = true" ng-disabled="val.disabled">	 </td>
									<td>
										<button type="button" class="btn btn-default btn-lg" ng-click="divisas.edit(val)">
										  <span class="glyphicon" ng-class="{'glyphicon-save' : !val.disabled, 'glyphicon-pencil': val.disabled}" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="divisas.del(val,key)">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</button>
									</td>
								</tr>
							</tbody>
						</table>

						<form role="form" ng-submit="divisas.create()">
							<legend>Crear tipo</legend>
						
							<div class="form-group">
								<label for="">Nombre de la divisa</label>
								<input ng-model="divisas.input.name" type="text" class="form-control"  >
							</div>
							<div class="form-group">
								<label for="">Valor de la divisa</label>
								<input ng-model="divisas.input.value" type="number" step="0.01" class="form-control"  >
							</div>
						
							<button type="submit" class="btn btn-primary">Crear</button>
						</form>

			        	<!-- Tipos de cambio -->
			        </div>
			        <div role="tabpanel" class="tab-pane" id="impuestos" ng-controller="ImpuestosController">
			        	<!-- Tipos de cambio -->

						<table class="table table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Nombre</th>
									<th>Valor</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="(key, val) in impuestos.collection" ng-init="val.disabled = true" >
									<td><% val.id %></td>
									<td><input type="text" ng-model="val.name" class="form-control" value="" required="required" ng-disabled="val.disabled">	 </td>
									<td><input type="number" step="0.01" ng-model="val.percent" class="form-control" value="" required="required" ng-disabled="val.disabled">	 </td>
									<td>
										<button type="button" class="btn btn-default btn-lg" ng-click="impuestos.edit(val)">
										  <span class="glyphicon" ng-class="{'glyphicon-save' : !val.disabled, 'glyphicon-pencil': val.disabled}" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="impuestos.del(val,key)">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</button>
									</td>
								</tr>
							</tbody>
						</table>

						<form role="form" ng-submit="impuestos.create()">
							<legend>Crear Impuesto</legend>
						
							<div class="form-group">
								<label for="">Nombre del impuesto</label>
								<input ng-model="impuestos.input.name" type="text" class="form-control"  >
							</div>
							<div class="form-group">
								<label for="">Valor del porcentaje</label>
								<input ng-model="impuestos.input.percent" type="number" step="0.01" class="form-control"  >
							</div>
						
							<button type="submit" class="btn btn-primary">Crear</button>
						</form>

			        	<!-- Tipos de cambio -->
			        </div>
			        <div role="tabpanel" class="tab-pane" id="promociones" ng-controller="PromocionesController">
			        	<!-- Tipos de cambio -->

						<table class="table table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Nombre</th>
									<th>Caducidad</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="(key, val) in promociones.collection" ng-init="val.disabled = true" ng-disabled="val.disabled">
									<td><% val.id %></td>
									<td><% val.name %></td>
									<td><% val.expire |  date : "dd/MM/yyyy"  %></td>
									<td>
										<button type="button" class="btn btn-default btn-lg" ng-click="promociones.edit(val)">
										  <span class="glyphicon" ng-class="{'glyphicon-save' : !val.disabled, 'glyphicon-pencil': val.disabled}" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="promociones.active(val)" >
										  <span class="glyphicon" ng-class="{'glyphicon-ok' : (val.active == 1), 'glyphicon-off': (val.active == 0)}" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="promociones.del(val,key)">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
						<!-- Create -->
						<form role="form" ng-submit="promociones.create()" ng-show="!promociones.inEdit">
							<legend>Crear Impuesto</legend>
						
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="">Nombre de promocion</label>
									<input ng-model="promociones.input.name" type="text" class="form-control"  >
								</div>
							</div>	
							 <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<div class="form-group">
									<label for="">Logo</label>
									<input type="file" class="form-control" uploader="uploader_promociones" nv-file-select>
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress"> </div>
									</div>
									<label for="">Fecha de caducidad</label>
									<input type="text" class="datepicker form-control" ng-model="promociones.input.expireInput">
								</div>
							 </div>
							 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							 	<div ng-repeat="(key, item) in uploader_promociones.queue" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div ng-show="uploader_promociones.isHTML5" ng-thumb="{ file: item._file, height: 100 }">
					            		<canvas width="100" height="100" class="thumbnail"></canvas>
					            	</div>
								</div>
								
							 </div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="">Beneficio aplicable al valor del producto (%)</label>
									<input type="text" class="form-control" ng-model="promociones.input.percent">
									<label for="">Beneficio aplicable al valor del producto (en $)</label>
									<input type="text" class="form-control" ng-model="promociones.input.number">
									<label for="">Descripcion</label>
									<input type="text" class="form-control" ng-model="promociones.input.description">
								</div>
								<button type="submit" class="btn btn-primary">Crear</button>
							</div>
						</form>
						<!-- End Create -->
						
						<!-- Edit -->
						<form role="form" ng-submit="promociones.editForm()" ng-show="promociones.inEdit">
							<legend>Editar Impuesto</legend>
						
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="">Nombre de promocion</label>
									<input ng-model="promociones.inputEdit.name" type="text" class="form-control"  >
								</div>
							</div>	
							 <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<div class="form-group">
									<label for="">Logo</label>
									<input type="file" class="form-control" uploader="uploader_edit_promociones" nv-file-select>
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress-edit"> </div>
									</div>
									<label for="">Fecha de caducidad</label>
									<input type="text" class="datepicker form-control" ng-model="promociones.inputEdit.expireInput">
								</div>
							 </div>
							 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							 	<div ng-repeat="(key, item) in uploader_edit_promociones.queue" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div ng-show="uploader_promociones.isHTML5" ng-thumb="{ file: item._file, height: 100 }">
					            		<canvas width="100" height="100" class="thumbnail"></canvas>
					            	</div>
								</div>
								<a href="#" class="thumbnail" ng-show="uploader_edit_promociones.queue.length == 0">
									<img ng-src="{{url('/upload/images')}}/<% promociones.inputEdit.image %>" alt="">
								</a>
							 </div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="">Beneficio aplicable al valor del producto (%)</label>
									<input type="text" class="form-control" ng-model="promociones.inputEdit.percent">
									<label for="">Beneficio aplicable al valor del producto (en $)</label>
									<input type="text" class="form-control" ng-model="promociones.inputEdit.number">
									<label for="">Descripcion</label>
									<input type="text" class="form-control" ng-model="promociones.inputEdit.description">
								</div>
								<button type="submit" class="btn btn-primary">Editar</button>
							</div>
						</form>
						<!-- End Edit -->
		
			        </div>
			    </div>
			</div>

		</div>
	</div>

@endsection