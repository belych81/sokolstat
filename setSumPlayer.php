<?php
$host = 'localhost'; // адрес сервера 
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT id, goal FROM player";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$i=0;
$res=[];
while ($row = mysqli_fetch_row($result)) {
    $res[$i]['id'] = $row[0];
    $res[$i]['goal'] = $row[1];
    $i++;
}

var_dump($res);
foreach ($res as $key => $value) {
    $goal=$value['goal'];
    $id=$value['id'];
    if($goal > 0) {
        $query3 = "UPDATE player SET sum= $goal WHERE id=$id";
        mysqli_query($link, $query3);
    }
}



