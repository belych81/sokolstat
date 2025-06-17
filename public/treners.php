<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$team = 3;
$player = 621;
$data = '2005-11-07';
$query ="UPDATE rfplmatch SET player_id=$player WHERE team_id=$team AND DATE(data) > '$data'";
$query2 ="UPDATE rfplmatch SET player2_id=$player WHERE team2_id=$team AND DATE(data) > '$data'";
mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
echo "OK";