<!DOCTYPE html>
<html class="" lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
		<link href='https://fonts.googleapis.com/css?family=Kanit:400,200,100' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
		@yield('styles')
		<script src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
	</head>
	<body>
		@include('partials.nav')
		@yield('content')
		<script src="{{ elixir('js/all.js') }}"></script>
		@yield('scripts')
	</body>
</html>