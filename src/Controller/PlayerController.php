<?php

namespace App\Controller;

use App\Entity\Gamers;
use App\Entity\Team;
use App\Entity\Rusplayer;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Form\RusType;

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
}
