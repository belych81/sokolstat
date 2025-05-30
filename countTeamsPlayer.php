<?php
$host = 'localhost'; // адрес сервера 
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT p.name, COUNT(DISTINCT g.team_id) AS qty
FROM gamers g JOIN player p 
ON p.id=g.player_id 
WHERE g.player_id IN (SELECT player_id FROM gamers WHERE season_id=57)
GROUP BY g.player_id
HAVING COUNT(DISTINCT g.team_id) > 3
ORDER BY COUNT(DISTINCT g.team_id) DESC";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$i=1;
while ($row = mysqli_fetch_row($result)) {
    echo $i.'. '.$row[0].' - '.$row[1].'<br/>';
    $i++;
}