<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$filename = __DIR__."/sitemap.xml";
$domain = "https://sokolstat.ru";
$year = 2021;

$xml = ["/"];

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

$sql="SET NAMES utf8";
mysqli_query($link, $sql);

$query ="SELECT c.translit, s.name FROM shiptable st JOIN seasons s ON st.season_id = s.id JOIN country c ON st.country_id = c.id GROUP BY st.country_id, st.season_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $xml[] = "/championships/".$row[0]."/".$row[1];
  
}

$query ="SELECT s.name FROM shiptable st JOIN seasons s ON st.season_id = s.id GROUP BY st.season_id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $xml[] = "/cup/".$row[0];
  
}

$query ="SELECT translit FROM player";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $xml[] = "/player/".$row[0];
  
}

$xml[] = '/team/';
$query ="SELECT translit FROM team";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $xml[] = "/team/".$row[0]."/";
  
}

$xml[] = '/news/';
$query ="SELECT translit FROM news WHERE active=1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $xml[] = "/news/".$row[0]."/";
  
}

$years = range(1992, $year);

foreach($years as $numb){
    $xml[] = "/sbornie/".$numb;
}

$xml[] = "/supercup/russia";
$xml[] = "/supercup/england";
$xml[] = "/supercup/spain";
$xml[] = "/supercup/italy";
$xml[] = "/supercup/germany";
$xml[] = "/supercup/france";


$str = '<?xml version="1.0" encoding="utf-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach($xml as $item){
 $str .= '<url>
            <loc>'.$domain.$item.'</loc>
          </url>';   

}

$str .= '</urlset>';
var_dump(count($xml));

file_put_contents($filename, $str);