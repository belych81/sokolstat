<?php

namespace App\Controller;

use App\Entity\UefaSupercup;
use App\Entity\RusSupercup;
use App\Entity\Shiptable;
use App\Entity\NationSupercup;
use App\Entity\Country;
use App\Entity\Game;
use App\Entity\Turnir;
use App\Form\SupercupType;
use App\Form\Supercup2Type;
use App\Service\Menu;
use App\Service\Props;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class UefaSupercupController extends AbstractController
{
  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
      $this->entityManager = $entityManager;
  }
  
  public function index(Menu $serviceMenu, Props $props, $country)
  {
    $entities = $this->entityManager->getRepository(Game::class)
      ->getNationSupercup($country);
    switch ($country) {
        case 'uefa' :
          $menu = $serviceMenu->generateEurocup();
            break;
        case 'russia' :
        case 'england';
        case 'spain';
        case 'italy';
        case 'germany';
        case 'france' :
            $menu = $serviceMenu->generate($country);
        }

        $rus_country = $this->entityManager->getRepository(Shiptable::class)
                          ->translateCountry($country, $props)['rusCountry'];

        return $this->render('uefasupercup/index.html.twig', [
            'rus_country' => $rus_country,
            'entities' => $entities,
            'menu' => $menu
        ]);
  }

    public function show(Menu $serviceMenu, $id, $country)
    {
      $entity = $this->entityManager->getRepository(Game::class)->find($id);

        switch ($country)
        {
            case 'uefa' :
                $rus_country = 'УЕФА';
                $menu = $serviceMenu->generateEurocup();
                break;
            case 'russia' :

                $rus_country = 'России';
                $menu = $serviceMenu->generate($country);
                break;
        }


        return $this->render('uefasupercup/show.html.twig', [
            'entity'      => $entity,
            'rus_country' => $rus_country,
            'menu' => $menu
            ]);
    }

    public function newMatch(Menu $serviceMenu, $country)
    {
      $entity = new Game();

      switch ($country) {
          case 'uefa' :
          $menu = $serviceMenu->generateEurocup();
              break;
          case 'russia' :
          case 'england';
          case 'spain';
          case 'italy';
          case 'germany';
          case 'france' :
          $menu = $serviceMenu->generate($country);
      }

        $form   = $this->createForm(SupercupType::class, $entity, [
              'country' => $country
              ]);

        return $this->render('uefasupercup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'menu' => $menu
        ));
    }

    public function createMatch(Request $request, Menu $serviceMenu, $country)
    {
        $entity = new Game();
        $ent = SupercupType::class;

        switch ($country) {
            case 'uefa' :
              $menu = $serviceMenu->generateEurocup();
              $turnir = 'supercup';
                break;
            case 'russia' :
            case 'england';
            case 'spain';
            case 'italy';
            case 'germany';
            case 'france' :
              $menu = $serviceMenu->generate($country);
              $turnir = $country."-supercup";
        }
        $entity->setStatus(1);
        $obTurnir = $this->entityManager->getRepository(Turnir::class)
          ->findOneByAlias($turnir);

        $entity->setTurnir($obTurnir);

        $form = $this->createForm($ent, $entity, [
            'country' => $country
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }


        return $this->render('uefasupercup/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function new(Menu $serviceMenu, $id, $country)
    {
      $ent = Game::class;

        switch ($country) {
            case 'uefa' :
              $menu = $serviceMenu->generateEurocup();
                break;
            case 'russia' :
            case 'england';
            case 'spain';
            case 'italy';
            case 'germany';
            case 'france' :

              $menu = $serviceMenu->generate($country);
        }
        $entity = $this->entityManager->getRepository($ent)->find($id);

        $form = $this->createForm(Supercup2Type::class, $entity, [
              'country' => $country
              ]);


        return $this->render('uefasupercup/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id, $country)
    {
      $ent = Game::class;
      switch ($country) {
          case 'uefa' :
            $turnir = 'supercup';
              break;
          case 'russia' :
          case 'england';
          case 'spain';
          case 'italy';
          case 'germany';
          case 'france' :
            $turnir = $country."-supercup";
      }
        $entity = $this->entityManager->getRepository($ent)->find($id);
        $form = $this->createForm(Supercup2Type::class, $entity, [
              'country' => $country
              ]);
        $entity->setStatus(0);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $season = $entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('supercup', [
                'country' => $country]));
        }

        return $this->render('uefasupercup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
