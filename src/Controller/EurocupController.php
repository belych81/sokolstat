<?php

namespace App\Controller;

use App\Entity\Eurocup;
use App\Entity\Turnir;
use App\Entity\Stadia;
use App\Entity\Ectable;
use App\Entity\Team;
use App\Entity\Lchplayer;
use App\Entity\Ecsostav;
use App\Entity\Ecplayer;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Form\EurocupNewType;
use App\Form\EurocupType;
use App\Form\Eurocup2Type;
use App\Form\EctableType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EurocupController extends AbstractController
{
    public function index($turnir, $season, $stadia = null)
    {
        $laststadia2 = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getLastStadia($turnir, $season);
        if (!$stadia) {
            $stadia = $laststadia2[0]['alias'];
        }
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir($turnir);

        $count=count($seasons);
        for ($i=0; $i < $count; $i++) {
          $laststadia[$i] = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getLastStadia($turnir, $seasons[$i]->getSeason()->getName());

            $seasons[$i]->getSeason()->setLaststadia($laststadia[$i][0]['alias']);
        }
        $entities = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getEntityByTurnir($turnir, $season, $stadia);
        $raunds = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getStadiaByTurnir($turnir, $season);
        $rus_stadia = $this->getDoctrine()->getRepository(Stadia::class)
          ->findOneByAlias($stadia);
        $rus_turnir = $this->getDoctrine()->getRepository(Turnir::class)
          ->findOneByAlias($turnir);
        $ectables = false;
        if (strpos($stadia, 'group') !== false) {
            $ectables = $this->getDoctrine()->getRepository(Ectable::class)
              ->getEcTable($turnir, $season, $stadia);
        }
        $teams = $this->getDoctrine()->getRepository(Ectable::class)
          ->getLchTeams($season);

        return $this->render('eurocup/index.html.twig', [
            'seasons' => $seasons,
            'entities' => $entities,
            'rus_stadia' => $rus_stadia,
            'rus_turnir' => $rus_turnir,
            'raunds' => $raunds,
            'teams' => $teams,
            'ectables' => $ectables,
            'laststadia' => $laststadia2
          ]);
    }

    public function show(SessionInterface $session, $id, $season)
    {
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir('leagueChampions');
        $entity = $this->getDoctrine()->getRepository(Eurocup::class)
          ->find($id);
        $bombs = $this->getDoctrine()->getRepository(Lchplayer::class)
          ->getBomb($season);
        $teams = $this->getDoctrine()->getRepository(Ectable::class)
          ->getLchTeams($season);
        $club = $this->getDoctrine()->getRepository(Team::class)
          ->findByTranslit($id);
        $players = $this->getDoctrine()->getRepository(Lchplayer::class)
          ->getLchTeamStat($season, $id);
        $stadia = $this->getDoctrine()->getRepository(Ectable::class)
          ->getStadiaByTeamAndSeason($season, $id);
        $ectables = $this->getDoctrine()->getRepository(Ectable::class)
          ->getEcTable('leagueChampions', $season, $stadia['alias']);
        $lastPlayer = $session->get('lastPlayer');

        return $this->render('eurocup/show.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'bombs' => $bombs,
            'teams' => $teams,
            'club' => $club,
            'players' => $players,
            'ectables' => $ectables,
            'lastPlayer' => $lastPlayer,
            'stadia' => $stadia
          ]);
    }

    public function showMatch($id, $turnir)
    {
        $entity = $this->getDoctrine()->getRepository(Ecsostav::class)
          ->findOneByEurocup($id);
        $seasons = $this->getDoctrine()->getRepository(Eurocup::class)
          ->getSeasonsByTurnir($turnir);
        $stadia = $this->getDoctrine()->getRepository(Eurocup::class)
          ->findOneById($id);

        return $this->render('eurocup/showMatch.html.twig', [
            'entity'  => $entity,
            'seasons' => $seasons,
            'stadia' => $stadia
            ]);
    }

    public function showTeam($id, $season)
    {
        $entity = $this->getDoctrine()->getRepository(Ecplayer::class)
          ->findEcPlayersByTeam($id, $season);
        $team = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($id);
            for ($i=0, $cnt=count($entity); $i < $cnt; $i++) {
                $name[$i] = $entity[$i]->getPlayer()->getName();
                $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'game')[0]->getGame();
                $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'goal')[0]->getGoal();

                $entity[$i]->setGameTeam($ptgame[$i]);
                $entity[$i]->setGoalTeam($ptgoal[$i]);
            }
        return $this->render('eurocup/showTeam.html.twig', [
            'entity' => $entity,
            'team' => $team
            ]);
    }

    public function newSeason($turnir, $season)
    {
        $entity = new Ectable();

        $form   = $this->createForm(EctableType::class, $entity, [
            'turnir' => $turnir,
            'season' => $season
            ]);

        return $this->render('eurocup/newSeason.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createSeason(SessionInterface $session, Request $request,
      $turnir, $season)
    {
        $ent = EctableType::class;
        $entity  = new Ectable();
        $obSeason = $this->getDoctrine()->getRepository(Seasons::class)
          ->findOneByName($season);
        $obTurnir = $this->getDoctrine()->getRepository(Turnir::class)
            ->findOneByAlias($turnir);
        $entity->setSeason($obSeason);
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

        return $this->render('eurocup/newSeason.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newMatch($season)
    {
        $entity = new Eurocup();

        $form   = $this->createForm(EurocupNewType::class, $entity, [
            'season' => $season
            ]);

        return $this->render('eurocup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, $season)
    {
        $em = $this->getDoctrine()->getManager();

        $entity  = new Eurocup();

        $year = $em->getRepository(Seasons::class)->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);
        $form = $this->createForm(EurocupNewType::class, $entity, [
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

        return $this->render('eurocup/newMatch.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function new($turnir, $season, $stadia = null)
    {
        $entity = new Eurocup();
        $em = $this->getDoctrine();

        $form   = $this->createForm(EurocupType::class, $entity, [
            'season' => $season,
            'turnir' => $turnir
            ]);

        return $this->render('eurocup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $turnir, $season, $stadia)
    {
        $entity  = new Eurocup();
        $em = $this->getDoctrine()->getManager();
        $cup = $em->getRepository(Turnir::class)->findOneByAlias($turnir);
        $year = $em->getRepository(Seasons::class)->findOneByName($season);

        $entity->setTurnir($cup);
        $entity->setSeason($year);
        $entity->setStatus(1);
        $form = $this->createForm(EurocupType::class, $entity, ['season' => $season,
            'turnir' => $turnir]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            //$team=$entity->getTeam()->getId();
            //$team2=$entity->getTeam2()->getId();
            //$seas=$entity->getSeason()->getId();
            //$score=$entity->getScore();
            //$em->getRepository('SteamFbstatBundle:Ectable')->updateEctable($team, $team2, $score, $seas);

            //return $this->redirect($this->generateUrl('eurocup', ['turnir' => $turnir, 'season' => $season,
              //  'stadia' => $stadia]));
        }

        return $this->render('eurocup/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function edit($id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Eurocup::class)->find($id);

        $editForm = $this->createForm(Eurocup2Type::class, $entity);

        return $this->render('eurocup/newEurocup.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function update(Request $request, $id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Eurocup::class)->find($id);

        $editForm = $this->createForm(Eurocup2Type::class, $entity);
        $entity->setStatus(0);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $team=$entity->getTeam()->getId();
            $team2=$entity->getTeam2()->getId();
            $seas=$entity->getSeason()->getId();
            $score=$entity->getScore();
            $season=$entity->getSeason()->getName();
            $stadia=$entity->getStadia()->getAlias();
            if(strpos($stadia, 'group') !== false)
            {
              $em->getRepository(Ectable::class)->updateEctable($team, $team2, $score, $seas);
            }
            return $this->redirect($this->generateUrl('eurocup', ['turnir' => $turnir, 'season' => $season,
                'stadia' => $stadia]));

        }

        return $this->render('eurocup/newEurocup.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

}
