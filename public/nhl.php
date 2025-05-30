<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT * FROM nfl1617";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_row($result)) {
    $team[] = $row[1]."\t";
    $conf[] = $row[2]."\t";
    $div[] = $row[3]."<br/>";
}
$n=1;
$cnt = 24;
for($i=0; $i<$cnt; $i++) {
    for ($j=0; $j<$cnt; $j++) {
        if (($i > $j) && ($conf[$i] != $conf[$j]) && ($n%2 == 0)) {
            $id[]=$n;
        $team1[]=$team[$i];
        $team2[]=$team[$j];
        $n++;
        } elseif (($i > $j) && ($conf[$i] != $conf[$j]) && ($n%2 != 0)) {
            $id[]=$n;
            $team2[]=$team[$i];
        $team1[]=$team[$j];
            $n++;
        }
    }
}
for($i=0; $i<$cnt; $i++) {
    for ($j=0; $j<$cnt; $j++) {
        if ($conf[$i] == $conf[$j] && $team[$i] != $team[$j]) {
            $id[]=$n;
        $team1[]=$team[$i];
        $team2[]=$team[$j];
        $n++;
        }
    }
}
for($i=0; $i<$cnt; $i++) {
    for ($j=0; $j<$cnt; $j++) {
        if ($div[$i] == $div[$j] && $team[$i] != $team[$j]) {
            $id[]=$n;
        $team1[]=$team[$i];
        $team2[]=$team[$j];
        $n++;
        }
    }
}
for ($i=0, $cnt=count($team1); $i < $cnt; $i++) {

   $tt[] = [$team1[$i], $team2[$i]];
}
shuffle($tt);

foreach($tt as $key => $val){
 echo $val[0]." - ".$val[1]."<br/>";
}
