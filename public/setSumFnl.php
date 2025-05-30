<?php
function glob_tree_files($path, $_base_path = null)
{
	if (is_null($_base_path)) {
		$_base_path = '';
	} else {
		$_base_path .= basename($path) . '/';
	}

	$out = array();
	foreach(glob($path . '/*') as $file) {
		if (is_dir($file)) {
			$out = array_merge($out, glob_tree_files($file, $_base_path));
		} else {
      $tt = file_get_contents($file);
      if(strpos($tt, 'continue;') !== false){
        $out[] = $_base_path . basename($file);
      }
		}
	}

	return $out;
}

$dir = '../../../guestbook';
//var_dump($dir);
$files = glob_tree_files($dir);
var_dump($files);


return;



$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT player_id, game FROM fnlplayer";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_row($result)) {
    $res['player'][] = $row[0];
    $res['game'][] = $row[1];
}
//var_dump($res);
$bomb=[];
for ($i=0, $cnt=count($res['player']); $i < $cnt; $i++) {
    if (array_key_exists($res['player'][$i], $bomb)) {
        $bomb[$res['player'][$i]] += $res['game'][$i];
    } else {
        $bomb[$res['player'][$i]] = $res['game'][$i];
    }
}
//var_dump($bomb);
foreach ($bomb as $key => $value) {
    $query3 = "UPDATE rusplayer SET fnlgame= $value WHERE player_id=$key";
    mysqli_query($link, $query3);
}
