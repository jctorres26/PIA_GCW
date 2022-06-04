<?php

class Dbh{

protected function connect(){


    try{
    $server = "localhost";
    $username = "id19040893_root";
    $password = "]rprmgOqF??%5[XL";
    $database="id19040893_gcw";

    $conn = new PDO("mysql:host=$server;dbname=$database;" ,$username, $password);
    return $conn;
        
    }catch(PDOException $error){

        die("Connection failed" . $error->getMessage());

    }
}

}

?>