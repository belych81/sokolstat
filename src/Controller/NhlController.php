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
use App\Form\NhlTableType;
use App\Form\NhlMatchType;
use App\Form\NhlPlayerType;
use App\Form\NhlMatch2Type;
use App\Form\NhlPlayerEditType;
use App\Form\NhlRegType;
use App\Form\NhlChampType;
use App\Form\NhlPlayersteamType;
use App\Repository\SeasonsRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NhlController extends AbstractController
{
  public function index(Request $request, $season)
  {
    $seasons = $this->getDoctrine()->getRepository(NhlTable::class)
        ->getSeasons();
    $routeName = $request->attributes->get('_route');

      $dates = [];
      if($routeName != 'nhl_season'){
        $seasonName = '1992-93';
      } else {
        $seasonName = $season;
      }
      $obDates = $this->getDoctrine()->getRepository(NhlMatch::class)
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
      if($keyLast){
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
          $matches = $this->getDoctrine()->getRepository(NhlMatch::class)
              ->getMatches($curDate);
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
      $seasons = $this->getDoctrine()->getRepository(NhlTable::class)
        ->getSeasons();
      $entities = $this->getDoctrine()->getRepository(NhlTable::class)
              ->getTable($season);
      $division = [];
      foreach($entities as $item)
      {
        $division[$item->getDivision()->getName()][] = $item;
      }
      return $this->render('nhl/standing.html.twig', [
          'seasons' => $seasons,
          'division' => $division
      ]);
  }

  public function leaders($season)
  {
      $seasons = $this->getDoctrine()->getRepository(NhlTable::class)
        ->getSeasons();
      $bombs = $this->getDoctrine()->getRepository(NhlReg::class)
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

  public function show(SessionInterface $session, $id, $season)
  {
      $club = $this->getDoctrine()->getRepository(NhlTeam::class)
        ->findOneByTranslit($id);
      $isTeam = $this->getDoctrine()->getRepository(NhlTable::class)
              ->findByTeamAndSeason($club->getId(), $season);
      if(empty($isTeam)){
        return $this->redirect($this->generateUrl('nhl_season', [
            'season' => $season]));
      }
      $seasons = $this->getDoctrine()->getRepository(NhlTable::class)
              ->getSeasons();
      $shiptable = $this->getDoctrine()->getRepository(NhlTable::class)
              ->getTable($season);

      $players = $this->getDoctrine()->getRepository(NhlReg::class)
        ->getTeamStat($season, $id);

      $goalies = $this->getDoctrine()->getRepository(NhlReg::class)
          ->getTeamGoalie($season, $id);

      for ($i=0, $cnt=count($players); $i < $cnt; $i++) {
          $name[$i] = $players[$i]->getPlayer()->getName();

          $arPt[$i] = $this->getDoctrine()->getRepository(NhlPlayersTeam::class)
                           ->getStat($name[$i], $id);
          $players[$i]->setGoalTeam($arPt[$i][0]->getGoalSum());
          $players[$i]->setAssistTeam($arPt[$i][0]->getAssistSum());
          $players[$i]->setScoreTeam($arPt[$i][0]->getScoreSum());
      }

      for ($i=0, $cnt=count($goalies); $i < $cnt; $i++) {
          $name[$i] = $goalies[$i]->getPlayer()->getName();

          $arPt[$i] = $this->getDoctrine()->getRepository(NhlPlayersTeam::class)
                           ->getStat($name[$i], $id);
          $goalies[$i]->setGameTeam($arPt[$i][0]->getGameSum());
          $goalies[$i]->setZeroTeam($arPt[$i][0]->getZeroSum());
          $goalies[$i]->setMissedTeam($arPt[$i][0]->getMissedSum());
      }
      $teams = $this->getDoctrine()->getRepository(NhlTable::class)
        ->getTeams($season);

      $lastPlayer = $session->get('lastPlayer');

      return $this->render('nhl/show.html.twig', [
          'players'      => $players,
          'goalies'      => $goalies,
          'seasons' => $seasons,
          'teams' => $teams,
          'club' => $club,
          'lastPlayer' => $lastPlayer,
          'shiptable' => $shiptable
          ]);
  }

  public function editPlayer($id)
  {
      $entity = $this->getDoctrine()->getRepository(NhlPlayer::class)->find($id);
      $form   = $this->createForm(NhlPlayerEditType::class, $entity);

      return $this->render('nhl/player_edit.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function updatePlayer(Request $request, $id)
  {
      $entity = $this->getDoctrine()->getRepository(NhlPlayer::class)->find($id);
      $form   = $this->createForm(NhlPlayerEditType::class, $entity);
      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->getDoctrine()->getManager();
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
          $em = $this->getDoctrine()->getManager();
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

      $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);

      $entity->setSeason($year);
      $entity->setStatus(1);

      $form = $this->createForm($ent, $entity);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
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
      $entity = $this->getDoctrine()->getRepository(NhlMatch::class)->find($id);
      $form   = $this->createForm(NhlMatch2Type::class, $entity);

      return $this->render('nhl/newRus.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function createRus(Request $request, $id)
  {
      $entity = $this->getDoctrine()->getRepository(NhlMatch::class)->find($id);
      $form = $this->createForm(NhlMatch2Type::class, $entity);
      $entity->setStatus(0);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($entity);
          $em->flush();
          $team=$entity->getTeam()->getId();
          $team2=$entity->getTeam2()->getId();
          $seas=$entity->getSeason()->getId();
          $goal1=$entity->getGoal1();
          $goal2=$entity->getGoal2();
          $this->getDoctrine()->getRepository(NhlTable::class)
             ->updateNhltable($team, $team2, $goal1, $goal2, $seas);
          $this->getDoctrine()->getRepository(NhlTeam::class)
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
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($nhlReg);
          $entityManager->flush();

          $this->getDoctrine()->getRepository(NhlPlayer::class)
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
        $maxId = $this->getDoctrine()->getRepository(NhlPlayer::class)
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
            $em = $this->getDoctrine()->getManager();
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

    public function newChampLast($season, $team)
    {
        $entity = new NhlReg();
        $maxId = $this->getDoctrine()->getRepository(NhlPlayer::class)
                    ->getMaxId();
        $club = $this->getDoctrine()->getRepository(NhlTeam::class)
          ->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $player = $this->getDoctrine()->getRepository(NhlPlayer::class)
          ->getLastOnePlayer();
        $playersTeam = $this->getDoctrine()->getRepository(NhlPlayersTeam::class)
          ->getStat($player->getName(), $team);

        $em = $this->getDoctrine()->getManager();

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
        $player = $this->getDoctrine()->getRepository(NhlPlayer::class)
          ->findByTranslit($id);

        $entities = $this->getDoctrine()->getRepository(NhlReg::class)
          ->getStatPlayer($id);

        return $this->render('nhl/showPlayer.html.twig', [
            'entities' => $entities,
            'player' => $player
            ]);
    }

    public function editChamp(SessionInterface $session, $id, $season, $team,
      $change)
    {
        $this->getDoctrine()->getRepository(NhlReg::class)
          ->updateGamer($id, $change);
        $entity = $this->getDoctrine()->getRepository(NhlReg::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $teamOb = $entity->getTeam();
        $this->getDoctrine()->getRepository(NhlPlayer::class)
          ->updateStatPlayer($playerId, $change);
        $this->getDoctrine()->getRepository(NhlPlayersTeam::class)
                ->updatePlayersteam($player, $teamOb, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal(),
            'assist' => $entity->getAssist(),
            'score' => $entity->getScore(),
            'missed' => $entity->getMissed(),
            'zero' => $entity->getZero()
        ]);
        return new Response($response);
    }

    public function confirm($id)
    {
        $entity = $this->getDoctrine()->getRepository(NhlReg::class)->find($id);

        return $this->render('nhl/delete.html.twig', array(
            'entity' => $entity
        ));
    }

    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

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
        $club = $this->getDoctrine()->getRepository(NhlTeam::class)
          ->findOneByTranslit($team);
        $form = $this->createForm(NhlChampType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

        return $this->render('nhl/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChampNation(Request $request, $team, $season, $flag)
    {
        $entity  = new NhlReg();

        $club = $this->getDoctrine()->getRepository(NhlTeam::class)
          ->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(NhlChampType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
            $em = $this->getDoctrine()->getManager();
            $team2 = $this->getDoctrine()->getRepository(NhlTeam::class)
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
