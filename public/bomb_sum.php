<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$season1 = 78;
$season2 = 69;

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);

$query ="SELECT p.name, s.totalgoal, s.season_id, ss.name FROM gamers s JOIN player p ON s.player_id=p.id JOIN country ss ON p.country_id=ss.id WHERE s.totalgoal > 0 AND s.season_id IN (" . $season1 . ", " . $season2 . ")";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
$arGamers = [];
while ($row = mysqli_fetch_row($result)) {
    if($arGamers[$row[0]]){
        if($arGamers[$row[0]][$row[2]]) {
            $arGamers[$row[0]][$row[2]]['goal'] += $row[1];
        } else {
            $arGamers[$row[0]][$row[2]] = ['goal' => $row[1], 'country' => $row[3]];
        }
    } else {
        $arGamers[$row[0]][$row[2]] = ['goal' => $row[1], 'country' => $row[3]];
    }
}

unset($query, $result, $row);

$query ="SELECT p.name, s.sum, s.season_id, ss.name FROM shipplayer s JOIN player p ON s.player_id=p.id JOIN country ss ON p.country_id=ss.id WHERE s.sum > 0 AND s.season_id IN (" . $season1 . ", " . $season2 . ")";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;

while ($row = mysqli_fetch_row($result)) {
    if($arGamers[$row[0]]){
        if($arGamers[$row[0]][$row[2]]) {
            $arGamers[$row[0]][$row[2]]['goal'] += $row[1];
        } else {
            $arGamers[$row[0]][$row[2]] = ['goal' => $row[1], 'country' => $row[3]];
        }
    } else {
        $arGamers[$row[0]][$row[2]] = ['goal' => $row[1], 'country' => $row[3]];
    }
}

$bombs = [];
foreach($arGamers as $gamer => $arGoals){
    $score = 0;
    foreach($arGoals as $season => $goal){
        if($season == $season1){
            $score += $goal['goal'];
        } elseif($season == $season2){
            $score += ($goal['goal'] / 2);
        }
    }
    $country = current($arGoals)['country'];
    if($score > 0){
        $bombs[] = ['score' => $score*2, 'country' => $country, 'gamer' => $gamer];
    }
}
usort($bombs, function($a, $b){
    return ($b['score']-$a['score']);
});

?>
<table>
    <? foreach($bombs as $name => $value){ ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $value['gamer'] ?></td>
            <td><?= $value['score']/2 ?></td>
            <td><?= $value['country'] ?></td>
        </tr>
    <? 
    $i++;
    } ?>
</table>