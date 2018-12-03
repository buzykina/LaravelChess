<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
    <style>
        #container {
            width:600px !important;
            height: 437px !important;
        }
        #profile{
            height: 128px;
            padding: 0 0 20px !important;
        }
        #subtitle{
            margin: 10px 0 0 0;
        }
        #title{
            margin: 0px 0 10px 0;
        }
        #col1{
            border-left: thick solid grey;
        }
        #pass{
            padding: 0 0 10px 0 !important;
        }
    </style>

</head>
<body>
<?php
config(['global.pagename' => 'login']);
?>
@include('included.nav')
<section class="is-success is-fullheight">
    <div class="columns is-vcentered">
        <div class="hero-body column">
            <div id = "container" class="container has-text-centered level-item">
                <div>
                    <h3 class="title has-text-grey">Login</h3>
                    <p id = "subtitle" class="subtitle has-text-grey">Please login to proceed.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img id = "profile" src="'.url()->current().'/../img/profile.png">
                        </figure>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="field">
                                <div class="control">
                                <input id="email" type="email" class="input is-large" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="field">
                                <div class="control">
                                <input id="password" type="password" class="input is-large" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="button is-block is-info is-large is-fullwidth">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
                <div class="hero-body column">
                    <div id = "container" class="container has-text-centered level-item">
                        <div>
                            <h3 id  = "title" class="title has-text-grey">Sign up</h3>

                            <div class="box">
                                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="field control">
                                            <input id="name" type="text" class="input is-large" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="field control">
                                            <input id="email" type="email" class="input is-large" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="field control">
                                            <input id="password" type="password" class="input is-large" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                        <div id = "pass" class="field control">
                                            <input id="password-confirm" type="password" class="input is-large" name="password_confirmation" required>
                                        </div>
                                    </div>

                                            <button type="submit" class="button is-block is-info is-large is-fullwidth">
                                                Sign up
                                            </button>
                                </form>
                            </div>
                        </div>
                    </div>
    </div>
</div>
</section>

</body>
</html>