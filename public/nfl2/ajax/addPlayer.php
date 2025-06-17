<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$player = htmlspecialchars($_POST['q']);


$game = new Nfl();
$game->init();
$game->setConnectionDb('nfl2');

if($player){
    $teams = [];
    $res = $game->getMinPlayers();
    foreach($res as $k => $id){
        $teams[$k] = $game->getTeamById($id);
        $teams[$k]['id'] = $id;
    }
    //$game->addPlayer($player, $res['team_id']);
    //$team = $game->getTeamById($res['team_id']);
    echo json_encode($teams);
}