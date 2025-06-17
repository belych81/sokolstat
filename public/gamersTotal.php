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
    switch($row[1]){
        case 43: $row[1] = 23; break;
        case 44: $row[1] = 1; break;
        case 45: $row[1] = 2; break;
        case 46: $row[1] = 3; break;
        case 47: $row[1] = 49; break;
        case 50: $row[1] = 51; break;
        case 52: $row[1] = 53; break;
        case 54: $row[1] = 55; break;
        case 56: $row[1] = 57; break;
        case 58: $row[1] = 59; break;
        case 61: $row[1] = 62; break;
    }
    $sql2="UPDATE gamers SET totalgame = totalgame + 1, totalgoal = totalgoal + $row[2] WHERE player_id = $row[0] AND season_id = $row[1]";
   var_dump($sql2);
    echo "<br/>";
    mysqli_query($link, $sql2);
    ++$i;
    
}
