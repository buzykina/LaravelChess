<?php

use Illuminate\Support\Facades\Auth;

// Get the currently authenticated user...
$user = Auth::user();

// Get the currently authenticated user's ID...
$id = Auth::id();

?>

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
	
	<style>
		html, body {
			overflow: auto;
		}
		body{
			background: #9e9e9e14;
			height:100vh!important;
		}
		#mainBod{
			width:60%;
			height:70%;
			margin-left:20%;
			margin-top:10px;
			border:1px solid #00000010;
			background: white;
		}
		#options{
			width:25%;
			height:100%;
			border-right:1px solid #00000010;
			box-sizing: border-box;
			display:inline-block;
			vertical-align:top;
		}
		form{
			width:calc(75% - 5px);
			height:100%;
			display:inline-block;
			text-align:center;
			padding-top:15px;
		}
		#content{
			width:100%;
			height:100%;
			text-align:center;
		}
		img{
			height:35px;
			border-radius:50%;
		}
		.input{
			width:60%;
		}
		.button{
			background:#00a8df77;
			color:white;
			border:0;
		}
		.button:hover{
			background:#00a8df;
			color:white;
		}
	
	</style>

</head>
<body>
	<?php
	config(['global.pagename' => 'profile']);
	?>
	@include('included.nav')
	<div id="mainBod">
		<div id="options">
		
		<aside class="menu">
		  <ul id="currPageMenu" class="menu-list">
			<a class="is-active"><li>Edit profile</li></a>
			<a><li>Change Password</li></a>
			<a><li>View Stats</li></a>
			<?php
				if($id==1){
					echo "<a><li>Admin</li></a>";
				}
			?>
			<a href = "<?php
            echo URL::to('/')."/logout";
            ?>"><li>Log out</li></a>
		  </ul>
		</aside>
		</div>
		<form action = "{{URL::to('/update')}}" method="post">
			@csrf
			<div id="content">
				<aside class="menu">
					<ul class="menu-list">
						<li>
							<div class="columns is-vcentered">
							  <div class="column is-2"></div>
							  <div class="column is-2 has-text-right"><img src="https://i.imgur.com/Pyp4DwX.png"></div>
							  <div class="column has-text-left">
								<span class="is-size-6">UserName</span><br>
								<span class="is-size-7">Change Profile Pic</span>
							  </div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2"></div>
								<div class="column is-2  has-text-right is-size-7 has-text-weight-semibold">Username</div>
								<div class="column has-text-left">
									<input name="uname" class="input is-size-7" type="text" value="{{$user->name}}"></input>
								</div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2"></div>
								<div class="column is-2	 has-text-right is-size-7 has-text-weight-semibold">Email</div>
								<div class="column has-text-left">
									<input name="email" class="input is-size-7" type="text" value="{{$user->email}}"></input>
								</div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2"></div>
								<div class="column is-2	 has-text-right is-size-7 has-text-weight-semibold">Chess Score</div>
								<div class="column has-text-left has-text-weight-bold">
									12000
								</div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2"></div>
								<div class="column is-2"></div>
								<div class="column is-2 has-text-left">
									<input onclick="saveData()" class="button is-size-7 has-text-weight-semibold" value="Submit" type="submit"></input>
								</div>
								<div class="column is-size-7  has-text-left">
									<input class="checkbox" checked="true" value="1" type="checkbox"/> I want to change my information
								</div>
							</div>
						</li>
					</ul>
				</aside>
			</div>
		</form>

	</div>
	


<script>
	function addOnclicks(){
		let arr=document.getElementById("currPageMenu").children;
		for(let i=0;i<arr.length;i++){
			arr[i].onclick = function(){
				arr[i].classList.add("is-active");
				for(let j=0;j<arr.length;j++){
					if(j!=i){
						arr[j].classList.remove("is-active");
					}
				}
			}
		}
	}
	addOnclicks();
</script>
</body>
</html>
