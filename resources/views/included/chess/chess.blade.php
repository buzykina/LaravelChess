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
			margin-left:-65px;
			margin-top: -50px;
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
			color: white;
			display:inline-block;
			left:520px;
			vertical-align: top;
			top:0;
			width:300px;
			height:500px;
			text-align:center;
		}
		#moves{
			display:inline-box;
			height:450px;
			overflow:auto;
			overflow-x:hidden;
			width:80%;
			margin-left:10%;
			border: 1px solid gray;
			background: #457b9d;
		}
		#buttons input{
			margin-top: 12px;
			width: 100px;
		}
		#buttons{
			color: black !important;
			height:50px;
			width:300px;
			width:80%;
			border: 1px solid grey;
			margin: 0 30px;
			border-top:0;
		}
		input[type="file"] {
			display: none;
		}
		.custom-file-upload {
			cursor: pointer;
		}
		.margin{
			margin-right: 20px;
		}
	</style>
</head>
<body>
	<div id = "helper">
		<div id="moves">
		</div>
		<div id="buttons">
			<label for="file-upload" class="custom-file-upload">
				<figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure>  Upload file
			</label>
			<input id="file-upload" type="file"/>
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
		document.getElementById("choose").innerHTML = "<button class='button is-dark margin' onclick='mod=2;disappearChoose();'>Local Game</button><br>"<?php
			if(Auth::user()){
				echo '+"'."<button class='button is-dark margin' onclick='mod=1;disappearChoose();init2playerOnline();'>Online Game</button><br>";
				echo "<button class='button is-dark margin' onclick='mod=0;disappearChoose();'>Bot</button><br>".'"';
			}
		?>;
	</script>
</body>