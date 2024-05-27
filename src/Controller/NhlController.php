<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\NhlTable;
use App\Entity\NhlTeam;
use App\Entity\NhlReg;
use App\Entity\NhlPlayer;
use App\Entity\NhlMatch;
use App\Entity\NflMatch;
use App\Entity\NhlStadia;
use App\Entity\Seasons;
use App\Entity\NhlPlayersTeam;
use App\Entity\Player;
use App\Entity\Game;
use App\Entity\Mundial;
use App\Form\NhlTableType;
use App\Form\NhlMatchType;
use App\Form\NhlPlayerType;
use App\Form\NhlMatch2Type;
use App\Form\NhlPlayerEditType;
use App\Form\NhlRegType;
use App\Form\NhlChampType;
use App\Form\NhlPlayersteamType;
use App\Form\ShipplayerType;
use App\Repository\SeasonsRepository;
use App\Service\ResizeImage;
use App\Service\Nfl;
use App\Service\Props;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

class NhlController extends AbstractController
{
  private EntityManagerInterface $entityManager;

  const NFL_MATCHES_LIMIT = 60;

  public function __construct(EntityManagerInterface $entityManager)
  {
      $this->entityManager = $entityManager;
  }

  public function index(Request $request, $season)
  {
      $seasons = $this->entityManager->getRepository(NhlTable::class)
        ->getSeasons();
      $routeName = $request->attributes->get('_route');

      $dates = [];
      if($routeName != 'nhl_season'){
        $date = \DateTime::createFromFormat('Y-m-d', $season);
        $month = $date->format('n');
        $year1 = $date->format('Y');
        if($month > 7){
          $year2 = $year1 + 1;
          $seasonName = $year1 . '-' . substr($year2, 2, 2);
        } else {
          $year2 = $year1 - 1;
          $seasonName = $year2 . '-' . substr($year1, 2, 2);
        }
      } else {
        $seasonName = $season;
      }
      $obDates = $this->entityManager->getRepository(NhlMatch::class)
          ->getDates($seasonName);

      $keyLast = 0;
      
      if($routeName == 'nhl_season'){
        $keyLast = array_key_last($obDates);
      } else {
        foreach ($obDates as $key => $arr) {
          if($arr[1] == $season){
            $keyLast = $key;
            break;
          }
        }
      }
      $obNextDate = false;
      $obPrevDate = false;
      $obCurDate = false;
      $dates = [];
      if($keyLast || $keyLast === 0){
          $prevKey = $keyLast - 1;
          $curDate = $obDates[$keyLast][1];
          $nextKey = $keyLast + 1;
          if(key_exists($prevKey, $obDates)){
            $obPrevDate = new \DateTime($obDates[$prevKey][1]);
          }
          if(key_exists($nextKey, $obDates)){
            $obNextDate = new \DateTime($obDates[$nextKey][1]);
          }
          $obCurDate = new \DateTime($curDate);
          $matches = $this->entityManager->getRepository(NhlMatch::class)
              ->getMatches($curDate, $seasonName);
          foreach ($matches as $key => $match) {
            $obData = $match->getData();
            $dates[$obData->format("d.m")][] = $match;
          }
      }


      return $this->render('nhl/index.html.twig', [
          'seasons' => $seasons,
          'dates' => $dates,
          'prevDate' => $obPrevDate,
          'curDate' => $obCurDate,
          'nextDate' => $obNextDate
      ]);
  }

  public function standing($season)
  {
      $seasons = $this->entityManager->getRepository(NhlTable::class)
        ->getSeasons();
      $entities = $this->entityManager->getRepository(NhlTable::class)
              ->getTable($season);
      $division = [];
      foreach($entities as $item)
      {
        $division[$item->getDivision()->getName()][] = $item;
      }
      ksort($division);
      
      $conf = [];
      foreach($entities as $item)
      {
        $conf[$item->getDivision()->getConf()->getName()][] = $item;
      }
      
      return $this->render('nhl/standing.html.twig', [
          'seasons' => $seasons,
          'division' => $division,
          'conf' => $conf
      ]);
  }

