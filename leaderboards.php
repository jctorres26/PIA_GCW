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
    <link
      rel="stylesheet"
      type="text/css"
      href="//fonts.googleapis.com/css?family=Droid+Serif"
    />
    <link rel="stylesheet" href="./main.css" />
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Pia</title>
  </head>
  <body class="body">
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-light ajuste" onclick="goMain();">
        Menu Principal
      </button>
    </div>
    <div class="container">
      <div class="row row-cols-2">
        <div class="col"><h1 class="edit"><i class="fa fa-star"></i>Leaderboards</h1></div>
        <div class="col"><img src="./imgs//logo.png" class="img-fluid" alt=""></div>
        </div>
      </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="title">Username</th>
              <th scope="col" class="title">Score</th>
            </tr>
          </thead>
          <tbody>
            <tr class="title">
              <td>Kevin</td>
              <td>7635</td>
            </tr>
            <tr class="title">
              <td>Cove</td>
              <td>5623</td>
            </tr>
            <tr class="title">
              <td>Jose</td>
              <td>4234</td>
            </tr>
          </tbody>
        </table>
  </body>
</html>

<script>
  function goMain() {
    location.href = "./index.php";
  }
</script>

<style scoped>
  .title {
    color: azure;
  }
  .table {
    margin-top: 6%;
    margin-left: 30%;
    max-width: 40%;
  }
  .justify-content-center{
    max-width: 30%;
  }
  .btnS {
    margin-left: 30%;
    width: 40% !important;
  }
  .edit2 {
    margin-top: 50px;
  }
.elh2 {
  color: azure;
}
.edit {
  margin-top: 20%;
  color: azure;
  font-weight: bold;
  font-size: 70px
}
.edit3{
  margin-top: 5%;
  margin-left: 30%;
  color: azure;
  font-weight: bold;
  font-size: 50px;
}
.slidecontainer {
  width: 100%;
}
.fa{
  margin-right: 20px;
}
.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #ffffff;
  outline: none;
  opacity: 0.8;
  -webkit-transition: .2s;
  transition: opacity .2s;
  border-radius: 25px;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #1982be;
  cursor: pointer;
  border-radius: 25px;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #ffffff;
  cursor: pointer;
}
</style>
