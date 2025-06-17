<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "nfl.php";

$game = new Nfl();
$game->init();
$game->setConnectionDb('nfl');
//$lines = $game->getMatchesByFile('nfl2022.txt');
//var_dump($lines);
//$game->setTeamIds();
//$game->parseMatches($lines);
$img = $game->getImageTeam('ЗЕНИТ');

if($_POST['name']){
    $name = htmlspecialchars($_POST['name']);
    $team_id = (int)$_POST['team_id'];
    $id = $game->addPlayer($name, $team_id);
}
?>
<!DOCTYPE html>
    <head>
        <title>NFL</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div class="wrapper">
            <div class="search">
                    Игрок <input type="text" name="name" value="" />
            </div>
        </div>
    </body>
</html>
