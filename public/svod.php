<?php

$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$team = 260;
$query ="SELECT goal1, goal2, team_id, team2_id FROM rfplmatch where team_id = $team or team2_id = $team";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$wins = 0;
$n = 0;
$p = 0;
$mz = 0;
$mp = 0;
$score = 0;
$matches = 0;
while ($row = mysqli_fetch_row($result)) {
    $matches++;
    if($row[2] == $team){
        $mz += $row[0];
        $mp += $row[1];
        if($row[0] > $row[1]){
            $wins++;
            $score += 3;
        } elseif($row[0] == $row[1]){
            $n++;
            $score++;
        } else {
            $p++;
        }
    } else {
        $mz += $row[1];
        $mp += $row[0];
        if($row[0] < $row[1]){
            $wins++;
            $score += 3;
        } elseif($row[0] == $row[1]){
            $n++;
            $score++;
        } else {
            $p++;
        }
    }
}

$query2 ="UPDATE team SET game=$matches, wins=$wins, nich=$n, porazh=$p,
  mz=$mz, mp=$mp, score=$score where id = $team";
mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

echo $matches." ".$wins." ".$n." ".$p." ".$mz."-".$mp." ".$score;
