<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT p.name, SUM(s.game), SUM(s.goal), p.id FROM sbplayer s JOIN player p ON s.player_id=p.id GROUP BY s.player_id ORDER BY p.born";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    //echo $i.'. '.$row[0].' - '.$row[1].' - '.$row[2]."<br/>";
    ++$i;
    $sql2="UPDATE rusplayer SET sbgame = $row[1], sbgoal = $row[2] WHERE player_id = $row[3]";
    var_dump($sql2);
    echo "<br/>";
    mysqli_query($link, $sql2);
}
