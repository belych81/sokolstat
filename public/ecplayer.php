<?php

$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query = "SELECT
r0_.id AS id_0,
r0_.game AS game_1,
r0_.goal AS goal_2,
r0_.totalgame AS totalgame_3,
r0_.totalgoal AS totalgoal_4,
r0_.fnlgame AS fnlgame_5,
r0_.fnlgoal AS fnlgoal_6,
r0_.sbgame AS sbgame_7,
r0_.sbgoal AS sbgoal_8,
r0_.ecgame AS ecgame_9,
r0_.ecgoal AS ecgoal_10,
r0_.cupgame AS cupgame_11,
r0_.cupgoal AS cupgoal_12,
r0_.player_id AS player_id_13
FROM rusplayer r0_
INNER JOIN player p1_ ON r0_.player_id = p1_.id
INNER JOIN gamers g2_ ON p1_.id = g2_.player_id
INNER JOIN seasons s3_ ON g2_.season_id = s3_.id
WHERE s3_.name = '2019-20'
ORDER BY r0_.game DESC
LIMIT 7";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
echo "<pre>";
$i=0;
while ($row = mysqli_fetch_row($result)) {
    var_dump($row);
    $i++;
}
var_dump($i);
echo "</pre>";
return;


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
