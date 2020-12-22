<?php
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT p.name, g.game FROM gamers g JOIN player p ON p.id = g.player_id WHERE g.season_id > 0 AND g.season_id < 53";
$query2 ="SELECT p.name FROM gamers g JOIN player p ON p.id = g.player_id WHERE g.season_id = 53 AND g.game > 1";
$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$bomb2 = [];
while ($row2 = mysqli_fetch_row($result2)) {
    $bomb2[] = $row2[0];
}
while ($row = mysqli_fetch_row($result)) {
    $res['player'][] = $row[0];
    $res['game'][] = $row[1];
}
//var_dump($res);
$bomb=[];
for ($i=0, $cnt=count($res['player']); $i < $cnt; $i++) {
	if(in_array($res['player'][$i], $bomb2)){
		if (array_key_exists($res['player'][$i], $bomb)) {
			$bomb[$res['player'][$i]] += $res['game'][$i];
		} else {
			$bomb[$res['player'][$i]] = $res['game'][$i];
		}
	}
}
arsort($bomb);
?>
<table>
<?
$i=1;
foreach($bomb as $key => $val){
	?>
	<tr>
	<td><?=$i?>.</td>
	<td><?=$key?></td>
	<td><?=$val?></td>
	</tr>
	<?
	$i++;
}
?>
</table>

