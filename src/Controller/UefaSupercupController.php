<?php

namespace App\Controller;

use App\Entity\UefaSupercup;
use App\Entity\RusSupercup;
use App\Entity\Shiptable;
use App\Entity\NationSupercup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UefaSupercupController extends AbstractController
{
  public function index($country)
  {
    switch ($country) {
        case 'uefa' :
          $entities = $this->getDoctrine()->getRepository(UefaSupercup::class)
            ->getEntity();
            break;
        case 'russia' :
          $entities = $this->getDoctrine()->getRepository(RusSupercup::class)
            ->getEntity();
            break;
        case 'england';
        case 'spain';
        case 'italy';
        case 'germany';
        case 'france' :
            $strana = $this->getDoctrine()->getRepository(Shiptable::class)
              ->translateCountry($country)['country'];
            $entities = $this->getDoctrine()->getRepository(NationSupercup::class)
              ->getEntity($strana);
        }

        $rus_country = $this->getDoctrine()->getRepository(Shiptable::class)
                          ->translateCountry($country)['rusCountry'];

        return $this->render('uefasupercup/index.html.twig', [
            'rus_country' => $rus_country,
            'entities' => $entities,
        ]);
  }

    public function show($id, $country)
    {
        switch ($country)
        {
            case 'uefa' :
              $entity = $this->getDoctrine()->getRepository(UefaSupercup::class)
                ->find($id);
                $rus_country = 'УЕФА';
                break;
            case 'russia' :
              $entity = $this->getDoctrine()->getRepository(RusSupercup::class)
                ->find($id);
                $rus_country = 'России';
                break;
        }

        return $this->render('uefasupercup/show.html.twig', [
            'entity'      => $entity,
            'rus_country' => $rus_country
            ]);
    }
}
