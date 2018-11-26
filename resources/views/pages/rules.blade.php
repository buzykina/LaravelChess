<!doctype html>

	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<title>Laravel</title>

			<!-- Fonts -->
			<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

			<!-- Styles -->
			<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />

		</head>
	<body>
		<?php
		config(['global.pagename' => 'rules']);
		?>
		@include('included.nav')
		<?php
			$rule = DB::table('rules')->get();
			foreach ($rule as $r){
				echo $r->title."<br>";
				echo '<img src = "'.url()->current().$r->image.'">';
				echo $r->description."<br>";
			}
		?>

	</body>

</html>
