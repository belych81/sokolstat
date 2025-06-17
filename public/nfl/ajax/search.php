<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$q = htmlspecialchars($_POST['q']);

$game = new Nfl();
$game->init();
$game->setConnectionDb('nfl');

$ans = $game->search($q);

echo json_encode($ans);