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
use App\Entity\Game;
use App\Entity\Turnir;
use App\Form\RfplmatchType;
use App\Form\ShiptableType;
use App\Form\Rfplmatch2Type;
use App\Form\TourMatchType;
use App\Form\TourType;
use App\Form\TourEditType;
use App\Form\RfplmatchEditType;
use App\Service\Menu;
use App\Service\Props;
use App\Service\Functions;
use App\Service\ResizeImage;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

class ShiptableController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Menu $serviceMenu, Functions $functions, ResizeImage $resize, $country, $season, $tour)
    {
        $strana = $this->entityManager->getRepository(Shiptable::class)
                ->translateCountry($country)['country'];

        $entities = $this->entityManager->getRepository(Shiptable::class)
                ->getTable($strana, $season);

        if(!$entities){
          throw $this->createNotFoundException('The season does not exist');
        }

        $seasons = $this->entityManager->getRepository(Shiptable::class)
                ->getSeasons($strana);

        $maxTour = $this->entityManager->getRepository(Game::class)
                         ->getMaxTour($country, $season);
        if(!$tour) {
           $matches = $this->entityManager->getRepository(Game::class)
                      ->getMatches($country, $season, $maxTour);
         } else {
             $matches = $this->entityManager->getRepository(Game::class)
                            ->getMatches($country, $season, $tour);
         }
        $numberTour = $this->entityManager->getRepository(Game::class)
                         ->getTours($country, $season);

        if(!$matches){
          throw $this->createNotFoundException('The tour does not exist');
        }

        foreach($matches as &$match){
          $img = $match->getTeam()->getImage();
          if($img){
            $match->getTeam()->setImage($resize->ResizeImageGet($img, ['width' => 80, 'height' => 80]));
          }
          $img2 = $match->getTeam2()->getImage();
          if($img2){
            $match->getTeam2()->setImage($resize->ResizeImageGet($img2, ['width' => 80, 'height' => 80]));
          }
        }
        $rusCountry = $this->entityManager->getRepository(Shiptable::class)
                ->translateCountry($country)['rusCountry'];
        switch ($country) {
            case 'russia' :
              $bombs = $this->entityManager->getRepository(Gamers::class)
                    ->getBomb($season);
                    break;
            case 'england' :
            case 'spain' :
            case 'italy' :
            case 'germany' :
            case 'france' :
                $bombs = $this->entityManager->getRepository(Shipplayer::class)
                    ->getBomb5($season, $strana);
                    break;
            case 'fnl' :
                $bombs = $this->entityManager->getRepository(Fnlplayer::class)
                    ->getBomb5($season, $strana);

        }

        $bombSum = $functions->getBombSum($bombs, 20);
        $assistSum = false;
        $scoreSum = false;

        if($country == 'russia' && $season > '2021'){
          $assistSum = $functions->getBombSum($bombs, 20, 'assist');
          $scoreSum = $functions->getBombSum($bombs, 20, 'score');
        }

        $menu = $serviceMenu->generate($country, $season);

        return $this->render('shiptable/index.html.twig', [
            'entities' => $entities,
            'seasons' => $seasons,
            'bombs' => $bombSum,
            'matches' => $matches,
            'tours' => $numberTour,
            'rusCountry' => $rusCountry,
            'maxTour' => $maxTour,
            'menu' => $menu,
            'strana' => $strana,
            'assistSum' => $assistSum,
            'scoreSum' => $scoreSum,
        ]);
    }

    public function stat(Menu $serviceMenu, Props $props, $country)
    {
      $topMatchesRus = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopPlayers(20, 'game');
      $topMatchesRusCurr = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopPlayersCurr(20, 'game', $props->getLastSeason());
      $topGoalsRus = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopPlayers(20, 'goal');
      $topGoalsRusCurr = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopPlayersCurr(20, 'goal', $props->getLastSeason());
      $topGoalkeepers = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopGoalkeepers(20);
      $topGoalkeepersCurr = $this->entityManager->getRepository(Rusplayer::class)
        ->getTopGoalkeepersCurr(20, $props->getLastSeason());
      $menu = $serviceMenu->generate($country);
      $rusCountry = $this->entityManager->getRepository(Shiptable::class)
              ->translateCountry($country)['rusCountry'];
      $maxAgePlayers = $this->entityManager->getRepository(Gamers::class)
              ->getAgeListPlayers($props->getLastSeason(), 'ASC');
      $minAgePlayers = $this->entityManager->getRepository(Gamers::class)
              ->getAgeListPlayers($props->getLastSeason(), 'DESC');

      return $this->render('stat/index.html.twig', [
            'menu' => $menu,
            'rusCountry' => $rusCountry,
            'topMatchesRus' => $topMatchesRus,
            'topMatchesRusCurr' => $topMatchesRusCurr,
            'topGoalsRus' => $topGoalsRus,
            'topGoalsRusCurr' => $topGoalsRusCurr,
            'topGoalkeepers' => $topGoalkeepers,
            'topGoalkeepersCurr' => $topGoalkeepersCurr,
            'maxAgePlayers' => $maxAgePlayers,
            'minAgePlayers' => $minAgePlayers
      ]);
    }

    public function show(SessionInterface $session, Menu $serviceMenu, ResizeImage $resize, $id, $season, $country)
    {
        $club = $this->entityManager->getRepository(Team::class)
          ->findOneByTranslit($id);

        if(!$club){
          throw $this->createNotFoundException('The club does not exist');
        }

        if($logo= $club->getImage()){
          $club->setImage($resize->ResizeImageGet($logo, ['width' => 270, 'height' => 270]));
        }
        $isTeam = $this->entityManager->getRepository(Shiptable::class)
                ->findByTeamAndSeason($club->getId(), $season);
        if(empty($isTeam)){
          return $this->redirect($this->generateUrl('championships', [
              'season' => $season, 'country' => $country]));
        }
        $strana = $this->entityManager->getRepository(Shiptable::class)
                ->translateCountry($country)['country'];
        $seasons = $this->entityManager->getRepository(Shiptable::class)
                ->getSeasons($strana, $id);
        $shiptable = $this->entityManager->getRepository(Shiptable::class)
                ->getTable($strana, $season);

        $arSborn = [];
        if ($country == 'russia') {
            $players = $this->entityManager->getRepository(Gamers::class)
              ->getRusTeamStat($season, $id);

            for ($i=0, $cnt=count($players); $i < $cnt; $i++) {
                $name[$i] = $players[$i]->getPlayer()->getName();

                $arPtGame[$i] = $this->entityManager->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $id, 'game');
                if(isset($arPtGame[$i][0]))
                {
                  $ptgame[$i] = $arPtGame[$i][0]->getGame();
                  $arPtGoal[$i] = $this->entityManager->getRepository(Playersteam::class)
                                   ->getStat($name[$i], $id, 'goal');
                  $ptgoal[$i] = $arPtGoal[$i][0]->getGoal();
                  $players[$i]->setGameTeam($ptgame[$i]);
                  $players[$i]->setGoalTeam($ptgoal[$i]);
                }
            }
        } else {
          if ($country == 'fnl') {
            $players = $this->entityManager->getRepository(Fnlplayer::class)
                          ->getTeamStat($season, $id);
          } else {
            $players = $this->entityManager->getRepository(Shipplayer::class)
                          ->getTeamStat($season, $id);
          }
        }

        foreach($players as &$player){
          if($img = $player->getPlayer()->getCountry()->getImage()){
            $sbornId = $player->getPlayer()->getCountry()->getId();
            if(!in_array($sbornId, $arSborn)){
              $player->getPlayer()->getCountry()->setImage($resize->ResizeImageGet($img, ['width' => 80, 'height' => 80]));
              $arSborn[] = $sbornId;
            }
          }
        }

        $cntLastMatches = 10;
        if($this->getUser() && in_array('ROLE_ADMIN', $this->getUser()->getRoles())){
           $cntLastMatches = 20;
        }

        $lastMatches = $this->entityManager->getRepository(Game::class)
                      ->getLastMatchesByTeam($season, $id, $cntLastMatches);
        $strana = $this->entityManager->getRepository(Shiptable::class)
                     ->translateCountry($country)['country'];
        $teams = $this->entityManager->getRepository(Shiptable::class)
          ->getTeams($season, $strana);

        foreach($teams as &$team){
          if($team['image']){
            $team['image'] = $resize->ResizeImageGet($team['image'], ['width' => 80, 'height' => 80]);
          }
        }
        $menu = $serviceMenu->generate($country, $season);

        $lastPlayer = $session->get('lastPlayer');

        $arParams = [
         'players' => $players,
         'seasons' => $seasons,
         'teams' => $teams,
         'club' => $club,
         'lastPlayer' => $lastPlayer,
         'lastMatches' => $lastMatches,
         'shiptable' => $shiptable,
         'menu' => $menu
       ];

        if ($country == 'russia') {
           return $this->render('shiptable/showRus.html.twig', $arParams);
        } elseif ($country == 'fnl') {
           return $this->render('shiptable/showFnl.html.twig', $arParams);
        } else {
        return $this->render('shiptable/show.html.twig', $arParams);
        }
    }

    public function newMatch(Menu $serviceMenu, $country, $season)
    {
        $entity = new Game();

        $form   = $this->createForm(TourMatchType::class, $entity, [
            'country' => $country,
            'season' => $season
            ]);
        $menu = $serviceMenu->generate($country, $season);

        return $this->render('shiptable/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function createMatch(Request $request, Menu $serviceMenu, $country, $season)
    {
        if($country == 'fnl'){
          $turnir = 'fnl';
        } else {
          $turnir = $country."-champ";
        }
        $ent = TourMatchType::class;
        $entity  = new Game();

        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $obTurnir = $this->entityManager->getRepository(Turnir::class)->findOneByAlias($turnir);

        $entity->setSeason($year);
        $entity->setTurnir($obTurnir);
        $entity->setStatus(1);

        $form = $this->createForm($ent, $entity, [
            'country' => $country,
            'season' => $season
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }
        $menu = $serviceMenu->generate($country, $season);

        return $this->render('shiptable/newMatch.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function newSeason($country)
    {
        $entity = new Shiptable();
        $form   = $this->createForm(ShiptableType::class, $entity, [
            'country' => $country
            ]);

        return $this->render('shiptable/newSeason.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createSeason(SessionInterface $session, Request $request,
      $country)
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

            $ent = ShiptableType::class;
            $entity  = new Shiptable();
            $strana = $this->entityManager->getRepository(Country::class)
              ->findOneByName($country2);
            $entity->setCountry($strana);


        $form = $this->createForm($ent, $entity, [
            'country' => $country
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $session->set('season', $entity->getSeason()->getName());
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('championships', ['country' => $country, 'season' => $season]));
        }

        return $this->render('shiptable/newSeason.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newRus($id)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $season = $entity->getSeason()->getName();

        $form   = $this->createForm(Rfplmatch2Type::class, $entity, [
              'season' => $season
            ]);

        return $this->render('shiptable/newRus.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createRus(Request $request, $id)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $season = $entity->getSeason()->getName();

        $form = $this->createForm(Rfplmatch2Type::class, $entity, [
              'season' => $season
            ]);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $team=$entity->getTeam()->getId();
            $team2=$entity->getTeam2()->getId();
            $seas=$entity->getSeason()->getId();
            $goal1=$entity->getGoal1();
            $goal2=$entity->getGoal2();
            $this->entityManager->getRepository(Shiptable::class)
               ->updateShiptable($team, $team2, $goal1, $goal2, $seas);
            $this->entityManager->getRepository(Team::class)
              ->updateSvod($team, $team2, $goal1, $goal2);
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
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $form   = $this->createForm(TourType::class, $entity);

        return $this->render('shiptable/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function create(Request $request, $id)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $form = $this->createForm(TourType::class, $entity);
        $entity->setStatus(0);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $team = $entity->getTeam()->getId();
            $team2 = $entity->getTeam2()->getId();
            $seas = $entity->getSeason()->getId();
            $turnir = $entity->getTurnir()->getAlias();
            if($turnir == 'fnl') {
              $country = 'fnl';
            } else {
              $arTurnir = explode('-', $turnir);
              $country = $arTurnir[0];
            }
            $goal1=$entity->getGoal1();
            $goal2=$entity->getGoal2();

            $this->entityManager->getRepository(Shiptable::class)
               ->updateShiptable($team, $team2, $goal1, $goal2, $seas);
            $season=$entity->getSeason()->getName();

            return $this->redirect($this->generateUrl('championships', [
                'season' => $season, 'country' => $country]));
        }

        return $this->render('shiptable/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function edit($id, $country)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $form   = $this->createForm(RfplmatchEditType::class, $entity);

        return $this->render('shiptable/edit.html.twig', array(
            'entity' => $entity,
            'country' => $country,
            'form'   => $form->createView(),
        ));
    }

    public function update(Request $request, $id, $country)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);
        $form   = $this->createForm(RfplmatchEditType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $season=$entity->getSeason()->getName();

            return $this->redirect($this->generateUrl('championships', [
                'season' => $season, 'country' => $country]));
        }

        return $this->render('shiptable/edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function confirm($id, $country)
    {
        $entity = $this->entityManager->getRepository(Game::class)->find($id);

        return $this->render('shiptable/delete.html.twig', array(
            'entity' => $entity
        ));
    }

    public function delete($id, $country)
    {
        $em = $this->entityManager;
        $entity = $em->getRepository(Game::class)->find($id);

        $season = $entity->getSeason()->getName();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('championships', [
            'season' => $season, 'country' => $country]));
    }

    public function svod(Menu $serviceMenu, $country)
    {
        $entity = $this->entityManager->getRepository(Team::class)
          ->getSvod($country);
        switch ($country) {
            case 'russia' : $country2 = 'России'; break;
            case 'england' : $country2 = 'Англии';  break;
            case 'spain' : $country2 = 'Испании'; break;
            case 'italy' : $country2 = 'Италии'; break;
            case 'germany' : $country2 = 'Германии'; break;
            case 'france' : $country2 = 'Франции'; break;
            case 'fnl' : $country2 = 'ФНЛ'; break;
        }
        $menu = $serviceMenu->generate($country);

        return $this->render('shiptable/svod.html.twig', array(
            'entity' => $entity,
            'country' => $country2,
            'menu' => $menu
        ));
    }

    public function shipplayersUpdate(Request $request)
    {
      $all = $request->getPayload()->all();
      $query = $all['query'];
      $champ = $all['champ'];
      $em = $this->entityManager;
      $param = [];
      foreach ($query as $val) {
        if($champ == 'top5'){
          $em->getRepository(Shipplayer::class)->updateShipplayers($val);
          $em->getRepository(Player::class)->updateShipplayerSumGame($val);
          $player = $this->entityManager->getRepository(Shipplayer::class)
            ->find($val[0]);
        } else {
          $em->getRepository(Fnlplayer::class)->updateFnlplayers($val);
          $player = $this->entityManager->getRepository(Fnlplayer::class)
            ->find($val[0]);
          $em->getRepository(Rusplayer::class)->updateFnlSumGame($val);
        }
        $param[] = [$val[0], $player->getGame()];
      }
      $response = json_encode($param);

      return new JsonResponse($response);
    }

    public function tour(ResizeImage $resize, $country, $season, $tour)
    {
      $matches = $this->entityManager->getRepository(Game::class)
                            ->getMatches($country, $season, $tour);
      foreach($matches as &$match){
        $img = $match->getTeam()->getImage();
        if($img){
          $match->getTeam()->setImage($resize->ResizeImageGet($img, ['width' => 80, 'height' => 80]));
        }
        $img2 = $match->getTeam2()->getImage();
        if($img2){
          $match->getTeam2()->setImage($resize->ResizeImageGet($img2, ['width' => 80, 'height' => 80]));
        }
      }

      $response = [
        "code" => 200,
        "response" => $this->render('shiptable/tour.html.twig', ['matches' => $matches])->getContent()
      ];

      return new JsonResponse($response);
    }
}
