<!doctype html>
<style>
    #banner{
        width:100%;
    }
	#m{
		margin-top:20px;
	}
</style>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />

    </head>
    <body>
    <?php
    config(['global.pagename' => 'home']);
    ?>
	@include('included.nav')
    <div id="m">
		<!--<img id = "banner" src="'.url()->current().'/../img/banner.jpg">--> 
		@include('included.chess.chess')
		@include('included.chat')
    </div>
    </body>
</html>
