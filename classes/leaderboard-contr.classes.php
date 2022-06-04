<?php

include('../classes/leaderboard.classes.php');

class LeaderboardContr extends Leaderboard{

private $name;
private $time;


public function __construct($name, $time){

    $this->name = $name;
    $this->time = $time;
  
       

}

public function registerTime(){

    $this->insertTime($this->name,$this->time);
}

}
?>