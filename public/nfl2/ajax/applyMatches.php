<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$data = $_POST['data'];

if($data){
    $game = new Nfl();
    $game->init();
    $game->setConnectionDb('nfl2');
    $game->scoreMatch($data);
    $game->setTable($data);
    
    echo json_encode($data);
}