<?php

namespace App\Controller;

use App\Entity\Cup;
use App\Entity\Game;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Turnir;
use App\Entity\Shiptable;
use App\Entity\Playersteam;
use App\Entity\Stadia;
use App\Entity\Rfplmatch;
use App\Entity\Gamers;
use App\Entity\Cupplayer;
use App\Entity\Seasons;
use App\Entity\Ectable;
use App\Form\CupType;
use App\Form\Cup2Type;
use App\Service\Menu;
use App\Service\ResizeImage;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CupController extends AbstractController
{
  public function index(Menu $serviceMenu, ResizeImage $resize, $season)
  {
      $seasons = $this->getDoctrine()->getRepository(Game::class)->getSeasons('russia-cup');
      $stadies = $this->getDoctrine()->getRepository(Stadia::class)
        ->getStadiaEurocup($season, 'russia-cup');

      if(!$stadies){
        throw $this->createNotFoundException('The season does not exist');
      }

      foreach ($stadies as $stadia)
      {
        $matches = $this->getDoctrine()->getRepository(Game::class)
          ->findAllBySeasonAndStadiaAndCountry($season, $stadia, 'russia');

        foreach($matches as &$match){
          $team = $match->getTeam();
          $img = $team->getImage();         
          if($img && strpos($img, 'images') === false){
            $team->setImage($resize->ResizeImageGet($img, ['width' => 80, 'height' => 80]));
          }
          $team2 = $match->getTeam2();
          $img2 = $team2->getImage();
          if($img2 && strpos($img2, 'images') === false){
            $team2->setImage($resize->ResizeImageGet($img2, ['width' => 80, 'height' => 80]));
          }
        }
        $stadia->setStadiaMatches($matches);

          $stadiaAlias = $stadia->getAlias();
          
          if (strpos($stadiaAlias, 'group') !== false) {
             $stadia->setStadiaTable($this->getDoctrine()->getRepository(Ectable::class)
                ->getEcTable('russia-cup', $season, $stadiaAlias));
          }
      }
      $menu = $serviceMenu->generate('russia', $season);

      return $this->render('cup/index.html.twig', [
          'seasons' => $seasons,
          'stadies' => $stadies,
          'menu' => $menu
      ]);
  }

  public function show(Menu $serviceMenu, ResizeImage $resize, $id, $season)
  {
      $club = $this->getDoctrine()->getRepository(Team::class)
        ->findOneByTranslit($id);

      if(!$club){
        throw $this->createNotFoundException('The club does not exist');
      }

      $isTeam = $this->getDoctrine()->getRepository(Game::class)
              ->findByTeamAndSeason($club->getId(), $season, 'russia-cup');

      if(!$isTeam){
        throw $this->createNotFoundException('The season does not exist');
      }

      if(empty($isTeam)){
        return $this->redirect($this->generateUrl('cup', [
            'season' => $season]));
      }
      if($club && $img = $club->getImage()){
        $logo = $resize->ResizeImageGet($img, ['width' => 270, 'height' => 270]);
      }
      $seasons = $this->getDoctrine()->getRepository(Game::class)->getSeasons('russia-cup');
      $players = $this->getDoctrine()->getRepository(Cupplayer::class)
        ->getCupTeamStat($season, $id);
      $teams = $this->getDoctrine()->getRepository(Game::class)
        ->getTeams($season, 'russia-cup');
      $teams2 = $this->getDoctrine()->getRepository(Game::class)
          ->getTeams($season, 'russia-cup', 2);
      $teams = array_unique(array_merge($teams, $teams2), SORT_REGULAR);

      foreach($teams as &$team){
        if($team['image']){
          $team['image'] = $resize->ResizeImageGet($team['image'], ['width' => 80, 'height' => 80]);
        }
      }

      for ($i=0, $cnt=count($players); $i < $cnt; $i++)
      {
          $name[$i] = $players[$i]->getPlayer()->getName();
          $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                           ->getStat($name[$i], $id, 'game')[0]->getGame();
          $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                           ->getStat($name[$i], $id, 'goal')[0]->getGoal();

          $players[$i]->setGameTeam($ptgame[$i]);
          $players[$i]->setGoalTeam($ptgoal[$i]);
      }

      $menu = $serviceMenu->generate('russia', $season);

      return $this->render('cup/show.html.twig', [
          'seasons' => $seasons,
          'players' => $players,
          'teams' => $teams,
          'club' => $club,
          'menu' => $menu,
          'logo' => $logo
        ]);
  }

  public function newMatch(Menu $serviceMenu, $season)
  {
        $entity = new Game();

        $form   = $this->createForm(CupType::class, $entity, [
            'season' => $season
            ]);

      $menu = $serviceMenu->generate('russia', $season);

      return $this->render('cup/newMatch.html.twig', array(
          'entity' => $entity,
          'menu' => $menu,
          'form'   => $form->createView(),
      ));
  }

  public function createMatch(Menu $serviceMenu, Request $request, $season)
  {
      $ent = CupType::class;
      $entity  = new Game();
      $year = $this->getDoctrine()->getRepository(Seasons::class)
        ->findOneByName($season);

      $obTurnir = $this->getDoctrine()->getRepository(Turnir::class)->findOneByAlias('russia-cup');
      $entity->setSeason($year);
      $entity->setTurnir($obTurnir);
      $entity->setStatus(1);

      $form = $this->createForm($ent, $entity, [
          'season' => $season
          ]);

      $form->handleRequest($request);

      if ($form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($entity);
          $em->flush();
      }

      $menu = $serviceMenu->generate('russia', $season);

      return $this->render('cup/newMatch.html.twig', array(
          'entity' => $entity,
          'menu' => $menu,
          'form'   => $form->createView(),
      ));
    }

    public function new(Menu $serviceMenu, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Game::class)->find($id);
        $season = $entity->getSeason()->getName();

        $form   = $this->createForm(Cup2Type::class, $entity, [
            'season' => $season
            ]);

        $menu = $serviceMenu->generate('russia', $season);

        return $this->render('cup/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function create(Menu $serviceMenu, Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository(Game::class)->find($id);

        $season = $entity->getSeason()->getName();
        $form = $this->createForm(Cup2Type::class, $entity, [
            'season' => $season
            ]);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $season = $entity->getSeason()->getName();
            $team=$entity->getTeam()->getId();
            $team2=$entity->getTeam2()->getId();
            $seas=$entity->getSeason()->getId();
            $score=$entity->getScore();
            $stadia=$entity->getStadia()->getAlias();
            if(strpos($stadia, 'group') !== false)
            {
              $em->getRepository(Ectable::class)->updateEctable($team, $team2, $score, $seas);
            }
            return $this->redirect($this->generateUrl('cup', [
                'season' => $season]));
        }

        $menu = $serviceMenu->generate('russia', $season);

        return $this->render('cup/new.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }
}
