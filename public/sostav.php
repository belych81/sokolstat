<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT t.name, COUNT(team_id), c.name FROM sostav s JOIN team t ON s.team_id=t.id JOIN country c ON t.country_id=c.id WHERE season_id=58 GROUP BY team_id ORDER BY COUNT(team_id) DESC, t.name ASC";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
$champ = [];
while ($row = mysqli_fetch_row($result)) {
    echo $i.". ".$row[0]." - ".$row[1];
    echo "<br/>";
    if(key_exists($row[2], $champ)){
        $champ[$row[2]] += $row[1];
    } else {
        $champ[$row[2]] = $row[1];
    }
    ++$i;
}
echo "<br/>";
arsort($champ);
$j = 1;
foreach($champ as $country => $val){
    echo $j.". ". $country." - ".$val;
    echo "<br/>";
     ++$j;
}
