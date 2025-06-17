<?php
return;
$host = 'localhost'; // адрес сервера
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = 'Larisa2013+'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);

$query ="SELECT team, team2, city_id, referee_id, zriteli, team_id, team2_id, data FROM ecsostav es JOIN eurocup ec ON es.eurocup_id=ec.id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
  extract($row);
  $sql2="UPDATE game SET game='$team', game2='$team2', city_id=".var_export($city_id, 1).", referee_id=".var_export($referee_id, 1).",
    zriteli=".var_export($zriteli, 1)." WHERE team_id=$team_id AND team2_id=$team2_id AND data='$data'";
      var_dump($sql2);
    mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

}
return;

$query ="SELECT season_id, team_id, team2_id, game, game2, data, score, goal, status FROM uefa_supercup";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$goal', $status, NULL, NULL, 0, '', '$game', '$game2',
         '$score', 4, NULL)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
}

return;

$query ="SELECT season_id, team_id, team2_id, game, game2, data, score, goal, status FROM rus_supercup";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$goal', $status, NULL, NULL, 0, '', '$game', '$game2',
         '$score', 29, NULL)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
}

return;

$query ="SELECT season_id, team_id, team2_id, country_id, data, score, goal, status FROM nation_supercup";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    switch($country_id){
      case 77: $turnir = 30; break;
      case 31: $turnir = 31; break;
      case 33: $turnir = 32; break;
      case 28: $turnir = 33; break;
      case 64: $turnir = 34; break;
    }

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$goal', $status, NULL, NULL, 0, '', '', '',
         '$score', $turnir, NULL)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
}

return;

$query ="SELECT season_id, team_id, team2_id, stadia_id, data, score, bomb, status FROM cup_league";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$bomb', $status, NULL, NULL, 0, '', '', '',
         '$score', 28, $stadia_id)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
}

return;

$query ="SELECT season_id, team_id, team2_id, stadia_id, country_id, data, score, bomb, status FROM nation_cup WHERE id > 841";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    switch($country_id){
      case 77: $turnir = 23; break;
      case 31: $turnir = 24; break;
      case 33: $turnir = 25; break;
      case 28: $turnir = 26; break;
      case 64: $turnir = 27; break;
    }

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$bomb', $status, NULL, NULL, 0, '', '', '',
         '$score', $turnir, $stadia_id)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
}

return;

$query ="SELECT season_id, team_id, team2_id, stadia_id, game, game2, data, score, bomb, status FROM cup";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, 0, '$data', 0, 0, '$bomb', $status, NULL, NULL, 0, '', ".var_export($game, 1).", ".var_export($game2, 1).",
         '$score', 22, $stadia_id)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

}

return;

$query ="SELECT season_id, team_id, team2_id, country_id, tour, data, goal1, goal2, bomb, status FROM tour WHERE country_id != 1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $turnir = NULL;
    switch($country_id){
      case 77: $turnir = 16; break;
      case 31: $turnir = 17; break;
      case 33: $turnir = 18; break;
      case 28: $turnir = 19; break;
      case 64: $turnir = 20; break;
      case 133: $turnir = 21; break;
    }
    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id) VALUES ($season_id, $team_id,
        $team2_id, NULL, NULL, $tour, '$data', $goal1, $goal2, '$bomb', $status, NULL, NULL, 0, '', '', '', '', $turnir)";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

}
return;


$query ="SELECT season_id, team_id, team2_id, stadia_id, data, score, bomb, status,
  turnir_id, number FROM eurocup";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_row($result)) {

    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1,
      goal2, bomb, status, city_id, referee_id, zriteli, penalty, game, game2, score, turnir_id, stadia_id) VALUES ($row[0], $row[1], $row[2], NULL, NULL,
        ".var_export($row[9], 1).", '$row[4]', 0,
        0, '$row[6]', $row[7], NULL, NULL, 0, '', '', '', '$row[5]', $row[8], $row[3])";
        var_dump($sql2);
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

}
return;


$query ="SELECT season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1, goal2, bomb, status, city_id, referee_id,
  zriteli, penalty, game, game2 FROM rfplmatch";
//$query = "SELECT count(*) FROM game";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//var_dump($result);
$i = 1;
while ($row = mysqli_fetch_row($result)) {
    $sql2="INSERT INTO game (season_id, team_id, team2_id, player_id, player2_id, tour, data, goal1, goal2, bomb, status, city_id,
      referee_id, zriteli, penalty, game, game2) VALUES ($row[0], $row[1], $row[2], ".var_export($row[3], 1).", ".var_export($row[4], 1).", $row[5], '$row[6]', $row[7],
        $row[8], '$row[9]', $row[10], ".var_export($row[11], 1).", ".var_export($row[12], 1).", ".var_export($row[13], 1).", '$row[14]', '$row[15]', '$row[16]')";
      mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

}