  public function leaders($season)
  {
      $seasons = $this->entityManager->getRepository(NhlTable::class)
        ->getSeasons();
      $bombs = $this->entityManager->getRepository(NhlReg::class)
        ->getBomb($season);
        $bombSum = [];
        foreach ($bombs as $val) {
          $name = $val->getPlayer()->getName();
          $goal = $val->getGoal();
          $assist = $val->getAssist();
          $score = $val->getScore();
          $team = $val->getTeam()->getName();
          if(key_exists($name, $bombSum)){
            $bombSum[$name]['goal'] += $goal;
            $bombSum[$name]['team'] .= " / ".$team;
          } else {
            $bombSum[$name] = ['player' => $val, 'goal' => $goal,
              'assist' => $assist, 'score' => $score, 'team' => $team,
              'name' => $name];
          }
        }
        $sortGoal = function($f1,$f2)
          {
             if($f1['score'] < $f2['score']){
                 return 1;
             }
             elseif($f1['score'] > $f2['score']) {
                 return -1;
             }
             else {
               if($f1['goal'] < $f2['goal']){
                   return 1;
               }
               elseif($f1['goal'] > $f2['goal']) {
                   return -1;
               }
               else {
                 if($f1['name'] < $f2['name']){
                     return -1;
                 }
                 elseif($f1['name'] > $f2['name']) {
                     return 1;
                 }
                 else {
                     return 0;
                 }
               }
             }
          };
        uasort($bombSum, $sortGoal);
        $bombSum = array_slice($bombSum, 0, 30);

      return $this->render('nhl/leaders.html.twig', [
          'seasons' => $seasons,
          'bombs' => $bombSum
      ]);
  }

  public function champ(Request $request, ResizeImage $resize, Nfl $nfl, $season)
  {
    $isUpload = $request->query->get('upload', false);

    if($isUpload){
      $lines = $nfl->getMatchesByFile('nfl2022.txt');
      if($lines){
        $nfl->setTeamIds();
        $nfl->parseMatches($lines, $season);
      }
    }
    $em = $this->entityManager;

    $year = $em->getRepository(Seasons::class)->findOneByName($season);
    $teams = $em->getRepository(NhlTable::class)->getTeams($season);
    $matches = $em->getRepository(Game::class)->getNflMatches($year->getLastdate(), self::NFL_MATCHES_LIMIT);
    $matchesM = $em->getRepository(Mundial::class)->getNflMatches($year->getLastdate(), self::NFL_MATCHES_LIMIT);
    foreach($matchesM as $key => $match){
      if($match->getId() == $year->getLastId()){ 
        //unset($matchesM[$key]);
        break;
      } elseif($match->getData()->getTimestamp() >= $year->getLastdate()->getTimestamp()){
        break;
      } elseif($match->getData()->format('d.m.Y') == $year->getLastdate()->format('d.m.Y')) {
        unset($matchesM[$key]);
      }
    }
    foreach($matches as $key => $match){
      if($match->getId() == $year->getLastId()){ 
        //unset($matches[$key]);
        break;
      } elseif($match->getData()->getTimestamp() >= $year->getLastdate()->getTimestamp()){
        break;
      } elseif($match->getData()->format('d.m.Y') == $year->getLastdate()->format('d.m.Y')) {
        unset($matches[$key]);
      }
    }
    $matches = array_values($matches);
    $matchesM = array_values($matchesM);

    foreach($teams as $key => $team){
      if($team['image']){
        $teams[$key]['image_small'] = $resize->ResizeImageGet($team['image'], ['width' => 80, 'height' => 80]);
      } else {
        $teams[$key]['image_small'] = '';
      }
    }

    return $this->render('nhl/champ.html.twig', [
      'teams' => $teams,
      'matches' => $matches,
      'matchesM' => $matchesM
    ]);
  }

