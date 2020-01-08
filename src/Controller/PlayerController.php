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

        return $this->redirect($this->generateUrl('sbornieRus', [
                'season' => $season,
                    ]));
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

    public function newChampLast($season, $team, $country)
    {
        if($country == 'fnl')
        {
          $entity = new Fnlplayer();
        }
        else
        {
          $entity = new Shipplayer();
        }

        $maxId = $this->getDoctrine()->getRepository(Player::class)
                    ->getMaxId();
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $player = $this->getDoctrine()->getRepository(Player::class)
          ->getLastOnePlayer();

        $entity->setTeam($club);
        $entity->setGame(0);
        $entity->setSeason($year);
        $entity->setPlayer($player);

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('championships_show', [
            'id' => $team,
            'country' => $country,
            'season' => $season
                ]));
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
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
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
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

    public function newPlayer()
    {
        $entity = new Player();

        $form   = $this->createForm(PlayerType::class, $entity);
        $maxId = $this->getDoctrine()->getRepository(Player::class)
                    ->getMaxId();

        return $this->render('rusplayer/newPlayer.html.twig', array(
            'entity' => $entity,
            'maxId' => $maxId,
            'form'   => $form->createView()
        ));
    }

    public function createNewPlayer(Request $request, $team, $season, $country)
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
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
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

    public function newChampNation($season, $team, $flag)
    {
        $entity = new Shipplayer();
        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $form = $this->createForm(ShipplayerType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

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
        $form = $this->createForm(ShipplayerType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

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
            return $this->redirect($this->generateUrl('supercup_show', [
                'id' => $id,
                'country' => 'russia'
                    ]));
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

    public function editCup($id, $season, $team, $change)
    {
        $em = $this->getDoctrine();

        $em->getRepository(Cupplayer::class)->updateCupplayer($id, $change);
        $entity = $em->getRepository(Cupplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $teamOb = $entity->getTeam();
        $em->getRepository(Rusplayer::class)->updateRusplayer($playerId, $change);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $teamOb, $change);
        return $this->redirect($this->generateUrl('cup_show', [
                'id' => $team,
                'season' => $season
                    ]));
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

    public function editEc($id, $season, $team, $turnir, $change)
    {
        $em = $this->getDoctrine()->getManager();

        $ecplayer = $em->getRepository(Ecplayer::class)->find($id);
        $player = $ecplayer->getPlayer();
        $club = $ecplayer->getTeam();

        $em->getRepository(Ecplayer::class)->updateEcplayer($id, $change);
        $em->getRepository(Rusplayer::class)->updateRusplayerEcTotal($player, $change);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $change);

        return $this->redirect($this->generateUrl('eurocup_showTeam', [
                'id' => $team,
                'season' => $season,
                'turnir' => $turnir
                    ]));
    }

    public function editMund($id, $year, $country, $turnir, $change)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository(Sostav::class)->updateGamer($id, $change);

        return $this->redirect($this->generateUrl('sbornieCountry', [
                'country' => $country,
                'year' => $year,
                'turnir' => $turnir
                    ]));
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
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);

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
