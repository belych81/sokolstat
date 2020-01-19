<?php

namespace App\Controller;

use App\Entity\UefaSupercup;
use App\Entity\RusSupercup;
use App\Entity\Shiptable;
use App\Entity\NationSupercup;
use App\Entity\Country;
use App\Form\SupercupType;
use App\Form\Supercup2Type;
use Symfony\Component\HttpFoundation\Request;
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

    public function newMatch($country)
    {
      switch ($country) {
          case 'uefa' :
          $entity = new UefaSupercup();
              break;
          case 'russia' :
          $entity = new RusSupercup();
              break;
          case 'england';
          case 'spain';
          case 'italy';
          case 'germany';
          case 'france' :
          $entity = new NationSupercup();
      }

        $form   = $this->createForm(SupercupType::class, $entity, [
              'country' => $country
              ]);

        return $this->render('uefasupercup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, $country)
    {
        $ent = SupercupType::class;
        switch ($country) {
            case 'uefa' :
              $entity = new UefaSupercup();
                break;
            case 'russia' :
              $entity = new RusSupercup();
                break;
            case 'england';
            case 'spain';
            case 'italy';
            case 'germany';
            case 'france' :
              $entity = new NationSupercup();
        }
        $entity->setStatus(1);
        $stranaOb = $this->getDoctrine()->getRepository(Country::class)
          ->findOneByTranslit($country);
        $entity->setCountry($stranaOb);

        $form = $this->createForm($ent, $entity, [
            'country' => $country
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_SESSION['date'] = $entity->getData();
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        return $this->render('uefasupercup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function new($id, $country)
    {
      switch ($country) {
          case 'uefa' :
            $ent = UefaSupercup::class;
              break;
          case 'russia' :
            $ent = RusSupercup::class;
              break;
          case 'england';
          case 'spain';
          case 'italy';
          case 'germany';
          case 'france' :
            $ent = NationSupercup::class;
      }
        $entity = $this->getDoctrine()->getRepository($ent)->find($id);
        $form   = $this->createForm(Supercup2Type::class, $entity);

        return $this->render('uefasupercup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id, $country)
    {
      switch ($country) {
          case 'uefa' :
            $ent = UefaSupercup::class;
              break;
          case 'russia' :
            $ent = RusSupercup::class;
              break;
          case 'england';
          case 'spain';
          case 'italy';
          case 'germany';
          case 'france' :
            $ent = NationSupercup::class;
      }
        $entity = $this->getDoctrine()->getRepository($ent)->find($id);
        $form = $this->createForm(Supercup2Type::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
