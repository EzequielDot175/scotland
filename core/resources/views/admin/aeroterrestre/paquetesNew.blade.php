@extends('admin.inc.layout')

@section('content')

	<div class="container-fluid" ng-controller="AeroController">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
				@include('admin.inc.nav')
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ng-controller="PaquetesController">

				<div role="tabpanel">
				    <!-- Nav tabs -->
				    <ul class="nav nav-tabs" role="tablist">
				        <li role="presentation" class="active">
				            <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Tipos de paquete</a>
				        </li>
				        <li role="presentation">
				            <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Informacion General</a>
				        </li>
				        <li role="presentation">
				            <a href="#hoteles" aria-controls="tab2" role="tab" data-toggle="tab">Hoteles</a>
				        </li>
				        <li role="presentation">
				            <a href="#tab4" aria-controls="tab3" role="tab" data-toggle="tab">Fechas</a>
				        </li>
				        <li role="presentation">
				            <a href="#tab5" aria-controls="tab4" role="tab" data-toggle="tab">Itinerario</a>
				        </li>
				        <li role="presentation">
				            <a href="#tab6" aria-controls="tab5" role="tab" data-toggle="tab">Galeria de imagenes</a>
				        </li>
				    </ul>
				
					
				    <!-- Tab panes -->
				    <div class="tab-content">
				        <div role="tabpanel" class="tab-pane active" id="tab1" ng-controller="TiposPaqController" >
				        	<!-- Tipos de paquetes -->
				        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" ng-repeat="(key, val) in tipos.collection">
					        	<div class="input-group">
							    	<label for="" class="form-control"  ><% val.name %></label>
							    	<input type="radio" class="form-control" ng-value="val" name="typePackage" ng-model="$parent.factory.tipo_de_paquete">
							    </div>
				        	</div>
				        </div>
				        <div role="tabpanel" class="tab-pane" id="tab2" >
				        	<!-- tab 2 -->
						
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="">Titulo</label>
										<input type="text" class="form-control" id="" ng-model="$parent.factory.title">
									</div>
								</div>
								
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<div class="input-group">
										<input type="file" class="form-control" nv-file-select uploader="uploader"  placeholder="Amount">
										
									</div>
									<div class="progress">
										  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="progress">
										    <span class="sr-only">Upload</span>
										  </div>
										</div>
									<div ng-controller="tagsController">
										
										<div class="input-group" >
											<div class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></div>
											<input type="text" class="form-control" placeholder="Agregar tags" ng-model="tags.input" ng-change="tags.search()">
										</div>
										<div class="input-group">
											<ul class="dropdown-menu" ng-style="tags.displayList()">
											  <li ng-repeat="(key, val) in tags.search_result"><a href="#" ng-click="tags.add(val)"><% val.name %></a></li>
											</ul>
										</div>
										<div class="input-group">
											<span ng-repeat="(key, val) in factory.tags" class="label label-default">
												<% val.name %> 
											<button ng-click="tags.removeTag(key)">x</button> </span>
										</div>
									</div>

								</div>

								<div ng-repeat="(key, item) in uploader.queue" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }">
					            		<canvas width="100" height="100" class="thumbnail"></canvas>
					            	</div>
								</div>



								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="input-group">
										<label for="">Descripción</label>
										<textarea name="" id="input" class="form-control" rows="3" required="required" ng-model="factory.description"></textarea>
									</div>
								</div>


								
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-controller="IncluyeController">
									
									<h3>Incluye</h3>
									<div class="input-group">
										<input type="text" class="form-control dropdown-toggle" ng-model="incluye.filter_incluye" placeholder="Search"  type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										 <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" ng-if="incluye.dropdown();">
										    <li ng-repeat="(key, val) in incluye.collection | filter: incluye.filter_incluye "><a href="#" ng-click="incluye.add(val)"><% val.name %></a></li>
										  </ul>
									</div>

									<div class="list-group" ng-repeat="(key, val) in incluye.selected_filters">
									<br>
										<!-- <a href="#" class="list-group-item"> -->
											<h4 class="list-group-item-heading"><% val.name %></h4>
											<select ng-options="opt.id as opt.address for opt in val.options"
													ng-model="val[val.type]"
													ng-if="val.type == 'places'" 
													ng-multiple="<% val.multiple %>">
												<option value="">Seleccionar</option>
											</select>

											<select ng-options="opt for opt in val.options"
													ng-model="val[val.type]"
													ng-if="val.type == 'select' || val.type == 'airports'" 
													ng-multiple="<% val.multiple %>">
												<option value="">Seleccionar</option>
											</select>

											<button type="button" class="btn btn-default" ng-click="incluye.rem(key)"><span class="glyphicon glyphicon-remove"></span></button>
										<!-- </a> -->
									</div>

								</div>

				        	<!-- tab 2 -->
				        </div>

				        <div role="tabpanel" class="tab-pane" id="hoteles">

				        	<!-- <div class="row">

								<div class="input-group">
								  <div class="input-group-btn">
								 	<select name="" id="" class="form-control"></select>
								  </div>
								 
								</div>

				        	</div> -->

				        </div>
				        <div role="tabpanel" class="tab-pane" id="tab3">
				        	<!-- tab 3 -->
				        	<!-- <ul class="list-group">
				        		<li class="list-group-item">
				        			<legend>Fechas de salida</legend>
				        			<div class="input-group" ng-repeat="(key, val) in paquetes.dates.collection">

				        				<label for="" class="form-control">Fecha de salida</label>
				        				<input type="date" class="form-control" ng-model="val.salida">

				        				<label for="" class="form-control">Fecha de regreso</label>
				        				<input type="date" class="form-control" ng-model="val.regreso">

				        				<label for="" class="form-control">Fecha de caducidad</label>
				        				<input type="date" class="form-control" ng-model="val.caducidad">

				        				<label for="" class="form-control">Fecha no especifica</label>
				        				<input type="text" class="form-control" ng-model="val.other">

				        				<button type="button" ng-if="paquetes.dates.collection.length > 1" class="btn btn-primary" ng-click="paquetes.dates.del(key)">Eliminar</button>
				        			</div>

									<br>
									<br>
									<br>
				        			<div class="input-group">
				        				<button type="button"  class="btn btn-default" ng-click="paquetes.dates.add()">Agregar fecha</button>
				        			</div>
				        		</li>
				        	</ul> -->
				        	<!-- tab 3 -->

				        </div>
				        <div role="tabpanel" class="tab-pane" id="tab4">
					        <!-- tab 4 -->
					        <legend>Nuevo destino</legend>
							<!-- <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" placeholder="destinos">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								
							</div> -->
					        <!-- tab 4 -->
				        </div>
				        <div role="tabpanel" class="tab-pane" id="tab5">
				        	5
				        </div>
				    </div>
				</div>

			</div>
		</div>
	</div>

@endsection