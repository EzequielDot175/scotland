<!DOCTYPE html>
<html lang="es" ng-app="Admin">
<head>
	<meta charset="UTF-8">
	<title>Scotland Admin</title>
	<link rel="stylesheet" href="{{url('/')}}/js/lib/google-places/autocomplete.min.css">
	<link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url('/')}}/css/jquery-ui.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	@include('admin.inc.header')
</head>
<body >
	@yield('content')
	@include('admin.inc.scripts')
</body>
</html>