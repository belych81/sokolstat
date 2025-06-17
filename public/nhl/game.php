<?php
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);

require_once "nfl.php";

$game = new Nfl();
$game->init();
$game->setConnectionDb('nhl');
//$lines = $game->getMatchesByFile('nfl2022.txt');
//var_dump($lines)
//$game->setTeamIds();
//$game->parseMatches($lines);
$img = $game->getImageTeam('МОНАКО');
$teams = $game->getTeams();


if($_POST['name']){
    $name = htmlspecialchars($_POST['name']);
    $team_id = (int)$_POST['team_id'];
    $id = $game->addPlayer($name, $team_id);
}
?>
<!DOCTYPE html>
    <head>
        <title>NFL</title>
        <link rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="style.css" />
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="teams-list">
                <?foreach($teams as $team){?>
                    <div class="" data-id="<?= $team['id'] ?>"><img src="/nhl/images/<?= $team['image'] ?>"></div>
                <?}?>
            </div>
            <div class="search-top">
                <div class="search">
                  <form action="" method="get">
                    <input type="text" name="q" size="6"
                      value=""
                      placeholder="Игрок"
                      class="search_keywords" autocomplete="off"/>
                    <input type="submit" value="OK" class="search-btn" />
                  </form>
                </div>
                <div class="search_result">
                  <div class="search_result_items"></div>
                </div>
              </div>
              <div class="search-top">
                <div class="search">
                  <form action="" method="get" id="add_player_form">
                    <input type="text" name="q" size="6"
                      value=""
                      placeholder="Добавить игрока"
                      class="search_team" autocomplete="off"/>
                    <input type="submit" value="OK" class="search-btn" />
                  </form>
                </div>
              </div>
              
              <div class="match_images">
              </div>
              
            <!--div class="form_add_player">
                <form action="" method="post">
                    Игрок <input type="text" name="name" value="<?= $_POST['name'] ?>" /><br/>
                    Команда <input type="text" name="team_id" value="<?= $_POST['team_id'] ?>" /><br/>
                    <input type="submit" value="OK">
                </form>
                <img src="/nfl/images/<?= $img['image'] ?>">
            </div-->
            
            <div class="matches-tour"></div
        </div>
    </body>
</html>
