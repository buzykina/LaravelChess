<?php

use Illuminate\Support\Facades\Auth;
// Get the currently authenticated user...
$user = Auth::user();

// Get the currently authenticated user's ID...
$id = Auth::id();
$folder = "profilePics";
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
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
		#img{
			height:35px;
			width:35px;
			border-radius:50%;
		}
		#img1{
			height:250px;
			margin: 0 20px 0 0;
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
		.hidden{
			display: none;
		}
		#btn{
			margin: 20px 0 0 0;
		}
		#file{
			display:none;
		}
		#fileLabel{
			color: blue;
			cursor: pointer;
		}
		#fileLabel:hover{
			color: red;
		}
		#blackout{
			background:#000c;
			position:fixed;
			height:100%;
			width:100%;
			top:0;
			z-index:1000000;
			display:none;
			text-align:center;
		}
		#showImg{
			margin-top:100px;
			max-width:100%;
			max-height:calc(100% - 200px);
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
			<a id = "edit" class="is-active" ><li>Edit profile</li></a>
			<a id = "change"><li>Change Password</li></a>
			<a id = "delete"><li>Delete</li></a>
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
		<form id = "form_edit" action = "{{URL::to('/update')}}" enctype="multipart/form-data" method="post">
			@csrf
			<div id="content">
				<aside class="menu">
					<ul class="menu-list">
						<li>
							<div class="columns is-vcente	red">
							  <div class="column is-2"></div>
							  <div class="column is-2 has-text-right"><img id = "img" src="{{$user->imgUrl==""?"https://i.stack.imgur.com/l60Hf.png":URL::to('/').'/storage/profilePics'.$user->imgUrl}}"></div>
							  <div class="column has-text-left">
								<span class="is-size-6">UserName</span><br>
								<span id="fileLabel" class="is-size-7">Change Profile Pic</span>
								<input type="file" name="image" value="" id="file"></input>
								<input type="hidden" name="_token" value="{{ csrf_token()}}"></input>
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
								<div class="column has-text-left has-text-weight-bold">{{$user->score}}</div>
							</div>
						</li>
						<li>
							<div class="columns is-centered">
								<div class="column is-2 has-text-left">
									<input onclick="saveData()" class="button is-size-7 has-text-weight-semibold" value="Submit" type="submit"></input>
								</div>
							</div>
						</li>
					</ul>
				</aside>
			</div>
		</form>
		<form id = "form_change" class="hidden" method="POST" action="{{ route('changePassword') }}">
			@csrf
			<div id="content">
				<aside class="menu">
					<ul class="menu-list">
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2 form-group{{ $errors->has('current-password') ? ' has-error' : '' }}"></div>
								<div class="column is-2  has-text-right is-size-7 has-text-weight-semibold">Current Password</div>
								<div class="column has-text-left">
									<input id="current-password" type="password" class="input is-size-7 form-control" name="current-password" required>
									@if ($errors->has('current-password'))
										<span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
									@endif
								</div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2 form-group{{ $errors->has('new-password') ? ' has-error' : '' }}"></div>
								<div class="column is-2	 has-text-right is-size-7 has-text-weight-semibold">New Password</div>
								<div class="column has-text-left">
									<input id="new-password" type="password" class="input is-size-7 form-control" name="new-password" required>
									@if ($errors->has('new-password'))
										<span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
									@endif

								</div>
							</div>
						</li>
						<li>
							<div class="columns is-vcentered">
								<div class="column is-2"></div>
								<div class="column is-2  has-text-right is-size-7 has-text-weight-semibold">Confirm New Password</div>
								<div class="column has-text-left">
									<input id="new-password-confirm" type="password" class="input is-size-7 form-control" name="new-password_confirmation" required>
								</div>
							</div>
						</li>
						<li>
							<div class="columns is-centered">
								<div class="column is-2 has-text-left">
									<button class="button is-size-7 has-text-weight-semibold form-control" type="submit">Change Password</button>
								</div>
							</div>
						</li>
					</ul>
				</aside>
			</div>
		</form>
		<form id = "form_delete" class="hidden" action = "{{URL::to('/delete')}}" method="post">
			@csrf
			<div id="content">
				<aside class="menu">
					<ul class="menu-list">
						<li>
							<div class="columns is-centered">
								<img id = "img1" src="<?php
                                echo URL::to('/')."/img/bomb.png";
                                ?>" >
							</div>
						</li>
						<li>
							<div class="columns is-centered">
								<label class="has-text-weight-semibold is-centered">If you are sure that you want to delete your profile press the button</label>
							</div>
						</li>
						<li>
							<div class="columns is-centered">
								<div class="column is-2 has-text-left">
									<button id  = "btn" class="button is-size-7 has-text-weight-semibold form-control" type="submit">Delete</button>
								</div>
							</div>
						</li>
					</ul>
				</aside>
			</div>
		</form>
	</div>

	<div id="blackout">
		<img id="showImg"></img>
	</div>

<script>
	document.getElementById("edit").addEventListener("click",function ()
	{
        document.getElementById("edit").classList.add('is-active');
        document.getElementById("change").classList.remove('is-active');
        document.getElementById("delete").classList.remove('is-active');
        document.getElementById("form_edit").classList.remove('hidden');
        document.getElementById("form_change").classList.add('hidden');
        document.getElementById("form_delete").classList.add('hidden');
	});
    document.getElementById("change").addEventListener("click",function ()
    {
        document.getElementById("edit").classList.remove('is-active');
        document.getElementById("delete").classList.remove('is-active');
        document.getElementById("change").classList.add('is-active');
        document.getElementById("form_edit").classList.add('hidden');
        document.getElementById("form_change").classList.remove('hidden');
        document.getElementById("form_delete").classList.add('hidden');
    });
    document.getElementById("delete").addEventListener("click",function ()
    {
        document.getElementById("delete").classList.add('is-active');
        document.getElementById("edit").classList.remove('is-active');
        document.getElementById("change").classList.remove('is-active');
        document.getElementById("form_edit").classList.add('hidden');
        document.getElementById("form_change").classList.add('hidden');
        document.getElementById("form_delete").classList.remove('hidden');
    });
	
	function onStartUp(){
		$('#fileLabel').click(function(){ $('#file').trigger('click'); });
		$('#file').change(function (evt) {
			var tgt = evt.target || window.event.srcElement,
				files = tgt.files;

			// FileReader support
			if (FileReader && files && files.length) {
				var fr = new FileReader();
				fr.onload = function () {
					document.getElementById("img").src = fr.result;

				}
				fr.readAsDataURL(files[0]);
			}else{
				console.log("Your browser is too old and doesn't support file reader. Please update it and try later.")
			}
		});
		$('#img').click(function(){
			document.getElementById('blackout').style.display="initial";
			document.getElementById('showImg').src=document.getElementById('img').src;
			$('#showImg').hover(function () {
                var src = document.getElementById('img').src.replace('profilePics','pixelate');
                document.getElementById('showImg').src= src;
            });
            document.getElementById('showImg').onmouseout = function() {
                document.getElementById('showImg').src = document.getElementById('img').src;
            };
		});
		$('#blackout').click(function(){
			document.getElementById('blackout').style.display="none";
			document.getElementById('showImg').src="";
		});
	}
	
	window.onload = onStartUp();
</script>
</body>
</html>
