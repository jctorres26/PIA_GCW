<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Serif" />
    <link rel="stylesheet" href="./main.css">
    <title>Pia</title>
  </head>
  <body class="body">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-light ajuste" onclick="goToURL();">Ajustes</button>
    </div>
    <div class="container">
        
        <div class="row img d-flex justify-content-center">
            <img src="./imgs//logo.png" class="img-fluid" alt="">
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <button type="button" onclick = "goToGameSingleplayer();"  class="btn btn-light">Un jugador</button>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <button type="button" onclick="goToGameMultiplayer();" class="btn btn-light">Dos jugadores</button>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-light" onclick="goToLeaderboard();">Leaderboards</button>
            </div>
        </div>
      </div>
  </body>
</html>

<script>

$(document).ready(function() {
  var difficulty = localStorage.getItem("hard");
  if(difficulty == null){
    localStorage.setItem("hard",false);
   
  }else{
    localStorage.setItem("hard", difficulty);
  }

});

  function goToURL() {
      location.href = './settings.php';
  }
  function goToLeaderboard() {
      location.href = './leaderboards.php';
  }

  function goToGameMultiplayer() {
      location.href = './escena1MP.php';
  }

  function goToGameSingleplayer() {
      location.href = './escena1SP.php';
  }

</script>

