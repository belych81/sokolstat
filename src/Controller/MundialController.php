<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Country;
use App\Entity\Sbplayer;
use App\Entity\Sostav;
use App\Entity\Stadia;
use App\Entity\Turnir;
use App\Entity\Mundial;
use App\Entity\Seasons;
use App\Form\MundialType;

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

    public function newMatch($season, $turnir)
    {
        $entity = new Mundial();

        $form   = $this->createForm(MundialType::class, $entity, [
            'season' => $season
            ]);

        return $this->render('mundial/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, $season, $turnir)
    {
        $em = $this->getDoctrine()->getManager();
        $entity  = new Mundial();

        $year = $em->getRepository(Seasons::class)->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);

        $form = $this->createForm(MundialType::class, $entity, [
            'season' => $season
            ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $_SESSION['stadia'] = $entity->getStadia();
            $_SESSION['data'] = $entity->getData();
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        return $this->render('mundial/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
