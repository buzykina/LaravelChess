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
    </style>

</head>
<body>
<?php
config(['global.pagename' => 'login']);
?>
@include('included.nav')
<section class="is-success is-fullheight">
    <div class="columns is-vcentered">
        <div class="column">
            <div class="hero-body">
                <div id = "container" class="container has-text-centered level-item">
                    <div>
                        <h3 class="title has-text-grey">Login</h3>
                        <p id = "subtitle" class="subtitle has-text-grey">Please login to proceed.</p>
                        <div class="box">
                            <figure class="avatar">
                                <img id = "profile" src="'.url()->current().'/../img/profile.png">
                            </figure>
                            <form>
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="text" placeholder="Your Email or Username" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="password" placeholder="Your Password">
                                    </div>
                                </div>
                                <button class="button is-block is-info is-large is-fullwidth">Login</button>
                            </form>
                        </div>
                        <p class="has-text-grey">
                            <a href="../">Forgot Password</a> &nbsp;·&nbsp;
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        <div class = "column" id = "col1">
        </div>
        <div class = "column">
            <div class="hero-body">
                <div id = "container" class="container has-text-centered level-item">
                    <div>
                        <h3 id  = "title" class="title has-text-grey">Register</h3>
                        <div class="box">
                            <form>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="text" placeholder="Your Username" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="email" placeholder="Your Email" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="password" placeholder="Your Password">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="password" placeholder="Your Password">
                                    </div>
                                </div>
                                <button class="button is-block is-info is-large is-fullwidth">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