  public function search(Request $request)
  {
      $query = htmlspecialchars($request->request->get('query'));
      $nfl = htmlspecialchars($request->request->get('nfl'));
      $isFormPlayer = htmlspecialchars($request->request->get('form_player'));
      $player = [];

      if($query){
        $arQuery = explode(" ", $query);

        if($nfl){
          $season = htmlspecialchars($request->request->get('season'));
          $responsePlayer = $this->entityManager->getRepository(NhlReg::class)->searchPlayers($arQuery, $season);
          foreach($responsePlayer as $val){
            $player[$val->getPlayer()->getName()] = $val->getTeam()->getName();
          } 
        } else {
          $responsePlayer = $this->entityManager->getRepository(NhlPlayer::class)->searchPlayers($arQuery);
          foreach($responsePlayer as $val){
            $player[$val->getId()] = $val->getName();
          } 
        }     
      }

      return new JsonResponse($player);
  }

  public function setPlayer(Request $request)
  {
      $player_name = htmlspecialchars($request->request->get('player'));
      $season = htmlspecialchars($request->request->get('season'));
      $team_id = htmlspecialchars($request->request->get('team'));

      $em = $this->entityManager;

      $year = $em->getRepository(Seasons::class)->findOneByName($season);
      $team = $em->getRepository(NhlTeam::class)->findOneById($team_id);
      $player = $em->getRepository(NhlPlayer::class)->findOneByName($player_name);

      if(!is_object($player)){
        $obPlayer = $em->getRepository(Player::class)->findOneByName($player_name);
        $player  = new NhlPlayer();
        $player->setName($obPlayer->getName());
        $player->setBorn($obPlayer->getBorn());
        $player->setTranslit($obPlayer->getTranslit());
        $player->setInsertdate($obPlayer->getInsertdate());
        $player->setCountry($obPlayer->getCountry());
        $player->setAmplua($obPlayer->getAmplua());
        $em->persist($player);
        $em->flush();
      }
      $reg = $em->getRepository(NhlReg::class)->searchPlayers([$player->getName()], $season);
      if(!empty($reg) && is_object($reg[0])){
        $em->getRepository(NhlReg::class)->updateTeamPlayer($reg[0]->getId(), $team_id);
      } else {
        $entity  = new NhlReg();
        $entity->setSeason($year);
        $entity->setTeam($team);
        $entity->setPlayer($player);
        $em->persist($entity);
        $em->flush();
      }

      return new JsonResponse([]);
  }

  public function nextMatch(Request $request)
  {
      $season = htmlspecialchars($request->request->get('season'));
      $team_id = htmlspecialchars($request->request->get('team'));
      $image = htmlspecialchars($request->request->get('image'));
      $teams = json_decode($request->request->get('teams'), 1);

      $em = $this->entityManager;

      $team = $em->getRepository(NhlTeam::class)->findOneById($team_id);
      $nextMatches = $em->getRepository(NflMatch::class)->getNextMatches($season, $team->getTranslit(), $teams);
      $arNextMatches = $arTeams = [];
      if($nextMatches){
        foreach($nextMatches as $match){
            if($match->getTeam()->getId() == $team_id){
                $arTeams[] = $match->getTeam2()->getId();
            } else {
                $arTeams[] = $match->getTeam()->getId();
            }
        }
        $arTeams = array_unique($arTeams);
        $res = $em->getRepository(NhlTeam::class)->getNextTeam($arTeams);
        $json = json_encode($res);
        $arRes = json_decode($json, true);
        $arGame = [];
        foreach($nextMatches as $k => $match){
            if(array_search($match->getTeam()->getId(), array_column($arRes, 'id')) !== false || array_search($match->getTeam2()->getId(), array_column($arRes, 'id')) !== false){
              $arGame[$k]['id'] = $match->getId();
              $arGame[$k]['team'] = $match->getTeam()->getId();
              $arGame[$k]['team2'] = $match->getTeam2()->getId();  
              if(($key = array_search($match->getTeam()->getId(), array_column($arRes, 'id'))) !== false){
                    $arGame[$k]['img1'] = "/images/" . $arRes[$key]['image'];
                    $arGame[$k]['img2'] = $image;
                    $arGame[$k]['matches'] = $arRes[$key]['matches'];
                } elseif(($key2 = array_search($match->getTeam2()->getId(), array_column($arRes, 'id'))) !== false) {
                    $arGame[$k]['img2'] = "/images/" . $arRes[$key2]['image'];
                    $arGame[$k]['img1'] = $image;
                    $arGame[$k]['matches'] = $arRes[$key2]['matches'];
                }
            }
        }
      }

      return new JsonResponse($arGame);
  }

