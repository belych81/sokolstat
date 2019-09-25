<?php

namespace App\Controller;

use App\Entity\Cup;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Shiptable;
use App\Entity\Playersteam;
use App\Entity\Stadia;
use App\Entity\Rfplmatch;
use App\Entity\Gamers;
use App\Entity\Cupplayer;
use App\Entity\Seasons;
use App\Form\CupType;
use App\Form\Cup2Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CupController extends AbstractController
{
  public function index($season)
  {
      $seasons = $this->getDoctrine()->getRepository(Cup::class)->getSeasons();
      $stadies = $this->getDoctrine()->getRepository(Stadia::class)->getStadiaCup($season);
      foreach ($stadies as $stadia)
      {
        $stadia->setStadiaMatches($this->getDoctrine()->getRepository(Cup::class)
                  ->findAllBySeasonAndStadia($season, $stadia));
      }

      return $this->render('cup/index.html.twig', [
          'seasons' => $seasons,
          'stadies' => $stadies
      ]);
  }

  public function show($id, $season)
  {
      $club = $this->getDoctrine()->getRepository(Team::class)
        ->findOneByTranslit($id);
      $isTeam = $this->getDoctrine()->getRepository(Cup::class)
              ->findByTeamAndSeason($club->getId(), $season);
      if(empty($isTeam)){
        return $this->redirect($this->generateUrl('cup', [
            'season' => $season]));
      }
      $seasons = $this->getDoctrine()->getRepository(Cup::class)->getSeasons();
      $players = $this->getDoctrine()->getRepository(Cupplayer::class)
        ->getCupTeamStat($season, $id);
      $teams = $this->getDoctrine()->getRepository(Cup::class)
        ->getTeams($season);
      $teams2 = $this->getDoctrine()->getRepository(Cup::class)
          ->getTeams($season, 2);
      for ($i=0, $cnt=count($players); $i < $cnt; $i++)
      {
          $name[$i] = $players[$i]->getPlayer()->getName();
          $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                           ->getStat($name[$i], $id, 'game')[0]->getGame();
          $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                           ->getStat($name[$i], $id, 'goal')[0]->getGoal();

          $players[$i]->setGameTeam($ptgame[$i]);
          $players[$i]->setGoalTeam($ptgoal[$i]);
      }
      return $this->render('cup/show.html.twig', [
          'seasons' => $seasons,
          'players' => $players,
          'teams' => $teams,
          'teams2' => $teams2,
          'club' => $club
          ]);
  }

  public function newMatch($season)
  {
        $entity = new Cup();

        $form   = $this->createForm(CupType::class, $entity, [
            'season' => $season
            ]);

      return $this->render('cup/newMatch.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
  }

  public function createMatch(Request $request, $season)
  {
      $ent = CupType::class;
      $entity  = new Cup();
      $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);

      $entity->setSeason($year);
      $entity->setStatus(1);

      $form = $this->createForm($ent, $entity, [
          'season' => $season
          ]);

      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $_SESSION['stadia'] = $entity->getStadia();
          $_SESSION['date'] = $entity->getData();
          $em->persist($entity);
          $em->flush();
          //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
      }

      return $this->render('cup/newMatch.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView(),
      ));
    }

    public function new($id)
    {
        $entity = $this->getDoctrine()->getRepository(Cup::class)->find($id);
        $form   = $this->createForm(Cup2Type::class, $entity);

        return $this->render('cup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Cup::class)->find($id);
        $form = $this->createForm(Cup2Type::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $season = $entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('cup', [
                'season' => $season]));
        }

        return $this->render('cup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
