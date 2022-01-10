<?php

namespace App\Controller;

use App\Entity\Shiptable;
use App\Entity\NationCup;
use App\Entity\Stadia;
use App\Entity\Country;
use App\Entity\Seasons;
use App\Entity\Game;
use App\Entity\Turnir;
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
        $seasons = $this->getDoctrine()->getRepository(Game::class)
          ->getSeasons($country."-cup");
        $stadies = $this->getDoctrine()->getRepository(Stadia::class)
          ->getStadiaNationCup($season, $country);
        foreach ($stadies as $stadia)
        {
          $stadia->setStadiaMatches($this->getDoctrine()->getRepository(Game::class)
                    ->findAllBySeasonAndStadiaAndCountry($season, $stadia, $country));
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
        $entity = new Game();

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

    public function createMatch(Menu $serviceMenu, Request $request, $season, $country)
    {
        $ent = NationCupType::class;
        $entity  = new Game();
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $turnir = $country."-cup";
        $obTurnir = $this->getDoctrine()->getRepository(Turnir::class)->findOneByAlias($turnir);
        $entity->setSeason($year);
        $entity->setTurnir($obTurnir);
        $entity->setStatus(1);

        $form = $this->createForm($ent, $entity, [
            'season' => $season,
            'country' => $country
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }
        $menu = $serviceMenu->generate($country, $season);

        return $this->render('nationcup/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function new(Menu $serviceMenu, $id, $country)
    {
        $entity = $this->getDoctrine()->getRepository(Game::class)->find($id);
        $form   = $this->createForm(NationCup2Type::class, $entity);
        $menu = $serviceMenu->generate($country);

        return $this->render('nationcup/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function create(Menu $serviceMenu, Request $request, $id, $country)
    {
        $entity = $this->getDoctrine()->getRepository(Game::class)->find($id);
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

        $menu = $serviceMenu->generate($country);

        return $this->render('nationcup/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }
}
