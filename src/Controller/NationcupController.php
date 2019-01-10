<?php

namespace App\Controller;

use App\Entity\Shiptable;
use App\Entity\NationCup;
use App\Entity\Stadia;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NationcupController extends AbstractController
{
    public function index($country, $season)
    {
        $rusCountry = $this->getDoctrine()->getRepository(Shiptable::class)
                        ->translateCountry($country)['rusCountry'];
        $strana = $this->getDoctrine()->getRepository(Shiptable::class)
                        ->translateCountry($country)['country'];
        $seasons = $this->getDoctrine()->getRepository(NationCup::class)
          ->getSeasons();
        $stadies = $this->getDoctrine()->getRepository(Stadia::class)
          ->getStadiaNationCup($season, $strana);
        foreach ($stadies as $stadia)
        {
          $stadia->setStadiaMatches($this->getDoctrine()->getRepository(NationCup::class)
                    ->findAllBySeasonAndStadiaAndCountry($season, $stadia, $strana));
        }

        return $this->render('nationcup/index.html.twig', [
            'rusCountry' => $rusCountry,
            'seasons' => $seasons,
            'stadies' => $stadies
        ]);
    }
}
