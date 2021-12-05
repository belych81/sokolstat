<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT player_id, season_id, goal FROM supercupplayer";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    echo $row[0].' - '.$row[1].' - '.$row[2].' - '.$row[3];
  
}
