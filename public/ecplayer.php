<?php

$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);

$query ="SELECT player_id, game, goal FROM cupplayer";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_row($result)) {
    $res['player'][] = $row[0];
    $res['game'][] = $row[1];
    $res['goal'][] = $row[2];
}
//var_dump($res);
$bomb=[];
for ($i=0, $cnt=count($res['player']); $i < $cnt; $i++) {
    if (array_key_exists($res['player'][$i], $bomb)) {
        $bomb[$res['player'][$i]]['game'] += $res['game'][$i];
        $bomb[$res['player'][$i]]['goal'] += $res['goal'][$i];
    } else {
        $bomb[$res['player'][$i]]['game'] = $res['game'][$i];
        $bomb[$res['player'][$i]]['goal'] = $res['goal'][$i];
    }
}
var_dump($bomb);

foreach ($bomb as $key => $value) {
    $query3 = "UPDATE rusplayer SET cupgame= ".$value['game'].", cupgoal= ".$value['goal']." WHERE player_id=$key";
    mysqli_query($link, $query3);
}
