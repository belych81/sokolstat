<?php

namespace App\Controller;

use App\Entity\Shiptable;
use App\Entity\CupLeague;
use App\Entity\Stadia;
use App\Entity\Seasons;
use App\Form\CupLeagueType;
use App\Form\NationCup2Type;
use App\Service\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CupLeagueController extends AbstractController
{
    public function index(Menu $serviceMenu, $season)
    {
        $seasons = $this->getDoctrine()->getRepository(CupLeague::class)
          ->getSeasons();
        $stadies = $this->getDoctrine()->getRepository(Stadia::class)
          ->getStadiaCupLeague($season);
        foreach ($stadies as $stadia)
        {
          $stadia->setStadiaMatches($this->getDoctrine()->getRepository(CupLeague::class)
                    ->findAllBySeasonAndStadia($season, $stadia));
        }
        $menu = $serviceMenu->generate('england', $season);

        return $this->render('cupleague/index.html.twig', [
            'rusCountry' => 'английской лиги',
            'seasons' => $seasons,
            'stadies' => $stadies,
            'menu' => $menu
        ]);
    }

    public function newMatch(Menu $serviceMenu, $season)
    {
        $entity = new CupLeague();

        $form   = $this->createForm(CupLeagueType::class, $entity, [
              'season' => $season
              ]);

        $menu = $serviceMenu->generate('england', $season);

        return $this->render('cupleague/newMatch.html.twig', [
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ]);
    }

    public function createMatch(Menu $serviceMenu, Request $request, $season)
    {
        $ent = CupLeagueType::class;
        $entity  = new CupLeague();
        $year = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);

        $form = $this->createForm($ent, $entity, [
            'season' => $season
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        $menu = $serviceMenu->generate('england', $season);

        return $this->render('cupleague/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function new(Menu $serviceMenu, $id)
    {
        $entity = $this->getDoctrine()->getRepository(CupLeague::class)->find($id);
        $form   = $this->createForm(NationCup2Type::class, $entity);

        $menu = $serviceMenu->generate('england');

        return $this->render('cupleague/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(CupLeague::class)->find($id);
        $form = $this->createForm(NationCup2Type::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $season = $entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('cup_league', [
                'season' => $season]));
        }

        return $this->render('cupleague/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}