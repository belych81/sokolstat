<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$season = 59;

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT p.name, SUM(s.game) FROM gamers s JOIN player p ON s.player_id=p.id WHERE s.season_id>=4 AND s.season_id<=$season OR s.season_id IN (1, 2, 3) GROUP BY s.player_id ORDER BY SUM(s.game) DESC, p.name ASC LIMIT 15";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    echo $i.'. '.$row[0].' - '.$row[1]."<br/>";
    ++$i;
}
echo "<br/>";

$query ="SELECT p.name, SUM(s.goal) FROM gamers s JOIN player p ON s.player_id=p.id WHERE s.season_id>=4 AND s.season_id<=$season OR s.season_id IN (1, 2, 3) GROUP BY s.player_id ORDER BY SUM(s.goal) DESC, p.name ASC LIMIT 15";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    echo $i.'. '.$row[0].' - '.$row[1]."<br/>";
    ++$i;
}