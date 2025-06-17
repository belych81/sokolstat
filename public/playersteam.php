<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$players = [];
$query ="SELECT SUM(game), SUM(goal), player_id, team_id FROM gamers GROUP BY player_id, team_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

while ($row = mysqli_fetch_row($result)) {
    if($players[$row[2]][$row[3]]['game']){
        $players[$row[2]][$row[3]]['game'] += $row[0];
        $players[$row[2]][$row[3]]['goal'] += $row[1];
    } else {
        $players[$row[2]][$row[3]]['game'] = $row[0];
        $players[$row[2]][$row[3]]['goal'] = $row[1];
    }
    //var_dump($row);
    //echo "<br/>";
    //$sql2="UPDATE rusplayer SET game = $row[1], goal = $row[2] WHERE player_id = $row[3]";
    //mysqli_query($link, $sql2);
}
$query ="SELECT SUM(game), SUM(goal), player_id, team_id FROM cupplayer GROUP BY player_id, team_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

while ($row = mysqli_fetch_row($result)) {
    if($players[$row[2]][$row[3]]['game']){
        $players[$row[2]][$row[3]]['game'] += $row[0];
        $players[$row[2]][$row[3]]['goal'] += $row[1];
    } else {
        $players[$row[2]][$row[3]]['game'] = $row[0];
        $players[$row[2]][$row[3]]['goal'] = $row[1];
    }
    //var_dump($row);
    //echo "<br/>";
    //$sql2="UPDATE rusplayer SET game = $row[1], goal = $row[2] WHERE player_id = $row[3]";
    //mysqli_query($link, $sql2);
}
$query ="SELECT SUM(game), SUM(goal), player_id, team_id FROM ecplayer GROUP BY player_id, team_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

while ($row = mysqli_fetch_row($result)) {
    if($players[$row[2]][$row[3]]['game']){
        $players[$row[2]][$row[3]]['game'] += $row[0];
        $players[$row[2]][$row[3]]['goal'] += $row[1];
    } else {
        $players[$row[2]][$row[3]]['game'] = $row[0];
        $players[$row[2]][$row[3]]['goal'] = $row[1];
    }
    //var_dump($row);
    //echo "<br/>";
    //$sql2="UPDATE rusplayer SET game = $row[1], goal = $row[2] WHERE player_id = $row[3]";
    //mysqli_query($link, $sql2);
}
$query ="SELECT goal, player_id, team_id FROM supercupplayer";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

while ($row = mysqli_fetch_row($result)) {
    if($players[$row[1]][$row[2]]['game']){
        $players[$row[1]][$row[2]]['game'] += 1;
        $players[$row[1]][$row[2]]['goal'] += $row[0];
    } else {
        $players[$row[1]][$row[2]]['game'] = 1;
        $players[$row[1]][$row[2]]['goal'] = $row[0];
    }
    //var_dump($row);
    //echo "<br/>";
    //$sql2="UPDATE rusplayer SET game = $row[1], goal = $row[2] WHERE player_id = $row[3]";
    //mysqli_query($link, $sql2);
}
foreach($players as $player_id => $arr){
    foreach($arr as $team_id => $ar){
        $game = $ar['game'];
        $goal = $ar['goal'];
        $sql2="UPDATE playersteam SET game = $game, goal = $goal WHERE player_id = $player_id AND team_id = $team_id";
        mysqli_query($link, $sql2);
    }
}
echo 11;
//echo "<pre>"; var_dump($players); echo "</pre>";