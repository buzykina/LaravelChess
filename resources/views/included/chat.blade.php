<style>
	#main{
		width:250px;
		height:500px;
		background:black;
	}
	#messages{
		height:430px;
		width:250px;
		color:white;
	}
	#msg{
		height:50px;
		width:250px;
		resize:none;
	}
</style>
<div id="main">
	<div id="messages">
		<?php
			$msg = DB::table('chat')->get();
			foreach ($msg as $m){
				echo $m->userid." ".$m->created_at."<br>";
				echo '<p>'.$m->message.'</p>';
			}
		?>
	</div>
	<textarea id="msg"></textarea>
	<input type="button" onclick="send()" value="Send message"></input>
</div>

<script>
	function send(){
		let txt = document.getElementById("msg").value;
		document.getElementById("msg").innerHTML="";
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "<?php echo url()->current();?>/../api/chat", true);
		xhttp.setRequestHeader("Content-type", "application/json");
		xhttp.send('{"message":"'+txt+'","userid":'+2+'}');
	}
	
	function loadDoc() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let response = JSON.parse(xhttp.response);
				document.getElementById("messages").innerHTML ="";
				for(let i=0;i<response.length;i++){
					document.getElementById("messages").innerHTML += response[i]["userid"]+" "+response[i]["created_at"]+'<p>'+response[i]["message"]+'</p>';
				}
		   }
		};
		xhttp.open("GET", "<?php echo url()->current();?>/../api/chat", true);
		xhttp.send(); 
	}
	setInterval(loadDoc,1000);
</script>