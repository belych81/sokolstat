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
      $teams = $this->getDoctrine()->getRepository(Shiptable::class)
        ->getTeams($season, 'Россия');

      return $this->render('cup/index.html.twig', [
          'seasons' => $seasons,
          'stadies' => $stadies,
          'teams' => $teams
      ]);
  }

  public function show($id, $season)
  {
        $players = $this->getDoctrine()->getRepository(Cupplayer::class)
          ->getCupTeamStat($season, $id);
        $teams = $this->getDoctrine()->getRepository(Shiptable::class)
          ->getTeams($season, 'Россия');
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findByTranslit($id);
        for ($i=0, $cnt=count($players); $i < $cnt; $i++) {
                $name[$i] = $players[$i]->getPlayer()->getName();
                $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'game')[0]->getGame();
                $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'goal')[0]->getGoal();

                $players[$i]->setGameTeam($ptgame[$i]);
                $players[$i]->setGoalTeam($ptgoal[$i]);
            }
        return $this->render('cup/show.html.twig', [
            'players' => $players,
            'teams' => $teams,
            'club' => $club
            ]);

  }
}
