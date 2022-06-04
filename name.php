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
    <div class="container">
        
        <div class="row img d-flex justify-content-center">
            <img src="./imgs//logo.png" class="img-fluid" alt="">
        </div>
        <div class="row">
          <form action="./includes/leaderboard_inc.php"  method="POST">
            <div class="d-flex justify-content-center">
              <input name="name" type="text" required
              style="max-width: 30%; margin-top: 5%;"
              placeholder="Ingresa tu nombre"
              class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            <br>
            <br>
            <div class="d-flex justify-content-center">
              <h4 id="tiempo" style="color: white;">Tu tiempo fue de: </h4>

            </div>
            <div class="d-flex justify-content-center">

              <input type="submit" name="submit" class="btn btn-light" value="Subir Resultados">
            <input name="time" hidden id="timeScore"  type="text" required style="max-width: 30%; margin-top: 5%;">
            </div>
          </form>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
            </div>
        </div>
      </div>
  </body>
</html>


<script>
  $(document).ready(function() {
  var time = localStorage.getItem("time");
  console.log(time);

  document.getElementById("tiempo").innerHTML = "Tu tiempo fue de: " + time + " segundos";
  document.getElementById("timeScore").value = time;



});
</script>

<style scoped>
.btnP {
    width: 25%;
    margin-top: 7%;
    opacity: 1 !important;
}
.esc {
    margin-top: 1%;
    color: azure;
}
</style>