  public function setMatch(Request $request)
  {
      $match_id = htmlspecialchars($request->request->get('id'));
      $team_id = htmlspecialchars($request->request->get('team'));
      $team2_id = htmlspecialchars($request->request->get('team2'));

      $em = $this->entityManager;

      $em->getRepository(NflMatch::class)->setStatus($match_id, 1); 
      $em->getRepository(NhlTeam::class)->addMatchCount($team_id, $team2_id);      

      return new JsonResponse([]);
  }

  public function nflEnd(Request $request)
  {
      $id = htmlspecialchars($request->request->get('id'));
      $season = htmlspecialchars($request->request->get('season'));
      $data = new \DateTime(htmlspecialchars($request->request->get('data')));

      $em = $this->entityManager;
      $year = $em->getRepository(Seasons::class)->findOneByName($season);
      $em->getRepository(Seasons::class)->setNflLastMatch($id, $year->getId(), $data);      

      return new JsonResponse([]);
  }

  public function applyMatches(Request $request)
  {
      $data = $request->request->all();
      $arData = $data['data'];
      $season = $data['season'];

      $em = $this->entityManager;

      if(!empty($arData)){
        $year = $em->getRepository(Seasons::class)->findOneByName($season);

        foreach($arData as $arr){
          $team = $em->getRepository(NhlTeam::class)->findOneById($arr['team']);
          $team2 = $em->getRepository(NhlTeam::class)->findOneById($arr['team2']);
          $stadia = $em->getRepository(NhlStadia::class)->findOneById(1);

          $arr['ot'] = $arr['ot'] === 'false' ? false : (bool)$arr['ot'];
          $entity  = new NhlMatch();

          $entity->setSeason($year);
          $entity->setTeam($team);
          $entity->setStatus(0);
          $entity->setTeam2($team2);
          $entity->setGoal1($arr['goal1']);
          $entity->setGoal2($arr['goal2']);
          $entity->setData(new \DateTime());
          $entity->setStadia($stadia);
          $entity->setBomb($arr['bomb']);
          $entity->setOvertime($arr['ot']);

          $em->persist($entity);
          $em->flush();

          $em->getRepository(NhlTable::class)->updateNhltable($arr['team'], $arr['team2'], $arr['goal1'], $arr['goal2'], $year->getId(), $arr['ot']);
        }
      }   

      return new JsonResponse($arData);
  }

  public function playerChooseTeam(Request $request, Props $props)
  {
      $player_name = htmlspecialchars($request->request->get('player'));
      $season = htmlspecialchars($request->request->get('season'));
      $em = $this->entityManager;

      $limit = 30;
      $champs32 = $props->getChamps32();
      foreach($champs32 as $champ){
        if(strpos($season, $champ) !== false){
          $limit = 32;
          break;
        }
      }
      $year = $em->getRepository(Seasons::class)->findOneByName($season);
      $season_id = $year->getId();
      $stmt = $em->getConnection()
          ->prepare("SELECT COUNT(DISTINCT team_id) AS cnt FROM nhl_reg WHERE season_id = :sid");
      $stmt->bindValue(':sid', $season_id);
      $arT = $stmt->executeQuery()->fetchAllAssociative();

      if($arT[0]['cnt'] < $limit){
          $sql = "SELECT DISTINCT team_id FROM nfl_match WHERE season_id = :sid AND team_id NOT IN (SELECT team_id FROM nhl_reg WHERE season_id = :sid) ORDER BY RAND() LIMIT 3";
      } else {
          $sql = "SELECT team_id FROM nhl_reg WHERE season_id = :sid GROUP BY team_id HAVING COUNT(id) = (SELECT MIN(cnt) FROM (SELECT COUNT(id) AS cnt, team_id FROM nhl_reg WHERE season_id = :sid GROUP BY team_id) AS T2) ORDER BY RAND() LIMIT 3";
      }
      $stmt2 = $em->getConnection()->prepare($sql);
      $stmt2->bindValue(':sid', $season_id);
      $minPlayersTeams = $stmt2->executeQuery()->fetchAllAssociative();

      $arTeamIds = [];
      foreach($minPlayersTeams as $ar){
        $arTeamIds[] = $ar['team_id'];
      }
      $arTeams = $em->getRepository(NhlTeam::class)->getTeamsByIds($arTeamIds);

      return new JsonResponse($arTeams);
  }

