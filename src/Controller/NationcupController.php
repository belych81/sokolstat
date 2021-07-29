<?php

namespace App\Controller;

use App\Entity\Shiptable;
use App\Entity\NationCup;
use App\Entity\Stadia;
use App\Entity\Country;
use App\Entity\Seasons;
use App\Form\NationCupType;
use App\Form\NationCup2Type;
use App\Service\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NationcupController extends AbstractController
{
    public function index(Menu $serviceMenu, $country, $season)
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
        $menu = $serviceMenu->generate($country, $season);

        return $this->render('nationcup/index.html.twig', [
            'rusCountry' => $rusCountry,
            'seasons' => $seasons,
            'stadies' => $stadies,
            'menu' => $menu
        ]);
    }

    public function newMatch(Menu $serviceMenu, $season, $country)
    {
        $entity = new NationCup();

        $form   = $this->createForm(NationCupType::class, $entity, [
              'season' => $season,
              'country' => $country
              ]);

        $menu = $serviceMenu->generate($country, $season);

        return $this->render('nationcup/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, $season, $country)
    {
        $ent = NationCupType::class;
        $entity  = new NationCup();
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);
        $stranaOb = $this->getDoctrine()->getRepository(Country::class)
          ->findOneByTranslit($country);
        $entity->setCountry($stranaOb);

        $form = $this->createForm($ent, $entity, [
            'season' => $season,
            'country' => $country
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

        return $this->render('nationcup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function new($id, $country)
    {
        $entity = $this->getDoctrine()->getRepository(NationCup::class)->find($id);
        $form   = $this->createForm(NationCup2Type::class, $entity);

        return $this->render('nationcup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id, $country)
    {
        $entity = $this->getDoctrine()->getRepository(NationCup::class)->find($id);
        $form = $this->createForm(NationCup2Type::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $season = $entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('nationcup', [
                'season' => $season, 'country' => $country]));
        }

        return $this->render('nationcup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
