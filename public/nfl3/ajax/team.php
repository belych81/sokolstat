<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "../nfl.php";

$id = intval($_POST['id']);
$image = htmlspecialchars($_POST['image']);

$game = new Nfl();
$game->init();
$game->setConnectionDb('nfl3');

$ans = $game->getNextMatch($id);
$arTeams = [];
$res = [];
if($ans){
    foreach($ans as $match){
        if($match['team'] == $id){
            $arTeams[] = $match['team2'];
        } else {
            $arTeams[] = $match['team'];
        }
    }
    $arTeams = array_unique($arTeams);
    $res = $game->getNextTeam($arTeams);
    
    $arGame = [];
    //echo json_encode($res);
    foreach($ans as $k => $match){
        if(array_search($match['team'], array_column($res, 'id')) !== false || array_search($match['team2'], array_column($res, 'id')) !== false){
            $arGame[$k] = $match;
            if(($key = array_search($match['team'], array_column($res, 'id'))) !== false){
                //var_dump($key);
                $arGame[$k]['img1'] = "/nfl3/images/" . $res[$key]['image'];
                $arGame[$k]['img2'] = $image;
                $arGame[$k]['matches'] = $res[$key]['matches'];
            } elseif(($key2 = array_search($match['team2'], array_column($res, 'id'))) !== false) {
                $arGame[$k]['img2'] = "/nfl3/images/" . $res[$key2]['image'];
                $arGame[$k]['img1'] = $image;
                $arGame[$k]['matches'] = $res[$key2]['matches'];
            }
        }
    }
}
echo json_encode($arGame);