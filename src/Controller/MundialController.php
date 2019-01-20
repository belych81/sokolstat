<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

//use App\Entity\Rusplayer;
//use App\Entity\Team;
//use App\Entity\Playersteam;
//use App\Entity\Shiptable;
use App\Entity\Country;
//use App\Entity\Player;
use App\Entity\Sbplayer;
//use App\Entity\Gamers;
//use App\Entity\Fnlplayer;
//use App\Entity\Shipplayer;
use App\Entity\Sostav;
use App\Entity\Stadia;
use App\Entity\Turnir;
use App\Entity\Mundial;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MundialController extends AbstractController
{
    public function index($turnir, $year)
    {
        $seasons = $this->getDoctrine()->getRepository(Mundial::class)
          ->getSeasonsByTurnir($turnir);
        $champ = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $raunds = $this->getDoctrine()->getRepository(Stadia::class)
          ->getStadiaMundial($turnir, $year);

        foreach ($raunds as $raund) {
            $raund->setStadiaMatches($this->getDoctrine()->getRepository(Mundial::class)
              ->getEntityByTurnir($turnir, $year, $raund->getId()));
        }

        return $this->render('mundial/index.html.twig', [
            'seasons' => $seasons,
            'champ' => $champ,
            'raunds' => $raunds
            ]);
    }

    public function show($id, $turnir, $year)
    {
        $entity = $this->getDoctrine()->getRepository(Mundial::class)->find($id);
        $seasons = $this->getDoctrine()->getRepository(Mundial::class)
          ->getSeasonsByTurnir($turnir);
        $champ = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $countries = $this->getDoctrine()->getRepository(Mundial::class)
          ->getCountriesBySeason($year);

        return $this->render('mundial/show.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'champ' => $champ,
            'countries' => $countries
            ]);
    }

    public function showCountry($turnir, $year, $country)
    {
        $entity = $this->getDoctrine()->getRepository(Sostav::class)
          ->getSbPlayersByCountry($year, $country);
        $sborn = $this->getDoctrine()->getRepository(Country::class)
          ->findOneByTranslit($country);
        $champ = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $countries = $this->getDoctrine()->getRepository(Mundial::class)
          ->getCountriesBySeason($year);

        return $this->render('mundial/showCountry.html.twig', [
            'entity'      => $entity,
            'seasons' => $year,
            'champ' => $champ,
            'sborn' => $sborn,
            'countries' => $countries
            ]);
    }

    public function showRus($season)
    {
        $entity = $this->getDoctrine()->getRepository(Sbplayer::class)
          ->getSbPlayersBySeason($season);
        $seasons = range(1992, 2018);

        return $this->render('mundial/showRus.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'games' => null,
            'goals' => null
            ]);
    }
}
