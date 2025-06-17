<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$id = intval($_POST['id']);
$team = intval($_POST['team']);
$team2 = intval($_POST['team2']);

$game = new Nfl();
$game->init();
$game->setConnectionDb('nhl');

$game->statusMatch($id);
$game->addTeamsMatch($team, $team2);