  public function show(SessionInterface $session, ResizeImage $resize, $id, $season)
  {
      $club = $this->entityManager->getRepository(NhlTeam::class)
        ->findOneByTranslit($id);
      $isTeam = $this->entityManager->getRepository(NhlTable::class)
              ->findByTeamAndSeason($club->getId(), $season);
      if(empty($isTeam)){
        return $this->redirect($this->generateUrl('nhl_season', [
            'season' => $season]));
      }
      if($logo= $club->getImage()){
        $club->setImage($resize->ResizeImageGet($logo, ['width' => 270, 'height' => 270]));
      }
      $seasons = $this->entityManager->getRepository(NhlTable::class)
              ->getSeasons();
      $shiptable = $this->entityManager->getRepository(NhlTable::class)
              ->getTable($season);

      $players = $this->entityManager->getRepository(NhlReg::class)
        ->getTeamStat($season, $id);

      $goalies = $this->entityManager->getRepository(NhlReg::class)
          ->getTeamGoalie($season, $id);

      for ($i=0, $cnt=count($players); $i < $cnt; $i++) {
          $name[$i] = $players[$i]->getPlayer()->getName();

          $arPt[$i] = $this->entityManager->getRepository(NhlPlayersTeam::class)
                           ->getStat($name[$i], $id);
          if($arPt[$i]){
            $players[$i]->setGoalTeam($arPt[$i][0]->getGoalSum());
            $players[$i]->setAssistTeam($arPt[$i][0]->getAssistSum());
            $players[$i]->setScoreTeam($arPt[$i][0]->getScoreSum());
          } else {
            $players[$i]->setGoalTeam(0);
            $players[$i]->setAssistTeam(0);
            $players[$i]->setScoreTeam(0);
          }
      }

      for ($i=0, $cnt=count($goalies); $i < $cnt; $i++) {
          $name[$i] = $goalies[$i]->getPlayer()->getName();

          $arPt[$i] = $this->entityManager->getRepository(NhlPlayersTeam::class)
                           ->getStat($name[$i], $id);
          $goalies[$i]->setGameTeam($arPt[$i][0]->getGameSum());
          $goalies[$i]->setZeroTeam($arPt[$i][0]->getZeroSum());
          $goalies[$i]->setMissedTeam($arPt[$i][0]->getMissedSum());
      }
      $teams = $this->entityManager->getRepository(NhlTable::class)
        ->getTeams($season);

      foreach($teams as &$team){
        if($team['image']){
          $team['image'] = $resize->ResizeImageGet($team['image'], ['width' => 80, 'height' => 80]);
        }
      }

      $cntLastMatches = 10;
      if($this->getUser() && in_array('ROLE_ADMIN', $this->getUser()->getRoles())){
          $cntLastMatches = 20;
      }

      $lastMatches = $this->entityManager->getRepository(NhlMatch::class)
                    ->getLastMatchesByTeam($season, $id, $cntLastMatches);

      $lastPlayer = $session->get('lastPlayer');

      return $this->render('nhl/show.html.twig', [
          'players'      => $players,
          'goalies'      => $goalies,
          'seasons' => $seasons,
          'teams' => $teams,
          'club' => $club,
          'lastPlayer' => $lastPlayer,
          'lastMatches' => $lastMatches,
          'shiptable' => $shiptable
      ]);
  }

