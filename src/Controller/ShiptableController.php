<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Rusplayer;
use App\Entity\Playersteam;
use App\Entity\Fnlplayer;
use App\Entity\Rfplmatch;
use App\Entity\Gamers;
use App\Entity\Shiptable;
use App\Entity\UefaSupercup;
use App\Entity\NationCup;
use App\Entity\Shipplayer;
use App\Entity\RusSupercup;
use App\Entity\Seasons;
use App\Entity\Country;
use App\Form\RfplmatchType;
use App\Form\Rfplmatch2Type;
use App\Form\TourMatchType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShiptableController extends AbstractController
{
    public function index($country, $season, $tour)
    {
        $strana = $this->getDoctrine()->getRepository(Shiptable::class)
                ->translateCountry($country)['country'];
        $entities = $this->getDoctrine()->getRepository(Shiptable::class)
                ->getTable($strana, $season);
        $seasons = $this->getDoctrine()->getRepository(Shiptable::class)
                ->getSeasons($strana);
        $lastSeason = $this->getDoctrine()->getRepository(Tour::class)
                ->getLastSeason($strana);

        if ($country == 'russia') {

            $arMaxTour = $this->getDoctrine()->getRepository(Rfplmatch::class)
                ->getMaxTour($season);
            if(empty($arMaxTour)){
                $maxTour = 1;
            } else {
                $maxTour = $arMaxTour[0]['tour'];
            }
            if(!$tour) {
                $matches = $this->getDoctrine()->getRepository(Rfplmatch::class)
                              ->getRusMatches($season, $maxTour);
            } else {
                $matches = $this->getDoctrine()->getRepository(Rfplmatch::class)
                              ->getRusMatches($season, $tour);
            }
           $numberTour = $this->getDoctrine()->getRepository(Rfplmatch::class)
                ->getTours($season);
        } else {
            $maxTour = $this->getDoctrine()->getRepository(Tour::class)
                             ->getMaxTour($strana, $season);
            if(!$tour) {
               $matches = $this->getDoctrine()->getRepository(Tour::class)
                          ->getMatches($strana, $season, $maxTour);
           } else {
               $matches = $this->getDoctrine()->getRepository(Tour::class)
                              ->getMatches($strana, $season, $tour);
           }
            $numberTour = $this->getDoctrine()->getRepository(Tour::class)
                             ->getTours($strana, $season);
        }

        $rusCountry = $this->getDoctrine()->getRepository(Shiptable::class)
                ->translateCountry($country)['rusCountry'];
        switch ($country) {
            case 'russia' :
              $bombs = $this->getDoctrine()->getRepository(Gamers::class)
                    ->getBomb($season);
                    break;
            case 'england' :
            case 'spain' :
            case 'italy' :
            case 'germany' :
            case 'france' :
                $bombs = $this->getDoctrine()->getRepository(Shipplayer::class)
                    ->getBomb5($season, $strana);
                    break;
            case 'fnl' :
                $bombs = $this->getDoctrine()->getRepository(Fnlplayer::class)
                    ->getBomb5($season, $strana);

        }

        return $this->render('shiptable/index.html.twig', [
            'entities' => $entities,
            'seasons' => $seasons,
            'bombs' => $bombs,
            'matches' => $matches,
            'tours' => $numberTour,
            'rusCountry' => $rusCountry,
            'lastSeason' => $lastSeason,
            'maxTour' => $maxTour
        ]);
    }

    public function show($id, $season, $country)
    {
        $strana = $this->getDoctrine()->getRepository(Shiptable::class)
                ->translateCountry($country)['country'];
        $seasons = $this->getDoctrine()->getRepository(Shiptable::class)
                ->getSeasons($strana);
        if ($country == 'russia') {
            $players = $this->getDoctrine()->getRepository(Gamers::class)
              ->getRusTeamStat($season, $id);

            for ($i=0, $cnt=count($players); $i < $cnt; $i++) {
                $name[$i] = $players[$i]->getPlayer()->getName();
                $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'game')[0]->getGame();
                $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'goal')[0]->getGoal();

                $players[$i]->setGameTeam($ptgame[$i]);
                $players[$i]->setGoalTeam($ptgoal[$i]);
            }
        } elseif ($country == 'fnl') {
            $players = $this->getDoctrine()->getRepository(Fnlplayer::class)
                          ->getTeamStat($season, $id);

        } else {
            $players = $this->getDoctrine()->getRepository(Shipplayer::class)
                          ->getTeamStat($season, $id);

        }

        $strana = $this->getDoctrine()->getRepository(Shiptable::class)
                     ->translateCountry($country)['country'];
        $teams = $this->getDoctrine()->getRepository(Shiptable::class)
          ->getTeams($season, $strana);
        $club = $this->getDoctrine()->getRepository(Team::class)->findByTranslit($id);


        if ($country == 'russia') {
           return $this->render('shiptable/showRus.html.twig', [
            'players'      => $players,
            'seasons' => $seasons,
            'teams' => $teams,
            'club' => $club,
            ]);
        } elseif ($country == 'fnl') {
           return $this->render('shiptable/showFnl.html.twig', [
            'players'      => $players,
            'seasons' => $seasons,
            'teams' => $teams,
            'club' => $club,
            ]);
        } else {
        return $this->render('shiptable/show.html.twig', [
            'players'      => $players,
            'seasons' => $seasons,
            'teams' => $teams,
            'club' => $club
            ]);
        }
    }

    public function newMatch($country, $season)
    {
        if($country == 'russia') {
          $entity = new Rfplmatch();

          $form   = $this->createForm(RfplmatchType::class, $entity, [
              'country' => $country,
              'season' => $season
              ]);
        } else {
          $entity = new Tour();

          $form   = $this->createForm(TourMatchType::class, $entity, [
              'country' => $country,
              'season' => $season
              ]);
        }

        return $this->render('shiptable/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, $country, $season)
    {
        switch ($country) {
            case 'russia' : $country2 = 'Россия'; break;
            case 'england' : $country2 = 'Англия';  break;
            case 'spain' : $country2 = 'Испания'; break;
            case 'italy' : $country2 = 'Италия'; break;
            case 'germany' : $country2 = 'Германия'; break;
            case 'france' : $country2 = 'Франция'; break;
            case 'fnl' : $country2 = 'ФНЛ'; break;
        }
        if($country == 'russia') {
            $ent = RfplmatchType::class;
            $entity  = new Rfplmatch();
        } else {
            $ent = TourMatchType::class;
            $entity  = new Tour();
            $strana = $this->getDoctrine()->getRepository(Country::class)
              ->findOneByName($country2);
            $entity->setCountry($strana);
        }
        $year = $this->getDoctrine()->getRepository(Seasons::class)->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);

        $form = $this->createForm($ent, $entity, [
            'country' => $country,
            'season' => $season
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_SESSION['tour'] = $entity->getTour();
            $_SESSION['date'] = $entity->getData();
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        return $this->render('shiptable/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function newRus($id)
    {
        $entity = $this->getDoctrine()->getRepository(Rfplmatch::class)->find($id);
        $form   = $this->createForm(Rfplmatch2Type::class, $entity);

        return $this->render('shiptable/newRus.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createRus(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Rfplmatch::class)->find($id);
        $form = $this->createForm(Rfplmatch2Type::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $team=$entity->getTeam()->getId();
            $team2=$entity->getTeam2()->getId();
            $seas=$entity->getSeason()->getId();
            $goal1=$entity->getGoal1();
            $goal2=$entity->getGoal2();
            $this->getDoctrine()->getRepository(Shiptable::class)
               ->updateShiptable($team, $team2, $goal1, $goal2, $seas);
            $season = $entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('championships', [
                'season' => $season, 'country' => 'russia']));
        }

        return $this->render('shiptable/newRus.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function new($id)
    {
        $entity = $this->getDoctrine()->getRepository(Tour::class)->find($id);
        $form   = $this->createForm(TourType::class, $entity);

        return $this->render('shiptable/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Tour::class)->find($id);
        $form = $this->createForm(TourType::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $team=$entity->getTeam()->getId();
            $team2=$entity->getTeam2()->getId();
            $seas=$entity->getSeason()->getId();
            $country=$entity->getCountry()->getName();
            switch ($country) {
            case 'Россия' : $country2 = 'russia'; break;
            case 'Англия' : $country2 = 'england';  break;
            case 'Испания' : $country2 = 'spain'; break;
            case 'Италия' : $country2 = 'italy'; break;
            case 'Германия' : $country2 = 'germany'; break;
            case 'Франция' : $country2 = 'france'; break;
            case 'ФНЛ' : $country2 = 'fnl'; break;
        }
            $goal1=$entity->getGoal1();
            $goal2=$entity->getGoal2();

            $this->getDoctrine()->getRepository(Shiptable::class)
               ->updateShiptable($team, $team2, $goal1, $goal2, $seas);
            $season=$entity->getSeason()->getName();
            return $this->redirect($this->generateUrl('championships', [
                'season' => $season, 'country' => $country2]));
        }

        return $this->render('shiptable/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

}
