@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
			@include('admin.inc.nav')
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ng-controller="TiposPaqController">
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Nombre</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(key, val) in tipos.collection">
						<td><% val.id %></td>
						<td><input type="text" ng-model="val.name" class="form-control" value="" required="required" ng-init="val.disabled = true" ng-disabled="val.disabled">	 </td>
						<td>
							<button type="button" class="btn btn-default btn-lg" ng-click="tipos.edit(val)">
							  <span class="glyphicon" ng-class="{'glyphicon-save' : !val.disabled, 'glyphicon-pencil': val.disabled}" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-lg" ng-click="tipos.del(val,key)">
							  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
				</tbody>
			</table>

			<form role="form" ng-submit="tipos.create()">
				<legend>Crear tipo</legend>
			
				<div class="form-group">
					<label for="">Nombre de la categoria</label>
					<input ng-model="tipos.name" type="text" class="form-control" id="" placeholder="Nombre de la categoria">
				</div>
			
				
				

				<button type="submit" class="btn btn-primary">Crear</button>


			</form>


		</div>
	</div>

@endsection