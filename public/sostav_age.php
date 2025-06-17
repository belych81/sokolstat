<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT c.name, AVG(unix_timestamp(curdate())-unix_timestamp(p.born)) FROM sostav s JOIN player p ON s.player_id=p.id JOIN country c ON s.country_id=c.id WHERE season_id=58 GROUP BY s.country_id ORDER BY AVG(p.born) DESC, c.name ASC";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
$champ = [];
while ($row = mysqli_fetch_row($result)) {
    echo $i.". ".$row[0]." - ".$row[1]/(60*60*24*365.25);
    echo "<br/>";

    ++$i;
}
echo time();

