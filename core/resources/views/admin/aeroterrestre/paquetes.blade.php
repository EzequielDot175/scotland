@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
			@include('admin.inc.nav')
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

			<div class="panel panel-default">
				<div class="panel-body">
					<a href="paquetes/new" type="button" class="btn btn-default">ABM Cargar Nuevo Paquete</a>
					<a href="paquetes/tipos" type="button" class="btn btn-default">ABM Tipos de Paquete</a>
					<a href="paquetes/incluye" type="button" class="btn btn-default">ABM Incluye</a>
					<br>
					<br>
					<input type="search" name="" id="input" class="form-control" value="" required="required" title="">
				</div>
			</div>


			<table class="table table-hover">
				<thead>
					<tr>
						<th>Id Paquete</th>
						<th>Titulo</th>
						<th>Tipo de paquete</th>
						<th>Caducidad</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>


					<tr>
						<td>12</td>
						<td>asdads</td>
						<td>clubmed</td>
						<td>caducidad</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</button>
						</td>
					</tr>

					<tr>
						<td>12</td>
						<td>asdads</td>
						<td>clubmed</td>
						<td>caducidad</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</button>
						</td>
					</tr>

					<tr>
						<td>12</td>
						<td>asdads</td>
						<td>clubmed</td>
						<td>caducidad</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						</td>
						<td>
							<button type="button" class="btn btn-default btn-lg">
							  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</button>
						</td>
					</tr>


				</tbody>
			</table>
		</div>
	</div>

@endsection