<!DOCTYPE html>
<html ng-app="App">
	<head>
		<title state-title></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
		<link href='https://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxvq7EwIH7PaulBGlHED2fq0-Yx9zC3lU&callback=initMap"></script>
	</head>
	<body>
		<div class="body-front">
			<section class="container-fluid">
				<div class="row">
					<div class="body-wrap">
						<div ui-view class="main"></div>
					</div>
				</div>
			</section>
		</div>


		<script src="{{ elixir('js/app.js') }}"></script>
	</body>
</html>