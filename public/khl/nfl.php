<?php

class Nfl 
{
    private $host;
    private $dbnameMain;
    private $dbuser;
    private $dbpassword;
    private $mysqli;
    private $mysqliMain;
    private $teamIds = [];
    
    public function init()
    {
        $this->host         = 'localhost';
        $this->dbuser  = 'belych'; 
        $this->dbpassword  = 'Larisa2013+'; 
    }
    
    public function setConnectionDb($dbname){
        $link = new mysqli($this->host, $this -> dbuser, $this -> dbpassword, $dbname);
        if ($link->connect_error) 
            die("Ошибка: " . $link->connect_error);
        if($dbname == 'khl'){
            $this->mysqli = $link;
        } else {
            $this->mysqliMain = $link;
        }
    }
    
    
    public function closeConnectionDb(){
        $this -> mysqli -> close();
    }
    
    public function getImageTeam($name)
    {
        $arr = $this->mysqli->query("SELECT id, image FROM teams WHERE name='$name'");
        
        
        return $arr->fetch_assoc();
    }
    
    public function getMatchesByFile($pathfile)
    {
        $lines = file($pathfile);
        $matches = [];
        foreach($lines as $line){
            $matches[] = explode(" - ", trim($line));
            
        }
        return $matches;
    }
    
    public function parseMatches($matches)
    {
        foreach($matches as $match){

            if($this->teamIds[$match[0]]){
                $id1 = $this->teamIds[$match[0]];
            } else {
                $id1 = $this->addTeam($match[0]);
                $this->teamIds[$match[0]] = $id1;
            }
            if($this->teamIds[$match[1]]){
                $id2 = $this->teamIds[$match[1]];
            } else {
                $id2 = $this->addTeam($match[1]);
                $this->teamIds[$match[1]] = $id2;
            }
            if($id1 && $id2){
                $this->addMatch($id1, $id2);
            }
            //break;
        }
    }
    
    public function setTeamIds()
    {
        $arr = $this->mysqli->query("SELECT id, name FROM `teams`");
        foreach($arr as $row){
            $this->teamIds[$row['name']] = $row['id'];
        }
    }
    
    private function getTeamId($team)
    {
        return $this->mysqli->query("SELECT id FROM `teams` WHERE `name` = " . $team);
    }
    
    private function addTeam($name)
    {
        if($this->mysqli->query("INSERT INTO teams (name) VALUES ('$name')")){
            return $this->mysqli->insert_id;
        } else {

            return $this->mysqli->error;
        }
        
    }
    
    private function addMatch($team1, $team2)
    {
        $this->mysqli->query("INSERT INTO matches (turnir, team, team2) VALUES (1, $team1, $team2)");
        
        return $this->mysqli->insert_id;
    }
    
    public function addPlayer($name, $team_id)
    {
        $this->mysqli->query("INSERT INTO sostavs (name, team_id) VALUES ('$name', $team_id)");
        
        return $this->mysqli->insert_id;
    }
    
    public function search($q)
    {
        $arr = [];
        $sql = "SELECT t.name AS team, s.name FROM sostavs s JOIN teams t ON s.team_id=t.id WHERE s.name LIKE '%" . $this->mysqli->real_escape_string($q) . "%' LIMIT 15";
        //var_dump($)
        $ob = $this->mysqli->query($sql);   
        while($row = $ob->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }
    
    public function getTeams()
    {
        $arr = [];
        $sql = "SELECT DISTINCT t.id AS id, t.image FROM sostavs s JOIN teams t ON s.team_id=t.id ORDER BY t.name";

        $ob = $this->mysqli->query($sql);   
        while($row = $ob->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }
    
    public function getNextMatch($id)
    {
        $arr = [];
        $id = $this->mysqli->real_escape_string($id);
        $sql = "SELECT id, team, team2 FROM matches WHERE status=0 AND (team=". $id ." OR team2=". $id .") ORDER BY RAND() LIMIT 7";

        $ob = $this->mysqli->query($sql);   
        while($row = $ob->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }
    
    public function getNextTeam($arTeams)
    {
        $arr = [];
        $ids = implode(',', $arTeams);
        $sql = "SELECT id, name, image, matches FROM teams WHERE id IN (" . $ids . ") ORDER BY matches ASC LIMIT 3";

        $ob = $this->mysqli->query($sql);   
        while($row = $ob->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }
    
    public function getTeamById($id)
    {
        $arr = [];
        $sql = "SELECT name, image FROM teams WHERE id=" . $id;

        $ob = $this->mysqli->query($sql);   
        if($row = $ob->fetch_assoc()){
            $arr = $row;
        }
        return $arr;
    }
    
    public function statusMatch($id)
    {
        $sql = "UPDATE matches SET status=1 WHERE id=" . $id;

        $this->mysqli->query($sql);
    }
    
    public function addTeamsMatch($team, $team2)
    {
        $sql = "UPDATE teams SET matches=matches+1 WHERE id=" . $team . " OR id=" . $team2;

        $this->mysqli->query($sql);
    }
    
    public function getMinPlayers()
    {
        $arr = [];
        $sqlT = "SELECT COUNT(DISTINCT team_id) AS cnt FROM sostavs";
        $obT = $this->mysqli->query($sqlT);
        if($row = $obT->fetch_assoc()){
            if($row['cnt'] < 30){
                $sql = "SELECT DISTINCT team FROM matches WHERE team NOT IN (SELECT team_id FROM sostavs) ORDER BY RAND() LIMIT 3";
                $ob = $this->mysqli->query($sql);   
                while($row = $ob->fetch_assoc()){
                    $arr[] = $row['team'];
                }
            } else {
                $sql = "SELECT team_id FROM sostavs GROUP BY team_id HAVING COUNT(id) = (SELECT MIN(cnt) FROM (SELECT COUNT(id) AS cnt, team_id FROM sostavs GROUP BY team_id) AS T2) ORDER BY RAND() LIMIT 3";

                $ob = $this->mysqli->query($sql);   
                while($row = $ob->fetch_assoc()){
                    $arr[] = $row['team_id'];
                }
            }
        }
        return $arr;
    }
}