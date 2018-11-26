<html>

<nav class="navbar is-primary">
      <div class="container">
        <div class="navbar-brand">
          <a class="navbar-item" href="{{ URL::to('/home') }}" style="font-weight:bold;">
    play chess
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
                        <a href=" {{ URL::to('/home') }}" class="navbar-item is-active">Home</a>
                        <a href="{{URL::to('/rules')}}" class="navbar-item">Rules</a>
                        <a href="{{URL::to('/login')}}" class="navbar-item">Log IN</a>
              <?php
                      }
              ?>

              <?php
                  if(config('global.pagename')=='rules')
                      {
              ?>
                        <a href=" {{ URL::to('/home') }}" class="navbar-item">Home</a>
                        <a href="{{URL::to('/rules')}}" class="navbar-item is-active">Rules</a>
                        <a href="{{URL::to('/login')}}" class="navbar-item">Log IN</a>
              <?php
                      }
              ?>

              <?php
                  if(config('global.pagename')=='login')
                      {
              ?>
                        <a href=" {{ URL::to('/home') }}" class="navbar-item">Home</a>
                        <a href="{{URL::to('/rules')}}" class="navbar-item">Rules</a>
                        <a href="{{URL::to('/login')}}" class="navbar-item is-active">Log IN</a>
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
