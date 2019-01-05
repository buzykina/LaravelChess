<head>
	<title>Chess</title>
	<style>
		.is-vcentered{
			align-items: center
		}
		body{
			margin:0;
			text-align:center;
		}
		#cancontainer{
			display:inline-block;
			vertical-align:top;
			padding:50px;
		}
		#choose{
			position:absolute;
			z-index:-1;
			margin-left:-50px;
			margin-top:-50px;
			width:600px;
			height:600px;
			display: flex;
			justify-content: center;
			align-items: center;	
			font-size:30px;
			color:white;
		}
		#numbs{
			position:absolute;
			z-index:-1;
			margin-left:-50px;
			margin-top:-50px;
		}
		#helper{
			display:inline-block;
			left:520px;
			vertical-align: top;
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
	<div id="helper">
		<div id="moves">
		</div>
		<div id="buttons">
			<input type="file" id = "file-input"/>
		</div>
	</div>
	<div id="cancontainer">
		<canvas width="600" height="600" id="numbs"></canvas>
		<canvas width="500" height="500" id="canvas"></canvas>
		<div id="choose"></div>
	</div>
	<script src="{{URL::to('/')}}/js/chess/main.js"></script>
	<script src="{{URL::to('/')}}/js/chess/board.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/piece.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/pawn.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/rook.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/knight.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/bishop.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/queen.js"></script>
	<script src="{{URL::to('/')}}/js/chess/pieces/king.js"></script>
	<?php if(Auth::user()){?>
		<script src="{{URL::to('/')}}/js/chess/ajax.js"></script>
		<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
		<script>

			// Enable pusher logging - don't include this in production
			Pusher.logToConsole = true;

			var pusher = new Pusher('70108a32ac63f999e980', {
			  cluster: 'eu',
			  forceTLS: true
			});

			var channel = pusher.subscribe('channelDemoEvent');
			channel.bind('App\\Events\\eventTrigger', function(data) {
				let cas = data["data"];
				let gid = data["gameId"];
				console.log(data);
				if(gameId == gid){
					if(cas==0){// ajax=> start2playerOnline
						console.log("start 2 player online");
						start2playerOnline();
					}else if(cas==1){ // ajax => waitForMoveOnline
						waitForMoveOnline();
					}
				}
			});
		</script>
	<?php } ?>
	<script>
		document.getElementById("choose").style.top = (can.offsetTop + window.scrollY)+"px";
		document.getElementById("choose").style.width = can.width+100+"px";
		document.getElementById("choose").style.height = can.height+100+"px";
		document.getElementById("choose").style.background = "black";
		document.getElementById("choose").style.zIndex = "1000000";
		document.getElementById("choose").innerHTML = "<button class='button is-dark' onclick='mod=2;disappearChoose();'>Local Game</button><br>"<?php
			if(Auth::user()){
				echo '+"'."<button class='button is-dark' onclick='mod=1;disappearChoose();init2playerOnline();'>Online Game</button><br>";
				echo "<button class='button is-dark' onclick='mod=0;disappearChoose();'>Bot</button><br>".'"';
			}
		?>;
	</script>
</body>