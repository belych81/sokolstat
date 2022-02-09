<?php

namespace App\Controller;

use App\Entity\Eurocup;
use App\Entity\Turnir;
use App\Entity\Stadia;
use App\Entity\Ectable;
use App\Entity\Team;
use App\Entity\Game;
use App\Entity\Lchplayer;
use App\Entity\Ecsostav;
use App\Entity\Ecplayer;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Form\EurocupNewType;
use App\Form\EurocupType;
use App\Form\Eurocup2Type;
use App\Form\EurocupTableType;
use App\Form\EctableType;
use App\Form\EctableEditType;
use App\Service\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EurocupController extends AbstractController
{
    public function index(Menu $serviceMenu, $turnir, $season)
    {
        $seasons = $this->getDoctrine()->getRepository(Game::class)
          ->getSeasons($turnir);
        $rus_turnir = $this->getDoctrine()->getRepository(Turnir::class)
            ->findOneByAlias($turnir);
        $stadies = $this->getDoctrine()->getRepository(Stadia::class)
          ->getStadiaEurocup($season, $turnir);
      //  $raunds = $this->getDoctrine()->getRepository(Eurocup::class)
        //  ->getStadiaByTurnir($turnir, $season);
        foreach ($stadies as $stadia)
        {
          $matchesStadia = $this->getDoctrine()->getRepository(Game::class)
            ->getEntityByTurnirStadia($turnir, $season, $stadia);
          $matches1 = [];
          $matches2 = [];
          foreach($matchesStadia as $match){
            $numb = $match->getTour();
            if($numb == 1){
              $matches1[$match->getTeam()->getId()] = $match;
            } elseif($numb == 2){
              $matches2[] = $match;
            }
          }
          $stadia->setStadiaMatches($matchesStadia);
          if(!empty($matches1)){
            $stadia->setStadiaMatches1($matches1);
          }
          if(!empty($matches2)){
            $stadia->setStadiaMatches2($matches2);
          }
            //$rus_stadia = $this->getDoctrine()->getRepository(Stadia::class)
              //->findOneByAlias($stadia);
            $stadiaAlias = $stadia->getAlias();
            if (strpos($stadiaAlias, 'group') !== false) {
               $stadia->setStadiaTable($this->getDoctrine()->getRepository(Ectable::class)
                  ->getEcTable($turnir, $season, $stadiaAlias));
            }
        }

        $teams = $this->getDoctrine()->getRepository(Ectable::class)
          ->getLchTeams($season);
        $menu = $serviceMenu->generateEurocup($season);

        return $this->render('eurocup/index.html.twig', [
            'seasons' => $seasons,
            'stadies' => $stadies,
            'rus_turnir' => $rus_turnir,
            'teams' => $teams,
            'menu' => $menu
          ]);
    }

    public function show(SessionInterface $session, Menu $serviceMenu,  $id, $season)
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
        $menu = $serviceMenu->generateEurocup($season);
        return $this->render('eurocup/show.html.twig', [
            'entity'      => $entity,
            'seasons' => $seasons,
            'bombs' => $bombs,
            'teams' => $teams,
            'club' => $club,
            'players' => $players,
            'ectables' => $ectables,
            'lastPlayer' => $lastPlayer,
            'menu' => $menu,
            'stadia' => $stadia
          ]);
    }

    public function showMatch(Menu $serviceMenu, $id, $turnir)
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

    public function showTeam(Menu $serviceMenu, $id, $season)
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
        $menu = $serviceMenu->generateEurocup($season);

        return $this->render('eurocup/showTeam.html.twig', [
            'entity' => $entity,
            'menu' => $menu,
            'team' => $team
            ]);
    }

    public function newSeason(SessionInterface $session, $turnir, $season)
    {
        $entity = new Ectable();

        $form   = $this->createForm(EctableType::class, $entity, [
            'turnir' => $turnir,
            'season' => $season,
            'stadia' => $session->get('stadia')
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

    public function newMatch(SessionInterface $session, $season)
    {
        $entity = new Game();
        //if(!($session->get('data'))){
      //  }
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

        $entity  = new Game();

        $year = $em->getRepository(Seasons::class)->findOneByName($season);

        $entity->setSeason($year);
        $entity->setStatus(1);
        $form = $this->createForm(EurocupNewType::class, $entity, [
            'season' => $season
            ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
          echo 333;
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

        $entity = $em->getRepository(Game::class)->find($id);

        $editForm = $this->createForm(EurocupTableType::class, $entity);

        return $this->render('eurocup/newEurocup.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function update(Request $request, $id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Game::class)->find($id);

        $editForm = $this->createForm(EurocupTableType::class, $entity);
        $entity->setStatus(0);
        $editForm->handleRequest($request);

        if ($editForm->isValid() && $editForm->isSubmitted()) {
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

    public function editMatch($id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Game::class)->find($id);

        $editForm = $this->createForm(Eurocup2Type::class, $entity);

        return $this->render('eurocup/editEurocup.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function updateMatch(Request $request, $id, $turnir)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Game::class)->find($id);

        $editForm = $this->createForm(Eurocup2Type::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $season=$entity->getSeason()->getName();

            if(strpos($turnir, '-cup') !== false){
              return $this->redirect($this->generateUrl('nationcup', [
                'country' => $entity->getTeam()->getCountry()->getTranslit(),
                'season' => $season
              ]));
            }

            return $this->redirect($this->generateUrl('eurocup', [
              'turnir' => $turnir,
              'season' => $season
            ]));

        }

        return $this->render('eurocup/editEurocup.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

    public function editEctable($id, $season, $turnir, $stadia=false)
    {
        $entity = $this->getDoctrine()->getRepository(Ectable::class)->find($id);
        $form   = $this->createForm(EctableEditType::class, $entity);

        return $this->render('eurocup/editEctable.html.twig', array(
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        ));
    }

    public function updateEctable(Request $request, $id, $season, $turnir,
      $stadia=false)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Ectable::class)->find($id);

        $editForm = $this->createForm(EctableEditType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('eurocup', [
              'turnir' => $turnir, 'season' => $season,
                'stadia' => $stadia]));
        }

        return $this->render('eurocup/editEctable.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

}
