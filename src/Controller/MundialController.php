<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

//use App\Entity\Rusplayer;
//use App\Entity\Team;
//use App\Entity\Playersteam;
//use App\Entity\Shiptable;
//use App\Entity\Country;
//use App\Entity\Player;
//use App\Entity\Lchplayer;
//use App\Entity\Gamers;
//use App\Entity\Fnlplayer;
//use App\Entity\Shipplayer;
//use App\Entity\Cupplayer;
//use App\Entity\Ecplayer;
//use App\Entity\Supercupplayer;
//use App\Entity\Sbplayer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MundialController extends AbstractController
{
  public function index($turnir, $year)
    {
        $seasons = $em->getRepository('SteamFbstatBundle:Mundial')->getSeasonsByTurnir($turnir);
        $champ = $em->getRepository('SteamFbstatBundle:Turnir')->findOneByAlias($turnir);
        $raunds = $em->getRepository('SteamFbstatBundle:Stadia')->getStadiaMundial($turnir, $year);

        foreach ($raunds as $raund) {
            $raund->setStadiaMatches($em->getRepository('SteamFbstatBundle:Mundial')->getEntityByTurnir($turnir, $year, $raund->getId()));
        }

        return $this->render('SteamFbstatBundle:Mundial:index.html.twig', [
            'seasons' => $seasons,
            'champ' => $champ,
            'raunds' => $raunds
            ]);
    }
}
