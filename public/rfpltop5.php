<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT DISTINCT(p.name) FROM gamers g JOIN player p ON g.player_id=p.id JOIN shipplayer s ON s.player_id=p.id WHERE g.player_id=s.player_id AND (g.season_id=59 OR s.season_id=59) ORDER BY p.name ASC";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    echo $row[0]."<br/>";
}