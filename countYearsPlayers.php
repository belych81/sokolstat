<?php
$host = 'localhost'; // адрес сервера 
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);

$query ="SELECT YEAR(born), COUNT(YEAR(born))
FROM player 
GROUP BY YEAR(born)";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$i=1;
while ($row = mysqli_fetch_row($result)) {
    echo $i.'. '.$row[0].' - '.$row[1].'<br/>';
    $i++;
}