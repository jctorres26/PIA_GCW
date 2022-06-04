<?php

include('../classes/leaderboard-contr.classes.php');

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $time = $_POST["time"];
   
       // echo "hola";
    $register =  new LeaderboardContr($name, $time);

    $register->registerTime();

    header("location:../index.php");

}


?>