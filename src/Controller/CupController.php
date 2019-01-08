<?php

namespace App\Controller;

use App\Entity\Cup;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Rusplayer;
use App\Entity\Playersteam;
use App\Entity\Stadia;
use App\Entity\Rfplmatch;
use App\Entity\Gamers;
use App\Entity\Shiptable;

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
}
