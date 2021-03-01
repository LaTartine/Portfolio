<template>
  <div class="about">
    <div>
      <div class="stars" style="height: 100vh">
        <div id="parallaxSpace" class="overflow-hidden" style="position: relative; height: 100vh;">
        </div>
      </div>
      <div class="twinkling" style="height: 100vh"></div>
    </div>
    <div class="position-absolute d-flex w-100 justify-content-center align-items-center" style="height: 100vh; top: 0; left: 0; z-index: 1">
      <div class="text-light text-center">Page en construction, revenez plus tard ! ;)</div>
    </div>
  </div>
</template>

<style scoped lang="scss">
  /*SPACE*/

  @keyframes move-twink-back {
    from {background-position:0 0;}
    to {background-position:-10000px 5000px;}
  }
  @-webkit-keyframes move-twink-back {
    from {background-position:0 0;}
    to {background-position:-10000px 5000px;}
  }
  @-moz-keyframes move-twink-back {
    from {background-position:0 0;}
    to {background-position:-10000px 5000px;}
  }
  @-ms-keyframes move-twink-back {
    from {background-position:0 0;}
    to {background-position:-10000px 5000px;}
  }


  .stars, .twinkling {
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    width:100%;
    height:100%;
    display:block;
  }

  .stars {
    background:#000 url("../assets/space/starySky.jpg") repeat;
    background-size: 50%;
  }

  .twinkling{
    background:transparent url(http://www.script-tutorials.com/demos/360/images/twinkling.png) repeat top center;
    background-size: 10%;
    z-index:1;

    -moz-animation:move-twink-back 200s linear infinite;
    -ms-animation:move-twink-back 200s linear infinite;
    -o-animation:move-twink-back 200s linear infinite;
    -webkit-animation:move-twink-back 200s linear infinite;
    animation:move-twink-back 200s linear infinite;
  }
</style>