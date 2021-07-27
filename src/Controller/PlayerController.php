<?php

namespace App\Controller;

use App\Entity\Gamers;
use App\Entity\Team;
use App\Entity\Rusplayer;
use App\Entity\Shipplayer;
use App\Entity\Fnlplayer;
use App\Entity\Cupplayer;
use App\Entity\Lchplayer;
use App\Entity\Ecplayer;
use App\Entity\Sbplayer;
use App\Entity\Supercupplayer;
use App\Entity\Player;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Entity\Sostav;
use App\Entity\Turnir;
use App\Entity\Country;
use App\Form\RusType;
use App\Form\FnlType;
use App\Form\RusplayerType;
use App\Form\PlayerType;
use App\Form\PlayerEditType;
use App\Form\LchplayerType;
use App\Form\ShipplayerType;
use App\Form\ShipplayerTeamType;
use App\Form\ShipplayerEditType;
use App\Form\SbplayerType;
use App\Form\SostavType;
use App\Form\ShipplayerUpdateType;
use App\Form\FnlplayerUpdateType;
use App\Service\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlayerController extends AbstractController
{
    public function edit($id)
    {
        $entity = $this->getDoctrine()->getRepository(Player::class)->find($id);
        $form   = $this->createForm(PlayerEditType::class, $entity);

        return $this->render('player/edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function update(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Player::class)->find($id);
        $form   = $this->createForm(PlayerEditType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $translit = $entity->getTranslit();
            return $this->redirect($this->generateUrl('player_show', [
              'id' => $translit]));
        }

        return $this->render('player/edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editShipplayer($id, $season, $country, $team)
    {
        $entity = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $form   = $this->createForm(ShipplayerEditType::class, $entity);

        return $this->render('player/editShipplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function updateShipplayer(Request $request, $id, $season, $country, $team)
    {
        $entity = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $form   = $this->createForm(ShipplayerEditType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('championships_show', [
              'id' => $team, 'season' => $season, 'country' => $country]));
        }

        return $this->render('player/editShipplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editChamp(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Gamers::class)->updateGamer($id, $change);
        $entity = $this->getDoctrine()->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $teamOb = $entity->getTeam();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateRusplayer($playerId, $change);
        $this->getDoctrine()->getRepository(Playersteam::class)
                ->updatePlayersteam($player, $teamOb, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function editSb(SessionInterface $session, $id, $season, $change)
    {
        $this->getDoctrine()->getRepository(Sbplayer::class)->updateSb($id, $change);
        $entity = $this->getDoctrine()->getRepository(Sbplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateSbplayer($playerId, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function editTotalChamp($id, $season, $team, $change)
    {
        $entity = $this->getDoctrine()->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateRusplayerTotalChamp($playerId, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function editTotalTeam($id, $season, $team, $change)
    {
        $entity = $this->getDoctrine()->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $teamOb = $entity->getTeam();
        $this->getDoctrine()->getRepository(Playersteam::class)
          ->updateTotalTeam($playerId, $teamOb, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function editTotal($id, $season, $team, $change)
    {
        $entity = $this->getDoctrine()->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateRusplayerTotal($playerId, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function newChampLast($season, $team, $country, $route, $isTeam)
    {
        $em = $this->getDoctrine()->getManager();
        if($isTeam){
          $player = $this->getDoctrine()->getRepository(Player::class)
            ->getLastTeamPlayer($team);
        } else {
          $player = $this->getDoctrine()->getRepository(Player::class)
            ->getLastOnePlayer();
        }
        switch($country){
          case 'fnl' : $entity = new Fnlplayer(); break;
          case 'leagueChampions' : $entity = new Lchplayer(); break;
          case 'cup' :
          case 'russia' :
            if($country == 'cup'){
              $entity = new Cupplayer();
            } else {
              $entity = new Gamers();
              $entity->setTotalgame(0);
            }
            if(!$isTeam){
              $rusplayer = new Rusplayer();
              $rusplayer->setPlayer($player);
              $em->persist($rusplayer);
              $em->flush();
            }
            $entity2 = new Playersteam();
            $entity2->setGame(0);
            $entity2->setGoal(0);
            $entity2->setPlayer($player);
            $team2 = $this->getDoctrine()->getRepository(Team::class)
                        ->findOneByTranslit($team);
            $entity2->setTeam($team2);

            $em->persist($entity2);
            $em->flush();
            break;
          default:
            $entity = new Shipplayer();
        }

        $maxId = $this->getDoctrine()->getRepository(Player::class)
                    ->getMaxId();
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);

        $entity->setTeam($club);
        $entity->setGame(0);
        $entity->setSeason($year);
        $entity->setPlayer($player);

        $em->persist($entity);
        $em->flush();

        $routeParams = [
          'id' => $team,
          'season' => $season
        ];
        if($route == 'championships_show'){
          $routeParams['country'] = $country;
        } elseif($route == 'eurocup_show'){
          $routeParams['turnir'] = 'leagueChampions';
        }
        return $this->redirect($this->generateUrl($route, $routeParams));
    }

    public function newChamp($season, $team)
    {
        $entity = new Gamers();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newChamp.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChamp(Request $request, $team, $season)
    {
        $entity  = new Gamers();
        $rusplayer = new RusPlayer();
        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);

        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $goal = (int)$form->get('goal')->getData();
            $entity->setTotalgoal($goal);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $this->getDoctrine()->getRepository(Rusplayer::class)
                ->updateRusplayerChamp($player, $goal);
            $this->getDoctrine()->getRepository(Playersteam::class)
                ->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newChamp.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newMund($year, $country, $turnir)
    {
        $entity = new Sostav();

        $form   = $this->createForm(SostavType::class, $entity, ['year' => $year,
            'country' => $country]);

        return $this->render('rusplayer/newMund.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createMund(Request $request, $year, $country, $turnir)
    {
        $entity  = new Sostav();
        $rusplayer = new RusPlayer();

        $form   = $this->createForm(SostavType::class, $entity, ['year' => $year,
            'country' => $country]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $year = $em->getRepository(Seasons::class)->findOneByName($year);
            $countr = $em->getRepository(Country::class)->findOneByTranslit($country);
            $entity->setSeason($year);
            $entity->setCountry($countr);
            $em->persist($entity);
            $em->flush();
            /*$player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $this->getDoctrine()->getRepository(Rusplayer::class)
                ->updateRusplayerChamp($player, $goal);
            $this->getDoctrine()->getRepository(Playersteam::class)
                ->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
              ]));*/
        }

        return $this->render('rusplayer/newMund.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newPlayersteam($team, $season, $turnir)
    {
        $entity = new Playersteam();

        $form   = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newPlayersteam.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createPlayersteam(Request $request, $team, $season, $turnir)
    {
        $entity = new Playersteam();
        $entity->setGame(0);

        $form = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $team2 = $this->getDoctrine()->getRepository(Team::class)
                        ->findOneByTranslit($team);
            $entity->setTeam($team2);
            $entity->setGoal(0);
            $em->persist($entity);
            $em->flush();

            if($turnir == 'champ'){
              return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
                    ]));
            } else {
              return $this->redirect($this->generateUrl('cup_show', [
                'id' => $team,
                'season' => $season
                    ]));
            }
        }

        return $this->render('rusplayer/newPlayersteam.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newRusplayer()
    {
        $entity = new Rusplayer();

        $form   = $this->createForm(RusplayerType::class, $entity);

        return $this->render('rusplayer/newRusplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createRusplayer(Request $request, $team, $season, $country)
    {
        $entity = new Rusplayer();

        $form = $this->createForm(RusplayerType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $entity2 = new Playersteam();
            $entity2->setGame(0);
            $entity2->setGoal(0);
            $entity2->setPlayer($entity->getPlayer());
            $team2 = $this->getDoctrine()->getRepository(Team::class)
                        ->findOneByTranslit($team);
            $entity2->setTeam($team2);
            $em->persist($entity2);
            $em->flush();

            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newRusplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newPlayer(Menu $menu)
    {
        $entity = new Player();

        $form   = $this->createForm(PlayerType::class, $entity);
        $maxId = $this->getDoctrine()->getRepository(Player::class)->getMaxId();

        return $this->render('rusplayer/newPlayer.html.twig', array(
            'entity' => $entity,
            'maxId' => $maxId,
            'menu' => $menu,
            'form'   => $form->createView()
        ));
    }

    public function createNewPlayer(Request $request, $team, $season, $country, $route)
    {
        $entity  = new Player();

        $form = $this->createForm(PlayerType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setInsertdate(new \DateTime());
            $em->persist($entity);
            $em->flush();
            if($country == 'russia' || $country == 'fnl') {
                $rusplayer = new Rusplayer();
                $rusplayer->setPlayer($entity);
                $em->persist($rusplayer);
                $em->flush();
            }
            $routeParams = [
              'id' => $team,
              'season' => $season
            ];
            if($route == 'championships_show'){
              $routeParams['country'] = $country;
            } elseif($route == 'eurocup_show'){
              $routeParams['turnir'] = $country;
            }
            return $this->redirect($this->generateUrl($route, $routeParams));
        }

        return $this->render('rusplayer/newPlayer.html.twig', ['entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }

    public function editNation(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoal($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        if($change == 'plusGame' || $change == 'minusGame')
        {
          $this->getDoctrine()->getRepository(Player::class)
            ->updatePlayerGame($player_id, $change);
        }
        else
        {
          $this->getDoctrine()->getRepository(Player::class)
            ->updatePlayerTotalGoal($player_id, $change, 1);
        }
        $session->set('lastPlayer', $player->getPlayer()->getName());

        $response = json_encode([
            'name' => $player->getPlayer()->getName(),
            'game' => $player->getGame(),
            'goal' => $player->getGoal()
        ]);
        return new Response($response);
    }

    public function editNationCup(SessionInterface $session, $id, $country,
      $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoalCup($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 1);
        $session->set('lastPlayer', $player->getPlayer()->getName());

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => $country
                    ]));
    }

    public function editNationSupercup(SessionInterface $session, $id, $country,
      $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoalSupercup($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 1);
        $session->set('lastPlayer', $player->getPlayer()->getName());

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => $country
                    ]));
    }

    public function editNationEurocup(SessionInterface $session, $id, $country,
      $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoalEurocup($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 0, 1);
        $session->set('lastPlayer', $player->getPlayer()->getName());

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => $country
                    ]));
    }

    public function editNationSbornie(SessionInterface $session, $id, $country,
      $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoalSbornie($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 0, 0, 0, 1);
        $session->set('lastPlayer', $player->getPlayer()->getName());

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => $country
                    ]));
    }

    public function newChampNation($season, $team, $flag)
    {
        $entity = new Shipplayer();
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($team);
        $country = $club->getCountry()->getName();
        $form = $this->createForm(ShipplayerType::class, $entity, [
          'season' => $season, 'team' => $team, 'flag' => $flag, 'club' => $club,
          'country' => $country]);

        return $this->render('shiptable/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChampNation(Request $request, $team, $season, $country, $flag)
    {
        $entity  = new Shipplayer();

        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(ShipplayerType::class, $entity, [
          'season' => $season, 'team' => $team, 'flag' => $flag, 'club' => $club,
          'country' => $country]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $id = $entity->getId();
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
                  ->updatePlayerGame($player_id, false, $game);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('shiptable/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function confirm($id, $type, $country)
    {
        switch($type){
          case 'Shipplayer' :
            $entity = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
            break;
          case 'Cupplayer' :
            $entity = $this->getDoctrine()->getRepository(Cupplayer::class)->find($id);
            break;
        }
        return $this->render('shiptable/deleteShipplayer.html.twig', array(
            'entity' => $entity,
            'country' => $country
        ));
    }

    public function delete($id, $type, $country)
    {
        $em = $this->getDoctrine()->getManager();
        $routeParams = [];
        switch($type){
          case 'Shipplayer' :
            $entity = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
            $route = 'championships_show';
            $routeParams['country'] = $country;
            break;
          case 'Cupplayer' :
            $entity = $this->getDoctrine()->getRepository(Cupplayer::class)->find($id);
            $route = 'cup_show';
            break;
        }

        $routeParams['season'] = $entity->getSeason()->getName();
        $routeParams['id'] = $entity->getTeam()->getTranslit();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl($route, $routeParams));
    }

    public function editPlayerTurnirs($season, $team, $country)
    {
      if($country == 'fnl')
      {
        $entity = new Fnlplayer();

        $editForm = $this->createForm(FnlplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
      else
      {
        $entity = new Shipplayer();

        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }


        return $this->render('rusplayer/editPlayerTurnirs.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    public function updatePlayerTurnirs(Request $request, $season, $team, $country)
    {
      $teamOb = $this->getDoctrine()->getRepository(Team::class)
        ->findOneByTranslit($team);
      $seasonOb = $this->getDoctrine()->getRepository(Seasons::class)
        ->findOneByName($season);
      if($country == 'fnl')
      {
        $entity = new Fnlplayer();
        $editForm = $this->createForm(FnlplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
      else
      {
        $entity = new Shipplayer();
        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
        $editForm->handleRequest($request);
        $player = $editForm['player']->getData();

        if ($editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $player = $editForm["player"]->getData()->getId();
            $game= $editForm['game']->getData();
            $goal= $editForm['goal']->getData();
            if($country != 'fnl')
            {
              $cup= $editForm['cup']->getData();
              $eurocup= $editForm['eurocup']->getData();
              $supercup= $editForm['supercup']->getData();
              $em->getRepository(Shipplayer::class)->updatePlayerTurnirs($player,
                $game, $goal, $cup, $eurocup, $supercup, $seasonOb->getId(),
                $teamOb->getId());
              $em->getRepository(Player::class)
               ->updatePlayerTurnirs($player, $game, $goal, $cup, $eurocup, $supercup);
            }
            else
            {
              $em->getRepository(Fnlplayer::class)->updateFullFnlplayer($player,
                $game, $goal, $seasonOb->getId(), $teamOb->getId());
              $em->getRepository(Rusplayer::class)->updateRusplayerTotalFnl($player,
                $game, $goal);
            }
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/editPlayerTurnirs.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            ]);
    }

    public function editFnl(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Fnlplayer::class)
          ->updateFnlplayer($id, $change);
        $entity = $this->getDoctrine()->getRepository(Fnlplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateRusplayerFnl($playerId, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());
        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function newFnl($season, $team)
    {
        $entity = new Fnlplayer();

        $form   = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newFnl.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createFnl(Request $request, $team, $season)
    {
        $entity  = new Fnlplayer();
        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $game = $entity->getGame();
            $em->getRepository(Rusplayer::class)
              ->updateRusplayerTotalFnl($player, $game, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'fnl',
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newFnl.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newSc($season, $team, $id)
    {
        $entity = new Supercupplayer();
        $club = $this->getDoctrine()->getRepository(Team::class)->findOneById($team);
        $translit = $club->getTranslit();
        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $translit]);

        return $this->render('rusplayer/newSc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createSc(Request $request, $team, $season, $id)
    {
        $entity  = new Supercupplayer();

        $club = $this->getDoctrine()->getRepository(Team::class)->findOneById($team);
        $translit = $club->getTranslit();
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $translit]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            /*return $this->redirect($this->generateUrl('supercup_show', [
                'id' => $id,
                'country' => 'russia'
              ]));*/
        }

        return $this->render('rusplayer/newSc.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }

    public function newCup($season, $team)
    {
        $entity = new Cupplayer();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newCup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createCup(Request $request, $team, $season)
    {
        $entity  = new Cupplayer();

        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer()->getId();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerCup($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('cup_show', [
                'id' => $team,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newCup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editCup(SessionInterface $session, $id, $season, $team, $change)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository(Cupplayer::class)->updateCupplayer($id, $change);
        $entity = $em->getRepository(Cupplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $playerName = $player->getName();
        $teamOb = $entity->getTeam();
        $em->getRepository(Rusplayer::class)->updateRusplayer($playerId, $change);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $teamOb, $change);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function editLchplayer(SessionInterface $session, $id, $season, $team, $change)
    {
      $this->getDoctrine()->getRepository(Lchplayer::class)->updateLchplayerGoal($id, $change);
      $player = $this->getDoctrine()->getRepository(Lchplayer::class)->find($id);
      $player_id = $player->getPlayer()->getId();

      if (strpos($change, 'Game') !== false)
      {
        $this->getDoctrine()->getRepository(Player::class)->updatePlayerLchGame($player_id, $change);
      }
      elseif (strpos($change, 'Goal') !== false)
      {
        $this->getDoctrine()->getRepository(Player::class)->updatePlayerLchGoal($player_id, $change);
      }

      $session->set('lastPlayer', $player->getPlayer()->getName());

      $response = json_encode([
          'name' => $player->getPlayer()->getName(),
          'game' => $player->getGame(),
          'goal' => $player->getGoal()
      ]);
      return new Response($response);
    }

    public function newLchPlayer($season, $team)
    {
        $entity = new Lchplayer();

        $form   = $this->createForm(LchplayerType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('eurocup/newLchPlayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createLchPlayer(Request $request, $team, $season)
    {
        $entity  = new Lchplayer();
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Team::class)->findOneByTranslit($team);
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $entity->setGame(1);
        $form = $this->createForm(LchplayerType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer()->getId();
            $game = $entity->getGame();
            $goal = $entity->getGoal();
            $em->getRepository(Player::class)
              ->updatePlayerLch($player, $game, $goal);
            /*$em->getRepository('SteamFbstatBundle:Rusplayer')
                    ->updateRusplayerEc($player, $goal);*/
            return $this->redirect($this->generateUrl('eurocup_show', [
                'id' => $team,
                'season' => $season,
                'turnir' => 'leagueChampions'
                    ]));
        }

        return $this->render('eurocup/newLchPlayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editEc(SessionInterface $session, $id, $season, $team, $turnir, $change)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Ecplayer::class)->updateEcplayer($id, $change);
        $ecplayer = $em->getRepository(Ecplayer::class)->find($id);
        $player = $ecplayer->getPlayer();
        $club = $ecplayer->getTeam();
        $gamerId = $em->getRepository(Gamers::class)->getGamerByPlayerAndTeamAndSeason($player->getId(), $club->getId(), $season);
        $em->getRepository(Gamers::class)->updateGamer($gamerId, $change, true);
        $em->getRepository(Rusplayer::class)->updateRusplayerEcTotal($player, $change);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $change);
        $playerName = $player->getName();
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $ecplayer->getGame(),
            'goal' => $ecplayer->getGoal()
        ]);
        return new Response($response);
    }

    public function editMund(SessionInterface $session, $id, $change)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository(Sostav::class)->updateGamer($id, $change);
        $sostavPlayer = $em->getRepository(Sostav::class)->find($id);
        $playerName = $sostavPlayer->getPlayer()->getName();
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $sostavPlayer->getGame(),
            'goal' => $sostavPlayer->getGoal()
        ]);
        return new Response($response);
    }

    public function newEc($season, $team)
    {
        $entity = new Ecplayer();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newEc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createEc(Request $request, $team, $season, $turnir)
    {
        $entity  = new Ecplayer();
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Team::class)->findOneByTranslit($team);
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $cup = $em->getRepository(Turnir::class)->findOneByAlias($turnir);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $entity->setTurnir($cup);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('eurocup_showTeam', [
                'id' => $team,
                'turnir' => $turnir,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newEc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newSb($season)
    {
        $entity = new Sbplayer();
        $form   = $this->createForm(SbplayerType::class, $entity,
         ['season' => $season]);

        return $this->render('rusplayer/newSb.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createSb(Request $request, $season)
    {
        $entity  = new Sbplayer();
        $form = $this->createForm(SbplayerType::class, $entity, ['season' => $season]);
        $em = $this->getDoctrine()->getManager();
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $entity->setSeason($year);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $games = $em->getRepository(Sbplayer::class)
              ->getSbSum($entity->getPlayer()->getId());
            $goals = $em->getRepository(Sbplayer::class)
              ->getSbSum($entity->getPlayer()->getId(), 'goal');
            $em->getRepository(Rusplayer::class)->updateRusplayerSb($player, $goal);

            return $this->redirect($this->generateUrl('sbornieRus', [
                'season' => $season
            ]));
        }

        return $this->render('rusplayer/newSb.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }
}
