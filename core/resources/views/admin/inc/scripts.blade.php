

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzNVW6bkBBLSqPMAY7SO4vhGvoL315yNk&libraries=places"></script>
<script src="{{url('/')}}/js/lib/jquery-1.11.3.js"></script>
<script src="{{url('/')}}/js/lib/jquery-ui.min.js"></script>

<script src="{{url('/')}}/js/lib/bootstrap.min.js"></script>
<script src="{{url('/')}}/js/lib/angular.min.js"></script>
<!-- <script src="{{url('/')}}/js/lib/ui-bootstrap-tpls-0.14.3.min.js"></script> -->

<script src="{{url('/')}}/js/lib/google-places/autocomplete.min.js"></script>
<script src="{{url('/')}}/js/lib/angular-file-upload.min.js"></script>
<script src="{{url('/')}}/js/controllers/admin/app.js"></script>
<script src="{{url('/')}}/js/lib/ngStorage.min.js"></script>

<script src="{{url('/')}}/js/lib/services.js"></script>
<script src="{{url('/')}}/js/lib/factory.js"></script>
<script src="{{url('/')}}/js/lib/directive.js"></script>

@if(isset($controller))
	@foreach($controller as $kc => $v)
		<script src="{{url('/')}}/js/controllers/admin/{{$v}}.js"></script>
	@endforeach
@endif


<script>
	jQuery(document).ready(function($) {
		$('.datepicker').datepicker( {
		  dateFormat: "dd/mm/yy"
		});
	});
</script>


