<?php

namespace App\Controller;

use App\Entity\Eurocup;
use App\Entity\Turnir;
use App\Entity\Stadia;
use App\Entity\Ectable;
use App\Entity\Team;
use App\Entity\Lchplayer;
use App\Entity\Ecsostav;
use App\Entity\Ecplayer;
use App\Entity\Playersteam;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EurocupController extends AbstractController
{
    public function index($turnir, $season, $stadia = null)
    {
        $laststadia2 = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getLastStadia($turnir, $season);
        if (!$stadia) {
            $stadia = $laststadia2[0]['alias'];
        }
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir($turnir);

        $count=count($seasons);
        for ($i=0; $i < $count; $i++) {
          $laststadia[$i] = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getLastStadia($turnir, $seasons[$i]->getSeason()->getName());

            $seasons[$i]->getSeason()->setLaststadia($laststadia[$i][0]['alias']);
        }
        $entities = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getEntityByTurnir($turnir, $season, $stadia);
        $raunds = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getStadiaByTurnir($turnir, $season);
        $rus_stadia = $this->getDoctrine()->getRepository(Stadia::class)
          ->findOneByAlias($stadia);
        $rus_turnir = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $ectables = FALSE;
        if (strpos($stadia, 'group') !== FALSE) {
            $ectables = $this->getDoctrine()->getRepository(Ectable::class)
              ->getEcTable($turnir, $season, $stadia);
        }
        $teams = $this->getDoctrine()->getRepository(Ectable::class)
          ->getLchTeams($season);

        return $this->render('eurocup/index.html.twig', [
            'seasons' => $seasons,
            'entities' => $entities,
            'rus_stadia' => $rus_stadia,
            'rus_turnir' => $rus_turnir,
            'raunds' => $raunds,
            'teams' => $teams,
            'ectables' => $ectables,
            'laststadia' => $laststadia2
          ]);
    }

    public function show($id, $season)
    {
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir('leagueChampions');
        $entity = $this->getDoctrine()->getRepository(Eurocup::class)
          ->find($id);
        $bombs = $this->getDoctrine()->getRepository(Lchplayer::class)
          ->getBomb($season);
        $teams = $this->getDoctrine()->getRepository(Ectable::class)
          ->getLchTeams($season);
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findByTranslit($id);
        $players = $this->getDoctrine()->getRepository(Lchplayer::class)
          ->getLchTeamStat($season, $id);


        return $this->render('eurocup/show.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'bombs' => $bombs,
            'teams' => $teams,
            'club' => $club,
            'players' => $players,
            ]);
    }

    public function showMatch($id, $turnir)
    {
        $entity = $this->getDoctrine()->getRepository(Ecsostav::class)
          ->findOneByEurocup($id);
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir($turnir);
        $stadia = $this->getDoctrine()->getRepository(Eurocup::class)
          ->findOneById($id);

        return $this->render('eurocup/showMatch.html.twig', [
            'entity'  => $entity,
            'seasons' => $seasons,
            'stadia' => $stadia
            ]);
    }

    public function showTeam($id, $season)
    {
        $entity = $this->getDoctrine()->getRepository(Ecplayer::class)
          ->findEcPlayersByTeam($id, $season);
        $team = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($id);
            for ($i=0, $cnt=count($entity); $i < $cnt; $i++) {
                $name[$i] = $entity[$i]->getPlayer()->getName();
                $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'game')[0]->getGame();
                $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'goal')[0]->getGoal();

                $entity[$i]->setGameTeam($ptgame[$i]);
                $entity[$i]->setGoalTeam($ptgoal[$i]);
            }
        return $this->render('eurocup/showTeam.html.twig', [
            'entity' => $entity,
            'team' => $team
            ]);
    }

}
