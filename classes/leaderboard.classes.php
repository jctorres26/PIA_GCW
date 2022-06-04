<?php

include('../classes/dbh.classes.php');

class Leaderboard extends Dbh{


protected function insertTime($name,$time){

    $stmt = $this->connect()->prepare('INSERT INTO leaderboards(name,time) VALUES (?,?);');

    if(!$stmt->execute(array($name,$time))){


    }
    $stmt = null;

}


}


?>