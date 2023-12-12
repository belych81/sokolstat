<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\NhlTable;
use App\Entity\NhlTeam;
use App\Entity\NhlReg;
use App\Entity\NhlPlayer;
use App\Entity\NhlMatch;
use App\Entity\Seasons;
use App\Entity\NhlPlayersTeam;
use App\Entity\Player;
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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

class NhlController extends AbstractController
{
  private EntityManagerInterface $entityManager;

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
        $seasonName = '1992-93';
      } else {
        $seasonName = $season;
      }
      $obDates = $this->entityManager->getRepository(NhlMatch::class)
          ->getDates($seasonName);

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
              ->getMatches($curDate, $season);
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
          $players[$i]->setGoalTeam($arPt[$i][0]->getGoalSum());
          $players[$i]->setAssistTeam($arPt[$i][0]->getAssistSum());
          $players[$i]->setScoreTeam($arPt[$i][0]->getScoreSum());
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
          $session->set('season', $entity->getSeason()->getName());
          $session->set('division', $entity->getDivision()->getName());
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
              ->updateNhltable($team, $team2, $goal1, $goal2, $seas);
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

    public function add(Request $request)
    {
      $nhlReg = new NhlReg();
      $form = $this->createForm(NhlRegType::class, $nhlReg);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          $nhlReg = $form->getData();
          $playerId = $nhlReg->getPlayer()->getId();
          $goal = $nhlReg->getGoal();
          // ... perform some action, such as saving the task to the database
          // for example, if Task is a Doctrine entity, save it!
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
        $this->entityManager->getRepository(NhlPlayer::class)
          ->updateStatPlayer($playerId, $change);
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
