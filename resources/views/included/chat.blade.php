<style>
	#main{
		width:250px;
		height:500px;
		display:inline-block;
	}
	#messages{
		height:405px;
		width:250px;
		color:white;
		overflow-y:auto;
		background:#ef476f;
	}
	#msg{
		height:50px;
		width:250px;
		resize:none;
	}
	.msg {
		background: transparent;
		margin-bottom: 3px;
		margin-top: 3px;
	}
</style>
<div id="main">
	<div id="messages">
		<?php
			$msg = DB::table('chat')->get();
			foreach ($msg as $m){
				$name = (DB::table('users')->where('id','=',$m->userid)->get()->first());
				if($name){
					$name = $name->name;
					echo '<div class="msg">'.$name." ".$m->created_at."<br>";
					echo '<p>'.$m->message.'</p></div>';
				}
			}
		?>
	</div>
	<textarea id="msg">  <?php
		if(!Auth::user()){
			echo "disabled = 'true'>You need to be logged in in order to access the chat!";
		}else{
			echo ">";
		}
		?>
	</textarea>
	<input type="button" class="button is-warning" onclick="sendMsgViaChat()" value="Send message">
</div>

<script>
	<?php
		if(Auth::user()){
	?>
			function sendMsgViaChat(){
				let txt = "'"+document.getElementById("msg").value.replace("'","&#39")+"'";
				document.getElementById("msg").innerHTML="";
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "<?php echo URL::to('/');?>/api/chat", true);
				xhttp.setRequestHeader("Content-type", "application/json");
				let jsonTxt = "{'message':"+txt+"}";
				jsonTxt = jsonTxt.replace(/'/g,'"');
				xhttp.send(jsonTxt);
				xhttp.onreadystatechange = loadDoc();
			}
	<?php 
		}else{
			echo "function sendMsgViaChat(){}";
		}
	?>
	function loadDoc() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let response = JSON.parse(xhttp.response);
				document.getElementById("messages").innerHTML ="";
				for(let i=0;i<response.length;i++){
					document.getElementById("messages").innerHTML += "<div class='msg'>"+response[i]["userid"]+" "+response[i]["created_at"]+'<p>'+response[i]["message"]+'</p></div>';
				}
		   }
		};
		xhttp.open("GET", "<?php echo URL::to('/');?>/api/chat", true);
		xhttp.send(); 
	}
	setInterval(loadDoc,1500);
</script>