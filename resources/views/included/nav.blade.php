<html>
<style>
    .navbar-item img {
        max-height: 2.5rem;
    }
    .navbar{
        background-color:  #ffd166  !important;
    }
    .navbar-item:hover {
        background-color: #06d6a0 !important;
    }
    .navbar-end .tabs1 li.is-active a {
        border-bottom-color: #06d6a0 !important;
        color: #06d6a0 !important;
    }
    .navbar-end .tabs1 li a:hover{
        border-bottom-color: #06d6a0 !important;
        color: #06d6a0 !important;
    }
    ul{
        border: 0 !important;
    }
</style>
<nav class="navbar is-primary">
      <div class="container">
        <div class="navbar-brand">
          <a class="navbar-item is-hoverable" href="{{ URL::to('/home') }}" style="font-weight:bold;">
              <img src="<?php
				echo URL::to('/')."/img/chess.png";
			  ?>" alt="Logo">
          </a>

          <span class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>
        <div id="navMenu" class="navbar-menu">
          <div class="navbar-end">
              <?php
                  if(config('global.pagename')=='home')
                      {
              ?>
                  <div class="tabs tabs1 is-right">
                      <ul>
                        <li class = "is-active"><a href=" {{ URL::to('/home') }}">Home</a></li>
                        <li><a href="{{URL::to('/rules')}}">Rules</a></li>
                         <?php if(Auth::check())
                             { ?>
                              <li><a href="{{URL::to('/profile')}}">Profile</a></li>
                          <?php }
                          else
                              { ?>
                              <li><a href="{{URL::to('/login')}}">Log IN</a></li>
                         <?php } ?>
                      </ul>
                  </div>
              <?php
                      }elseif(config('global.pagename')=='rules'){
              ?>
                  <div class="tabs tabs1 is-right">
                      <ul>
                          <li><a href=" {{ URL::to('/home') }}">Home</a></li>
                          <li class = "is-active"><a href="{{URL::to('/rules')}}">Rules</a></li>
                          <?php if(Auth::check())
                          { ?>
                          <li><a href="{{URL::to('/profile')}}">Profile</a></li>
                          <?php }
                          else
                          { ?>
                          <li><a href="{{URL::to('/login')}}">Log IN</a></li>
                          <?php } ?>
                      </ul>
                  </div>
              <?php
                      }elseif(config('global.pagename')=='login'){
              ?>
                  <div class="tabs tabs1 is-right">
                      <ul>
                          <li><a href=" {{ URL::to('/home') }}">Home</a></li>
                          <li><a href="{{URL::to('/rules')}}">Rules</a></li>
                          <?php if(Auth::check())
                          { ?>
                          <li><a href="{{URL::to('/profile')}}">Profile</a></li>
                          <?php }
                          else
                          { ?>
                          <li class = "is-active"><a href="{{URL::to('/login')}}">Log IN</a></li>
                          <?php } ?>
                      </ul>
                  </div>
                  <?php
                  }elseif(config('global.pagename')=='profile'){
                  ?>
                  <div class="tabs tabs1 is-right">
                      <ul>
                          <li><a href=" {{ URL::to('/home') }}">Home</a></li>
                          <li><a href="{{URL::to('/rules')}}">Rules</a></li>
                          <?php if(Auth::check())
                          { ?>
                          <li class = "is-active"><a href="{{URL::to('/profile')}}">Profile</a></li>
                          <?php }
                          else
                          { ?>
                          <li><a href="{{URL::to('/login')}}">Log IN</a></li>
                          <?php } ?>
                      </ul>
                  </div>
                  <?php
                      }
					 else{
              ?>
				  <div class="tabs tabs1 is-right">
                      <ul>
                          <li><a href=" {{ URL::to('/home') }}">Home</a></li>
                          <li><a href="{{URL::to('/rules')}}">Rules</a></li>
                          <li><a href="{{URL::to('/login')}}">Log IN</a></li>
                      </ul>
                  </div>
			  <?php
					 }
			  ?>
          </div>
        </div>
      </div>
</nav>

<script type="text/javascript">
    (function() {
        var burger = document.querySelector('.burger');
        var nav = document.querySelector('#'+burger.dataset.target);
        burger.addEventListener('click', function(){
            burger.classList.toggle('is-active');
            nav.classList.toggle('is-active');
        });
    })();
</script>

</html>
