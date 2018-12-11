<head>
	<title>Chess</title>
	<style>
		body{
			margin:0;
			text-align:center;
		}
		#canvas{
			vertical-align:top;
		}
		#helper{
			display:inline-block;
			left:520px;
			top:0;
			border: 1px solid black;
			width:300px;
			height:500px;
			text-align:center;
		}
		#moves{
			display:inline-box;
			margin-top:20px;
			height:400px;
			overflow:auto;
			overflow-x:hidden;
			width:80%;
			margin-left:10%;
			border: 1px solid black;
		}
		#buttons{
			height:30px;
			width:80%;
			margin-left:10%;
			border: 1px solid black;
			border-top:0;
		}
	</style>
</head>
<body>
	<canvas width="500" height="500" id="canvas"></canvas>
	<div id="helper">
		<div id="moves">
		</div>
		<div id="buttons">
			<input type="file" id = "file-input"/>
		</div>
	</div>
	<input type="hidden" id="aidi" value="{{Auth::id()}}"></input>
	<script src="{{URL::to('/')}}/js/chess.js"></script>
</body>