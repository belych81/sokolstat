<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT id, game, goal, cupgame, cupgoal, supercupgame, supercupgoal, sbgame, sbgoal, ecgame, ecgoal FROM rusplayer";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $game = $row[1]+$row[3]+$row[5]+$row[7]+$row[9];
    $goal = $row[2]+$row[4]+$row[6]+$row[8]+$row[10];
    $sql2="UPDATE rusplayer SET totalgame = $game, totalgoal = $goal WHERE id = $row[0]";
    var_dump($sql2);
    echo "<br/>";
    mysqli_query($link, $sql2);
    ++$i;
}