  public function editPlayer($id)
  {
      $entity = $this->entityManager->getRepository(NhlPlayer::class)->find($id);
      $form   = $this->createForm(NhlPlayerEditType::class, $entity);

      return $this->render('nhl/player_edit.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function updatePlayer(Request $request, $id)
  {
      $entity = $this->entityManager->getRepository(NhlPlayer::class)->find($id);
      $form   = $this->createForm(NhlPlayerEditType::class, $entity);
      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->entityManager;
          $em->persist($entity);
          $em->flush();
          $translit = $entity->getTranslit();
          return $this->redirect($this->generateUrl('nhl_player_show', [
            'id' => $translit]));
      }

      return $this->render('nhl/player_edit.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function newSeason()
  {
      $entity = new NhlTable();

      $form = $this->createForm(NhlTableType::class, $entity);

      return $this->render('nhl/newSeason.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function createSeason(SessionInterface $session, Request $request)
  {

      $ent = NhlTableType::class;
      $entity  = new NhlTable();

      $form = $this->createForm($ent, $entity);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->entityManager;
          //$session->set('season', $entity->getSeason()->getName());
          //$session->set('division', $entity->getDivision()->getName());
          $em->persist($entity);
          $em->flush();
          //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
      }

      return $this->render('nhl/newSeason.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function newMatch($season)
  {
    $entity = new NhlMatch();

    $form   = $this->createForm(NhlMatchType::class, $entity);

    return $this->render('nhl/newMatch.html.twig', array(
        'entity' => $entity,
        'form'   => $form->createView(),
    ));
  }

  public function createMatch(SessionInterface $session, Request $request, $season)
  {
      $ent = NhlMatchType::class;
      $entity  = new NhlMatch();

      $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);

      $entity->setSeason($year);
      $entity->setStatus(1);

      $form = $this->createForm($ent, $entity);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->entityManager;
          $session->set('date', $entity->getData());
          $em->persist($entity);
          $em->flush();
          //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
      }

      return $this->render('nhl/newMatch.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function newRus($id)
  {
      $entity = $this->entityManager->getRepository(NhlMatch::class)->find($id);
      $form   = $this->createForm(NhlMatch2Type::class, $entity);

      return $this->render('nhl/newRus.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function createRus(Request $request, $id)
  {
      $entity = $this->entityManager->getRepository(NhlMatch::class)->find($id);
      $form = $this->createForm(NhlMatch2Type::class, $entity);
      $entity->setStatus(0);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->entityManager;
          $em->persist($entity);
          $em->flush();
          $team=$entity->getTeam()->getId();
          $team2=$entity->getTeam2()->getId();
          $seas=$entity->getSeason()->getId();
          $goal1=$entity->getGoal1();
          $goal2=$entity->getGoal2();
          if($entity->getStadia()->getTranslit() == 'regular'){
            $this->entityManager->getRepository(NhlTable::class)
              ->updateNhltable($team, $team2, $goal1, $goal2, $seas, $entity->isOvertime());
          }
          $this->entityManager->getRepository(NhlTeam::class)
            ->updateSvod($team, $team2, $goal1, $goal2);
          $season = $entity->getSeason()->getName();
          return $this->redirect($this->generateUrl('nhl_season', [
              'season' => $season]));
      }

      return $this->render('nhl/newRus.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function addNhlReg(Request $request)
  {
    $nhlReg = new NhlReg();
  }

  public function add(Request $request)
  {
    $nhlReg = new NhlReg();
    $form = $this->createForm(NhlRegType::class, $nhlReg);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $nhlReg = $form->getData();
        $playerId = $nhlReg->getPlayer()->getId();
        $goal = $nhlReg->getGoal();
        $entityManager = $this->entityManager;
        $entityManager->persist($nhlReg);
        $entityManager->flush();

        $this->entityManager->getRepository(NhlPlayer::class)
          ->updateNhlPlayer($playerId, $goal, 1);
        //return $this->redirectToRoute('nhl_add');
    }

    return $this->render('nhl/add.html.twig', array(
          'form' => $form->createView()
      ));
  }

  public function newPlayer()
  {
      $entity = new NhlPlayer();

      $form   = $this->createForm(NhlPlayerType::class, $entity);
      $maxId = $this->entityManager->getRepository(NhlPlayer::class)
                  ->getMaxId();

      return $this->render('nhl/newPlayer.html.twig', array(
          'entity' => $entity,
          'maxId' => $maxId,
          'form'   => $form->createView()
      ));
  }

  public function createNewPlayer(Request $request, $team, $season)
  {
      $entity  = new NhlPlayer();

      $form = $this->createForm(NhlPlayerType::class, $entity);

      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->entityManager;
          $entity->setInsertdate(new \DateTime());
          $em->persist($entity);
          $em->flush();
          return $this->redirect($this->generateUrl('nhl_show', [
              'id' => $team,
              'season' => $season
                  ]));
      }

      return $this->render('nhl/newPlayer.html.twig', ['entity' => $entity,
          'form'   => $form->createView(),
          ]);
  }

  public function newChampLast($season, $team, $isTeam)
  {
      $entity = new NhlReg();
      $maxId = $this->entityManager->getRepository(NhlPlayer::class)
                  ->getMaxId();
      $club = $this->entityManager->getRepository(NhlTeam::class)
        ->findOneByTranslit($team);
      $year = $this->entityManager->getRepository(Seasons::class)
        ->findOneByName($season);
      
      if($isTeam){
        $player = $this->entityManager->getRepository(NhlPlayer::class)
          ->getLastTeamPlayer($team);
      } else {
        $player = $this->entityManager->getRepository(NhlPlayer::class)
          ->getLastOnePlayer();
      }

      $playersTeam = $this->entityManager->getRepository(NhlPlayersTeam::class)
        ->getStat($player->getName(), $team);

      $em = $this->entityManager;

      if(!$playersTeam)
      {
        $pTeam = new NhlPlayersTeam();
        $pTeam->setTeam($club);
        $pTeam->setPlayer($player);
        $em->persist($pTeam);
        $em->flush();
      }

      $entity->setTeam($club);
      $entity->setSeason($year);
      $entity->setPlayer($player);

      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('nhl_show', [
          'id' => $team,
          'season' => $season
              ]));
  }

  public function showPlayer($id)
  {
      $player = $this->entityManager->getRepository(NhlPlayer::class)
        ->findByTranslit($id);

      $entities = $this->entityManager->getRepository(NhlReg::class)
        ->getStatPlayer($id);

      return $this->render('nhl/showPlayer.html.twig', [
          'entities' => $entities,
          'player' => $player
          ]);
  }

  public function editChamp(SessionInterface $session, $id, $season, $team,
    $change)
  {
      $this->entityManager->getRepository(NhlReg::class)
        ->updateGamer($id, $change);
      $entity = $this->entityManager->getRepository(NhlReg::class)->find($id);
      $playerId = $entity->getPlayer()->getId();
      $player = $entity->getPlayer();
      $teamOb = $entity->getTeam();
      if(strpos($season, 'metro') === false){
        $this->entityManager->getRepository(NhlPlayer::class)
          ->updateStatPlayer($playerId, $change);
      }
      $this->entityManager->getRepository(NhlPlayersTeam::class)
              ->updatePlayersteam($player, $teamOb, $change);
      $session->set('lastPlayer', $entity->getPlayer()->getName());

      $response = json_encode([
          'name' => $entity->getPlayer()->getName(),
          'game' => $entity->getGame(),
          'goal' => $entity->getGoal(),
          'assist' => $entity->getAssist(),
          'score' => $entity->getScore(),
          'missed' => $entity->getMissed(),
          'zero' => $entity->getZero(),
          'gamePo' => $entity->getGamePlayOff(),
          'goalPo' => $entity->getGoalPlayOff(),
          'assistPo' => $entity->getAssistPlayOff(),
          'scorePo' => $entity->getScorePlayOff(),
          'missedPo' => $entity->getMissedPlayOff(),
          'zeroPo' => $entity->getZeroPlayOff()
      ]);
      return new Response($response);
  }

  public function confirm($id)
  {
      $entity = $this->entityManager->getRepository(NhlReg::class)->find($id);

      return $this->render('nhl/delete.html.twig', array(
          'entity' => $entity
      ));
  }

  public function delete($id)
  {
      $em = $this->entityManager;

      $entity = $em->getRepository(NhlReg::class)->find($id);

      $season = $entity->getSeason()->getName();
      $team = $entity->getTeam()->getTranslit();
      $em->remove($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('nhl_show', [
          'season' => $season, 'id' => $team]));
  }

  public function newChampNation($season, $team, $flag)
  {
    $entity = new NhlReg();
    $club = $this->entityManager->getRepository(NhlTeam::class)
      ->findOneByTranslit($team);
    
    $form = $this->createForm(NhlChampType::class, $entity, ['season' => $season,
        'team' => $team, 'flag' => $flag, 'club' => $club]);

    return $this->render('nhl/newChampNation.html.twig', array(
        'entity' => $entity,
        'form'   => $form->createView()
    ));
  }

  public function createChampNation(SessionInterface $session, Request $request, $team, $season, $flag)
  {
      $entity  = new NhlReg();
      $em = $this->entityManager;

      $club = $this->entityManager->getRepository(NhlTeam::class)
        ->findOneByTranslit($team);
      $year = $this->entityManager->getRepository(Seasons::class)
        ->findOneByName($season);
      $entity->setTeam($club);
      $entity->setSeason($year);
      $form = $this->createForm(NhlChampType::class, $entity, ['season' => $season,
          'team' => $team, 'flag' => $flag, 'club' => $club]);

      $form->handleRequest($request);

      if(!$entity->getPlayer()) {
        $selectedPlayer = $session->get('lastPlayerAdd');
        $obPlayer = $this->entityManager->getRepository(Player::class)->findOneById($selectedPlayer);
        $obNhlPlayer = $this->entityManager->getRepository(NhlPlayer::class)->findOneByName($obPlayer->getName());
        if($obNhlPlayer){
          $entity->setPlayer($obNhlPlayer);
        } else {
          $entityPlayer  = new NhlPlayer();
          $entityPlayer->setName($obPlayer->getName());
          $entityPlayer->setBorn($obPlayer->getBorn());
          $entityPlayer->setTranslit($obPlayer->getTranslit());
          $entityPlayer->setInsertdate($obPlayer->getInsertdate());
          $entityPlayer->setCountry($obPlayer->getCountry());
          $entityPlayer->setAmplua($obPlayer->getAmplua());
          $em->persist($entityPlayer);
          $em->flush();

          return $this->redirect($this->generateUrl('nhl_show', [
            'id' => $team,
            'season' => $season
          ]));
        }
      }

      if ($form->isSubmitted() && $form->isValid()) {
          $em->persist($entity);
          $em->flush();
          /*$id = $entity->getId();
          $player_id = $entity->getPlayer()->getId();
          $goal = $entity->getGoal();
          $game = $entity->getGame();
          $cup = $entity->getCup();
          $supercup = $entity->getSupercup();
          $eurocup = $entity->getEurocup();
          $em->getRepository(Shipplayer::class)
              ->updateShipplayerSum($id, $goal, $cup, $supercup, $eurocup);
          $em->getRepository(Player::class)
              ->updatePlayerGoal($player_id, false, $goal, $cup, $supercup, $eurocup);
              $em->getRepository(Player::class)
                ->updatePlayerGame($player_id, false, $game);*/
          return $this->redirect($this->generateUrl('nhl_show', [
              'id' => $team,
              'season' => $season
                  ]));
      }

      return $this->render('nhl/newChampNation.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function newPlayersteam($team, $season)
  {
      $entity = new NhlPlayersTeam();

      $form   = $this->createForm(NhlPlayersteamType::class, $entity, [
          'season' => $season,
          'team' => $team]);

      return $this->render('nhl/newPlayersteam.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView()
      ));
  }

  public function createPlayersteam(Request $request, $team, $season)
  {
      $entity = new NhlPlayersTeam();

      $form = $this->createForm(NhlPlayersteamType::class, $entity, [
          'season' => $season,
          'team' => $team]);

      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->entityManager;
          $team2 = $this->entityManager->getRepository(NhlTeam::class)
                      ->findOneByTranslit($team);
          $entity->setTeam($team2);
          $em->persist($entity);
          $em->flush();

          return $this->redirect($this->generateUrl('nhl_show', [
            'id' => $team,
            'season' => $season
                ]));
      }

      return $this->render('nhl/newPlayersteam.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

}
