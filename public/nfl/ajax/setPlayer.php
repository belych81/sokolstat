<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$id = intval($_POST['id']);
$player = htmlspecialchars($_POST['player']);

$game = new Nfl();
$game->init();
$game->setConnectionDb('nfl');

if($player){
    $game->addPlayer($player, $id);
}