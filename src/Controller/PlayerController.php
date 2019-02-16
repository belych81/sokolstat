<?php

namespace App\Controller;

use App\Entity\Gamers;
use App\Entity\Team;
use App\Entity\Rusplayer;
use App\Entity\Shipplayer;
use App\Entity\Fnlplayer;
use App\Entity\Cupplayer;
use App\Entity\Supercupplayer;
use App\Entity\Player;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Form\RusType;
use App\Form\FnlType;
use App\Form\RusplayerType;
use App\Form\PlayerType;
use App\Form\ShipplayerType;
use App\Form\ShipplayerUpdateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlayerController extends AbstractController
{
    public function editChamp($id, $season, $team, $change)
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
        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
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

    public function newPlayersteam($team, $season)
    {
        $entity = new Playersteam();

        $form   = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newPlayersteam.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createPlayersteam(Request $request, $team, $season)
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

            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
                    ]));
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

        return $this->render('rusplayer/newPlayer.html.twig', array(
            'entity' => $entity,
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

    public function editNation($id, $country, $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Shipplayer::class)
          ->updateShipplayerGoal($id, $change);
        $player = $this->getDoctrine()->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => $country
                    ]));
    }

    public function newChampNation($season, $team)
    {
        $entity = new Shipplayer();

        $form   = $this->createForm(ShipplayerType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('shiptable/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChampNation(Request $request, $team, $season, $country)
    {
        $entity  = new Shipplayer();

        $club = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(ShipplayerType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $id = $entity->getId();
            $player_id = $entity->getPlayer()->getId();
            $goal = $entity->getGoal();
            $cup = $entity->getCup();
            $supercup = $entity->getSupercup();
            $eurocup = $entity->getEurocup();
            $em->getRepository(Shipplayer::class)
               ->updateShipplayerSum($id, $goal, $cup, $supercup, $eurocup);
            $em->getRepository(Player::class)
               ->updatePlayerGoal($player_id, false, $goal, $cup, $supercup, $eurocup);
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
        $entity = new Shipplayer();

        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);

        return $this->render('rusplayer/editPlayerTurnirs.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    public function updatePlayerTurnirs(Request $request, $season, $team, $country)
    {
        $entity = new Shipplayer();
        $teamOb = $this->getDoctrine()->getRepository(Team::class)->findOneByTranslit($team);
        $seasonOb = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
        $editForm->handleRequest($request);
        $player = $editForm['player']->getData();

        if ($editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $player = $editForm["player"]->getData()->getId();
            $cup= $editForm['cup']->getData();
            $eurocup= $editForm['eurocup']->getData();
            $supercup= $editForm['supercup']->getData();
            $em->getRepository(Shipplayer::class)->updatePlayerTurnirs($player, $cup,
              $eurocup, $supercup, $seasonOb->getId(), $teamOb->getId());
            $em->getRepository(Player::class)
               ->updatePlayerTurnirs($player, $cup, $eurocup, $supercup);

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

    public function editFnl($id, $season, $team, $change)
    {
        $this->getDoctrine()->getRepository(Fnlplayer::class)->updateFnlplayer($id, $change);
        $entity = $this->getDoctrine()->getRepository(Fnlplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->getDoctrine()->getRepository(Rusplayer::class)
          ->updateRusplayerFnl($playerId, $change);
        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'fnl'
                    ]));
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
            $em->getRepository(Rusplayer::class)->updateRusplayerTotalFnl($player, $goal);
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
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);
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
}
