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
use App\Entity\MundialTable;
use App\Entity\Seasons;
use App\Form\MundialType;
use App\Form\Mundial2Type;
use App\Form\MundialUpdateType;
use App\Form\MundialtableType;
use App\Service\Menu;
use App\Service\Props;
use App\Service\ResizeImage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MundialController extends AbstractController
{
    public function index(Menu $serviceMenu, $turnir, $year)
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
            $raund->setStadiaTable($this->getDoctrine()->getRepository(MundialTable::class)
              ->getTable($turnir, $year, $raund->getAlias()));
        }
        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/index.html.twig', [
            'seasons' => $seasons,
            'champ' => $champ,
            'raunds' => $raunds,
            'menu' => $menu
            ]);
    }

    public function show(Menu $serviceMenu, $id, $turnir, $year)
    {
        $entity = $this->getDoctrine()->getRepository(Mundial::class)->find($id);
        $seasons = $this->getDoctrine()->getRepository(Mundial::class)
          ->getSeasonsByTurnir($turnir);
        $champ = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $countries = $this->getDoctrine()->getRepository(MundialTable::class)
          ->getCountriesBySeason($year, $turnir);
        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/show.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'champ' => $champ,
            'menu' => $menu,
            'countries' => $countries
            ]);
    }

    public function showCountry(Menu $serviceMenu, ResizeImage $resize, $turnir, $year, $country)
    {
        $entity = $this->getDoctrine()->getRepository(Sostav::class)
          ->getSbPlayersByCountry($year, $country);
        $sborn = $this->getDoctrine()->getRepository(Country::class)
          ->findOneByTranslit($country);
        $champ = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $countries = $this->getDoctrine()->getRepository(MundialTable::class)
          ->getCountriesBySeason($year, $turnir);
        foreach($countries as &$country){
          if($country['image']){
            $country['image'] = $resize->ResizeImageGet($country['image'], ['width' => 70, 'height' => 70]);
          }
        }
        $seasons = $this->getDoctrine()->getRepository(Mundial::class)
          ->getSeasonsByTurnir($turnir);
        $menu = $serviceMenu->generateMundial();

        $sbornImage = false;
        if($sbornBaseImage = $sborn->getImage()){
          $sbornImage = $resize->ResizeImageGet($sbornBaseImage, ['width' => 270, 'height' => 270]);
        }
        return $this->render('mundial/showCountry.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'champ' => $champ,
            'sborn' => $sborn,
            'menu' => $menu,
            'countries' => $countries,
            'sbornImage' => $sbornImage
          ]);
    }

    public function showRus(Props $lastYear, Menu $serviceMenu, $season)
    {
        $entity = $this->getDoctrine()->getRepository(Sbplayer::class)
          ->getSbPlayersBySeason($season);
        $seasons = range(1992, $lastYear->getSbornieRusYear());
        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/showRus.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'menu' => $menu,
            'games' => null,
            'goals' => null
            ]);
    }

    public function newSeason(Menu $serviceMenu, SessionInterface $session, $turnir, $season)
    {
        $entity = new MundialTable();

        $form   = $this->createForm(MundialtableType::class, $entity, [
            'turnir' => $turnir,
            'season' => $season,
            'stadia' => $session->get('stadia')
            ]);

        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/newSeason.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function createSeason(SessionInterface $session, Request $request,
      $turnir, $season)
    {
        $ent = MundialtableType::class;
        $entity  = new MundialTable();
        $obTurnir = $this->getDoctrine()->getRepository(Turnir::class)
            ->findOneByAlias($turnir);
        $entity->setYear($season);
        $entity->setTurnir($obTurnir);

        $form = $this->createForm($ent, $entity, [
          'turnir' => $turnir,
          'season' => $season
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session->set('stadia', $entity->getStadia()->getName());
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        return $this->render('mundial/newSeason.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newMatch(Menu $serviceMenu, $season, $turnir)
    {
        $entity = new Mundial();

        $form   = $this->createForm(MundialType::class, $entity, [
            'season' => $season
            ]);

        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Menu $serviceMenu, Request $request, $season, $turnir)
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
        $menu = $serviceMenu->generateMundial();

        return $this->render('mundial/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function edit($id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Mundial::class)->find($id);

        $editForm = $this->createForm(MundialUpdateType::class, $entity);

        return $this->render('mundial/updateMundial.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function update(Request $request, $id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Mundial::class)->find($id);

        $editForm = $this->createForm(MundialUpdateType::class, $entity);
        $entity->setStatus(0);
        $editForm->handleRequest($request);

        if ($editForm->isValid() && $editForm->isSubmitted()) {
            $em->persist($entity);
            $em->flush();
            $country = $entity->getCountry()->getId();
            $country2 = $entity->getCountry2()->getId();
            $score = $entity->getScore();
            $season = $entity->getSeason()->getName();
            $stadia = $entity->getStadia()->getAlias();
            if(strpos($stadia, 'group') !== false)
            {
              $em->getRepository(MundialTable::class)->updateTable($country, $country2, $score, $season);
            }
            return $this->redirect($this->generateUrl('sbornie', ['turnir' => $turnir, 'year' => $season]));

        }

        return $this->render('mundial/updateMundial.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function editMatch($id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Mundial::class)->find($id);

        $editForm = $this->createForm(Mundial2Type::class, $entity);

        return $this->render('mundial/editMundial.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function updateMatch(Request $request, $id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Mundial::class)->find($id);

        $editForm = $this->createForm(Mundial2Type::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $season=$entity->getSeason()->getName();

            return $this->redirect($this->generateUrl('sbornie', [
              'turnir' => $turnir,
              'year' => $season
            ]));

        }

        return $this->render('mundial/editMundial.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function editMundialTable($id, $season, $turnir)
    {
        $entity = $this->getDoctrine()->getRepository(Mundial::class)->find($id);
        $form   = $this->createForm(EctableEditType::class, $entity);

        return $this->render('mundial/editEctable.html.twig', array(
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        ));
    }

    public function updateMundialTable(Request $request, $id, $season, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Mundial::class)->find($id);

        $editForm = $this->createForm(EctableEditType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('eurocup', [
              'turnir' => $turnir, 'season' => $season,
                'stadia' => $stadia]));
        }

        return $this->render('mundial/editEctable.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }
}
