<?php

namespace App\Controller;

use App\Entity\Gamers;
use App\Entity\Team;
use App\Entity\Rusplayer;
use App\Entity\Shipplayer;
use App\Entity\Fnlplayer;
use App\Entity\Cupplayer;
use App\Entity\Lchplayer;
use App\Entity\Ecplayer;
use App\Entity\Sbplayer;
use App\Entity\Supercupplayer;
use App\Entity\Player;
use App\Entity\Playersteam;
use App\Entity\Seasons;
use App\Entity\Sostav;
use App\Entity\Turnir;
use App\Entity\Country;
use App\Form\RusType;
use App\Form\FnlType;
use App\Form\RusplayerType;
use App\Form\PlayerType;
use App\Form\PlayerEditType;
use App\Form\LchplayerType;
use App\Form\ShipplayerType;
use App\Form\ShipplayerTeamType;
use App\Form\ShipplayerEditType;
use App\Form\SbplayerType;
use App\Form\SostavType;
use App\Form\ShipplayerUpdateType;
use App\Form\FnlplayerUpdateType;
use App\Service\Menu;
//use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

class PlayerController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function search(Request $request)
    {
        $query = htmlspecialchars($request->request->get('query'));
        $isFormPlayer = htmlspecialchars($request->request->get('form_player'));

        $arQuery = explode(" ", $query);
/*
        $results = $this->finder->findHybrid($query);

        var_dump($results);*/
        $em = $this->entityManager;

        $responsePlayer = $em->getRepository(Player::class)->searchPlayers($arQuery);

        if($isFormPlayer != 'y'){
            $responseTeam = $em->getRepository(Team::class)->searchTeams($arQuery);
            $player = [];
            foreach($responsePlayer as $val){
                $player['player/'.$val->getTranslit().'/'] = $val->getName();
            }
            $team = [];
            foreach($responseTeam as $val){
                $team['team/'.$val->getTranslit()] = $val->getName();
            }
            return new JsonResponse(array_merge($player, $team));
        }

        $player = [];
        foreach($responsePlayer as $val){
            $player[$val->getId()] = $val->getName();
        }
        return new JsonResponse($player);
    }

    public function edit($id)
    {
        $entity = $this->entityManager->getRepository(Player::class)->find($id);
        $form   = $this->createForm(PlayerEditType::class, $entity);

        return $this->render('player/edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function update(Request $request, $id)
    {
        $entity = $this->entityManager->getRepository(Player::class)->find($id);
        $form   = $this->createForm(PlayerEditType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $translit = $entity->getTranslit();
            return $this->redirect($this->generateUrl('player_show', [
              'id' => $translit]));
        }

        return $this->render('player/edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editShipplayer(Menu $serviceMenu,  $id, $season, $country, $team)
    {
        $entity = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $form   = $this->createForm(ShipplayerEditType::class, $entity);

        $menu = $serviceMenu->generateEurocup($season);

        return $this->render('player/editShipplayer.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function updateShipplayer(Request $request, $id, $season, $country, $team)
    {
        $entity = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $form   = $this->createForm(ShipplayerEditType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('championships_show', [
              'id' => $team, 'season' => $season, 'country' => $country]));
        }

        return $this->render('player/editShipplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editChamp(SessionInterface $session, $id, $season, $team, $change)
    {
        $arAssist = ['minusAssist', 'plusAssist', 'minusScore', 'plusScore'];

        $em = $this->entityManager;
        $cache = $em->getCache();
        $cache->evictEntity(Gamers::class, $id);
        $em->getRepository(Gamers::class)->updateGamer($id, $change);

        $entity = $em->getRepository(Gamers::class)->find($id);
        if(!in_array($change, $arAssist)){
          $playerId = $entity->getPlayer()->getId();
          $player = $entity->getPlayer();
          $teamOb = $entity->getTeam();
          $em->getRepository(Rusplayer::class)
            ->updateRusplayer($playerId, $change);
          $em->getRepository(Playersteam::class)
                  ->updatePlayersteam($player, $teamOb, $change);
        }
        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal(),
            'assist' => $entity->getAssist(),
            'score' => $entity->getScore()
        ]);
        return new Response($response);
    }

    public function editChampTotal(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Gamers::class)->updateGamer($id, $change, true);
        $entity = $this->entityManager->getRepository(Gamers::class)->find($id);

        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getTotalgame(),
            'goal' => $entity->getTotalgoal()
        ]);
        return new Response($response);
    }

    public function editSb(SessionInterface $session, $id, $season, $change)
    {
        $this->entityManager->getRepository(Sbplayer::class)->updateSb($id, $change);
        $entity = $this->entityManager->getRepository(Sbplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $this->entityManager->getRepository(Rusplayer::class)
          ->updateSbplayer($playerId, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());

        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function editTotalChamp($id, $season, $team, $change)
    {
        $entity = $this->entityManager->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->entityManager->getRepository(Rusplayer::class)
          ->updateRusplayerTotalChamp($playerId, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function editTotalTeam($id, $season, $team, $change)
    {
        $entity = $this->entityManager->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $teamOb = $entity->getTeam();
        $this->entityManager->getRepository(Playersteam::class)
          ->updateTotalTeam($playerId, $teamOb, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function editTotal($id, $season, $team, $change)
    {
        $entity = $this->entityManager->getRepository(Gamers::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->entityManager->getRepository(Rusplayer::class)
          ->updateRusplayerTotal($playerId, $change);

        return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'season' => $season,
                'country' => 'russia'
                    ]));
    }

    public function newChampLast($season, $team, $country, $route, $isTeam)
    {
        $em = $this->entityManager;
        if($isTeam){
          $player = $this->entityManager->getRepository(Player::class)
            ->getLastTeamPlayer($team);
        } else {
          $player = $this->entityManager->getRepository(Player::class)
            ->getLastOnePlayer();
        }
        switch($country){
          case 'fnl' : $entity = new Fnlplayer(); break;
          case 'leagueChampions' : $entity = new Lchplayer(); break;
          case 'cup' :
          case 'russia' :
            if($country == 'cup'){
              $entity = new Cupplayer();
            } else {
              $entity = new Gamers();
              $entity->setTotalgame(0);
            }
            if(!$isTeam){
                $rusplayer = new Rusplayer();
                $rusplayer->setPlayer($player);
                $em->persist($rusplayer);
                $em->flush();
            
                $entity2 = new Playersteam();
                $entity2->setGame(0);
                $entity2->setGoal(0);
                $entity2->setPlayer($player);
                $team2 = $this->entityManager->getRepository(Team::class)
                            ->findOneByTranslit($team);
                $entity2->setTeam($team2);

                $em->persist($entity2);
                $em->flush();
            }
            break;
          default:
            $entity = new Shipplayer();
        }

        $maxId = $this->entityManager->getRepository(Player::class)
                    ->getMaxId();
        $club = $this->entityManager->getRepository(Team::class)
          ->findOneByTranslit($team);
        $year = $this->entityManager->getRepository(Seasons::class)
          ->findOneByName($season);

        $entity->setTeam($club);
        $entity->setGame(0);
        $entity->setSeason($year);
        $entity->setPlayer($player);

        $em->persist($entity);
        $em->flush();

        $routeParams = [
          'id' => $team,
          'season' => $season
        ];
        if($route == 'championships_show'){
          $routeParams['country'] = $country;
        } elseif($route == 'eurocup_show'){
          $routeParams['turnir'] = 'leagueChampions';
        }
        return $this->redirect($this->generateUrl($route, $routeParams));
    }

    public function newChamp($season, $team)
    {

        $entity = new Gamers();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newChamp.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChamp(Request $request, $team, $season)
    {
        $entity  = new Gamers();
        $rusplayer = new RusPlayer();
        $club = $this->entityManager->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);

        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $goal = (int)$form->get('goal')->getData();
            $entity->setTotalgoal($goal);
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $this->entityManager->getRepository(Rusplayer::class)
                ->updateRusplayerChamp($player, $goal);
            $this->entityManager->getRepository(Playersteam::class)
                ->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newChamp.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newMund($year, $country, $turnir)
    {
        $entity = new Sostav();

        $form   = $this->createForm(SostavType::class, $entity, ['year' => $year,
            'country' => $country]);

        return $this->render('rusplayer/newMund.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createMund(Request $request, $year, $country, $turnir)
    {
        $entity  = new Sostav();
        $rusplayer = new RusPlayer();

        $form   = $this->createForm(SostavType::class, $entity, ['year' => $year,
            'country' => $country]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $year = $em->getRepository(Seasons::class)->findOneByName($year);
            $countr = $em->getRepository(Country::class)->findOneByTranslit($country);
            $entity->setSeason($year);
            $entity->setCountry($countr);
            $em->persist($entity);
            $em->flush();
            /*$player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $this->entityManager->getRepository(Rusplayer::class)
                ->updateRusplayerChamp($player, $goal);
            $this->entityManager->getRepository(Playersteam::class)
                ->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
              ]));*/
        }

        return $this->render('rusplayer/newMund.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newPlayersteam($team, $season, $turnir)
    {
        $entity = new Playersteam();

        $form   = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newPlayersteam.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createPlayersteam(Request $request, $team, $season, $turnir)
    {
        $entity = new Playersteam();
        $entity->setGame(0);

        $form = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $team2 = $this->entityManager->getRepository(Team::class)
                        ->findOneByTranslit($team);
            $entity->setTeam($team2);
            $entity->setGoal(0);
            $em->persist($entity);
            $em->flush();

            if($turnir == 'champ'){
              return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'russia',
                'season' => $season
                    ]));
            } else {
              return $this->redirect($this->generateUrl('cup_show', [
                'id' => $team,
                'season' => $season
                    ]));
            }
        }

        return $this->render('rusplayer/newPlayersteam.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newRusplayer()
    {
        $entity = new Rusplayer();

        $form   = $this->createForm(RusplayerType::class, $entity);

        return $this->render('rusplayer/newRusplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createRusplayer(Request $request, $team, $season, $country)
    {
        $entity = new Rusplayer();

        $form = $this->createForm(RusplayerType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();

            $entity2 = new Playersteam();
            $entity2->setGame(0);
            $entity2->setGoal(0);
            $entity2->setPlayer($entity->getPlayer());
            $team2 = $this->entityManager->getRepository(Team::class)
                        ->findOneByTranslit($team);
            $entity2->setTeam($team2);
            $em->persist($entity2);
            $em->flush();

            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newRusplayer.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newPlayer(Menu $menu)
    {
        $entity = new Player();

        $form   = $this->createForm(PlayerType::class, $entity);
        $maxId = $this->entityManager->getRepository(Player::class)->getMaxId();

        return $this->render('rusplayer/newPlayer.html.twig', array(
            'entity' => $entity,
            'maxId' => $maxId,
            'menu' => $menu,
            'maxId' => $maxId,
            'menu' => $menu,
            'form'   => $form->createView()
        ));
    }

    public function createNewPlayer(Request $request, $team, $season, $country, $route)
    {
        $entity  = new Player();

        $form = $this->createForm(PlayerType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $entity->setInsertdate(new \DateTime());
            $em->persist($entity);
            $em->flush();
            if($country == 'russia' || $country == 'fnl') {
                $rusplayer = new Rusplayer();
                $rusplayer->setPlayer($entity);
                $em->persist($rusplayer);
                $em->flush();
            }
            $routeParams = [
              'id' => $team,
              'season' => $season
            ];
            if($route == 'championships_show'){
              $routeParams['country'] = $country;
            } elseif($route == 'eurocup_show'){
              $routeParams['turnir'] = $country;
            }
            return $this->redirect($this->generateUrl($route, $routeParams));
            $routeParams = [
              'id' => $team,
              'season' => $season
            ];
            if($route == 'championships_show'){
              $routeParams['country'] = $country;
            } elseif($route == 'eurocup_show'){
              $routeParams['turnir'] = $country;
            }
            return $this->redirect($this->generateUrl($route, $routeParams));
        }

        return $this->render('rusplayer/newPlayer.html.twig', ['entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }

    public function editNation(SessionInterface $session, $id, $season, $team, $change, $turnir)
    {
        $this->entityManager->getRepository(Shipplayer::class)
          ->updateShipplayerGoal($id, $change);
        $player = $this->entityManager->getRepository(Shipplayer::class)->find($id);

        if($turnir && strpos($turnir, "underleague-") === false){
            $player_id = $player->getPlayer()->getId();
            if($change == 'plusGame' || $change == 'minusGame')
            {
            $this->entityManager->getRepository(Player::class)
                ->updatePlayerGame($player_id, $change);
            }
            else
            {
            $this->entityManager->getRepository(Player::class)
                ->updatePlayerTotalGoal($player_id, $change, 1);
            }
        }

        $session->set('lastPlayer', $player->getPlayer()->getName());

        $response = json_encode([
            'name' => $player->getPlayer()->getName(),
            'game' => $player->getGame(),
            'goal' => $player->getGoal()
        ]);
        return new Response($response);
    }

    public function editNationCup(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Shipplayer::class)
          ->updateShipplayerGoalCup($id, $change);
        $player = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $playerName = $player->getPlayer()->getName();
        $this->entityManager->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 1);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'goal' => $player->getCup()
        ]);
        return new Response($response);
    }

    public function editNationSupercup(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Shipplayer::class)
          ->updateShipplayerGoalSupercup($id, $change);
        $player = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $playerName = $player->getPlayer()->getName();
        $player_id = $player->getPlayer()->getId();
        $this->entityManager->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 1);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'goal' => $player->getSupercup()
        ]);
        return new Response($response);
    }

    public function editNationEurocup(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Shipplayer::class)
          ->updateShipplayerGoalEurocup($id, $change);
        $player = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $playerName = $player->getPlayer()->getName();
        $player_id = $player->getPlayer()->getId();
        $this->entityManager->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 0, 1);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'goal' => $player->getEurocup()
        ]);
        return new Response($response);
    }

    public function editNationSbornie(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Shipplayer::class)
          ->updateShipplayerGoalSbornie($id, $change);
        $player = $this->entityManager->getRepository(Shipplayer::class)->find($id);
        $player_id = $player->getPlayer()->getId();
        $playerName = $player->getPlayer()->getName();
        $this->entityManager->getRepository(Player::class)
          ->updatePlayerGoal($player_id, $change, 0, 0, 0, 0, 0, 1);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'goal' => $player->getSbornie()
        ]);
        return new Response($response);
    }

    public function sessionPlayerAdd(SessionInterface $session, $id)
    {
        $session->set('lastPlayerAdd', $id);

        return new Response($id);
    }

    public function viewedPlayerAdd($id)
    {
        $this->entityManager->getRepository(Player::class)->viewedPlayer($id);

        return new Response($id);
    }

    public function newChampNation($season, $team, $flag)
    {
        ini_set('memory_limit','64M');

        $entity = new Shipplayer();
        $club = $this->entityManager->getRepository(Team::class)
          ->findOneByTranslit($team);
        $country = $club->getCountry()->getName();
        $form = $this->createForm(ShipplayerType::class, $entity, [
          'season' => $season, 'team' => $team, 'flag' => $flag, 'club' => $club,
          'country' => $country]);

        return $this->render('shiptable/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createChampNation(SessionInterface $session, Request $request, $team, $season, $country, $flag)
    {
        $entity  = new Shipplayer();

        $club = $this->entityManager->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(ShipplayerType::class, $entity, [
          'season' => $season, 'team' => $team, 'flag' => $flag, 'club' => $club,
          'country' => $country]);
        $form = $this->createForm(ShipplayerType::class, $entity, [
          'season' => $season, 'team' => $team, 'flag' => $flag, 'club' => $club,
          'country' => $country]);

        $form->handleRequest($request);

        if(!$entity->getPlayer()) {
            $selectedPlayer = $session->get('lastPlayerAdd');
            $obPlayer = $this->entityManager->getRepository(Player::class)->findOneById($selectedPlayer);
            $entity->setPlayer($obPlayer);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $id = $entity->getId();
            $player_id = $entity->getPlayer()->getId();
            $goal = $entity->getGoal();
            $game = $entity->getGame();
            $game = $entity->getGame();
            $cup = $entity->getCup();
            $supercup = $entity->getSupercup();
            $eurocup = $entity->getEurocup();
            $em->getRepository(Shipplayer::class)
               ->updateShipplayerSum($id, $goal, $cup, $supercup, $eurocup);
            
            if(strpos($country, "underleague-") === false){
                $em->getRepository(Player::class)
                    ->updatePlayerGoal($player_id, false, $goal, $cup, $supercup, $eurocup);
                $em->getRepository(Player::class)
                  ->updatePlayerGame($player_id, false, $game);
            }
            
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('shiptable/newChampNation.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function confirm($id, $type, $country)
    {
        switch($type){
          case 'Shipplayer' :
            $className = Shipplayer::class;
            break;
          case 'Cupplayer' :
            $className = Cupplayer::class;
            break;
          case 'Gamers' :
            $className = Gamers::class;
            break;
        }
        $entity = $this->entityManager->getRepository($className)->find($id);

        return $this->render('shiptable/deleteShipplayer.html.twig', array(
            'entity' => $entity,
            'country' => $country
        ));
    }

    public function delete($id, $type, $country)
    {
        $em = $this->entityManager;
        $routeParams = [];
        switch($type){
          case 'Shipplayer' :
            $className = Shipplayer::class;
            $route = 'championships_show';
            $routeParams['country'] = $country;
            break;
          case 'Cupplayer' :
            $className = Cupplayer::class;
            $route = 'cup_show';
            break;
          case 'Gamers' :
            $className = Gamers::class;
            $route = 'championships_show';
            $routeParams['country'] = 'russia';
            break;
        }

        $entity = $this->entityManager->getRepository($className)->find($id);

        $routeParams['season'] = $entity->getSeason()->getName();
        $routeParams['id'] = $entity->getTeam()->getTranslit();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl($route, $routeParams));
    }

    public function editPlayerTurnirs($season, $team, $country)
    {
      if($country == 'fnl')
      {
        $entity = new Fnlplayer();

        $editForm = $this->createForm(FnlplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
      else
      {
        $entity = new Shipplayer();

        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }


        return $this->render('rusplayer/editPlayerTurnirs.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    public function updatePlayerTurnirs(Request $request, $season, $team, $country)
    {
      $teamOb = $this->entityManager->getRepository(Team::class)
        ->findOneByTranslit($team);
      $seasonOb = $this->entityManager->getRepository(Seasons::class)
        ->findOneByName($season);
      if($country == 'fnl')
      {
        $entity = new Fnlplayer();
        $editForm = $this->createForm(FnlplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
      else
      {
        $entity = new Shipplayer();
        $editForm = $this->createForm(ShipplayerUpdateType::class, $entity,
                ['season' => $season, 'team' => $team]);
      }
        $editForm->handleRequest($request);
        $player = $editForm['player']->getData();

        if ($editForm->isValid())
        {
            $em = $this->entityManager;
            $player = $editForm["player"]->getData()->getId();
            $game= $editForm['game']->getData();
            $goal= $editForm['goal']->getData();
            if($country != 'fnl')
            {
              $cup= $editForm['cup']->getData();
              $eurocup= $editForm['eurocup']->getData();
              $supercup= $editForm['supercup']->getData();
              $em->getRepository(Shipplayer::class)->updatePlayerTurnirs($player,
                $game, $goal, $cup, $eurocup, $supercup, $seasonOb->getId(),
                $teamOb->getId());
              $em->getRepository(Player::class)
               ->updatePlayerTurnirs($player, $game, $goal, $cup, $eurocup, $supercup);
            }
            else
            {
              $em->getRepository(Fnlplayer::class)->updateFullFnlplayer($player,
                $game, $goal, $seasonOb->getId(), $teamOb->getId());
              $em->getRepository(Rusplayer::class)->updateRusplayerTotalFnl($player,
                $game, $goal);
            }
            $game= $editForm['game']->getData();
            $goal= $editForm['goal']->getData();
            if($country != 'fnl')
            {
              $cup= $editForm['cup']->getData();
              $eurocup= $editForm['eurocup']->getData();
              $supercup= $editForm['supercup']->getData();
              $em->getRepository(Shipplayer::class)->updatePlayerTurnirs($player,
                $game, $goal, $cup, $eurocup, $supercup, $seasonOb->getId(),
                $teamOb->getId());
              $em->getRepository(Player::class)
               ->updatePlayerTurnirs($player, $game, $goal, $cup, $eurocup, $supercup);
            }
            else
            {
              $em->getRepository(Fnlplayer::class)->updateFullFnlplayer($player,
                $game, $goal, $seasonOb->getId(), $teamOb->getId());
              $em->getRepository(Rusplayer::class)->updateRusplayerTotalFnl($player,
                $game, $goal);
            }
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => $country,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/editPlayerTurnirs.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            ]);
    }

    public function editFnl(SessionInterface $session, $id, $season, $team, $change)
    {
        $this->entityManager->getRepository(Fnlplayer::class)
          ->updateFnlplayer($id, $change);
        $entity = $this->entityManager->getRepository(Fnlplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $this->entityManager->getRepository(Rusplayer::class)
          ->updateRusplayerFnl($playerId, $change);
        $session->set('lastPlayer', $entity->getPlayer()->getName());
        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
        $session->set('lastPlayer', $entity->getPlayer()->getName());
        $response = json_encode([
            'name' => $entity->getPlayer()->getName(),
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function newFnl(Menu $serviceMenu, $season, $team)
    {
        ini_set('memory_limit','64M');
        
        $entity = new Fnlplayer();

        $form   = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);

        $menu = $serviceMenu->generate('fnl', $season);

        return $this->render('rusplayer/newFnl.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView()
        ));
    }

    public function createFnl(Menu $serviceMenu, Request $request, $team, $season)
    {
        $entity  = new Fnlplayer();
        $club = $this->entityManager->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(FnlType::class, $entity, ['season' => $season,
            'team' => $team]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $game = $entity->getGame();
            $em->getRepository(Rusplayer::class)
              ->updateRusplayerTotalFnl($player, $game, $goal);
            $game = $entity->getGame();
            $em->getRepository(Rusplayer::class)
              ->updateRusplayerTotalFnl($player, $game, $goal);
            return $this->redirect($this->generateUrl('championships_show', [
                'id' => $team,
                'country' => 'fnl',
                'season' => $season
                    ]));
        }

        $menu = $serviceMenu->generate('fnl', $season);

        return $this->render('rusplayer/newFnl.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function newSc($season, $team, $id)
    {
        ini_set('memory_limit','16M');

        $entity = new Supercupplayer();
        $club = $this->entityManager->getRepository(Team::class)->findOneById($team);
        $translit = $club->getTranslit();
        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $translit]);

        return $this->render('rusplayer/newSc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createSc(Request $request, $team, $season, $id)
    {
        $entity  = new Supercupplayer();

        $club = $this->entityManager->getRepository(Team::class)->findOneById($team);
        $translit = $club->getTranslit();
        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $translit]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            /*return $this->redirect($this->generateUrl('supercup_show', [
                'id' => $id,
                'country' => 'russia'
              ]));*/
        }

        return $this->render('rusplayer/newSc.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }

    public function newCup($season, $team)
    {
        ini_set('memory_limit','16M');

        $entity = new Cupplayer();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newCup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createCup(Request $request, $team, $season)
    {
        $entity  = new Cupplayer();

        $club = $this->entityManager->getRepository(Team::class)->findOneByTranslit($team);
        $year = $this->entityManager->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->entityManager;
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer()->getId();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerCup($player, $goal);
            $em->getRepository(Rusplayer::class)->updateRusplayerCup($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('cup_show', [
                'id' => $team,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newCup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editCup(SessionInterface $session, $id, $season, $team, $change)
    {
        $em = $this->entityManager;

        $em->getRepository(Cupplayer::class)->updateCupplayer($id, $change);
        $entity = $em->getRepository(Cupplayer::class)->find($id);
        $playerId = $entity->getPlayer()->getId();
        $player = $entity->getPlayer();
        $playerName = $player->getName();
        $playerName = $player->getName();
        $teamOb = $entity->getTeam();
        $gamerId = $em->getRepository(Gamers::class)->getGamerByPlayerAndTeamAndSeason($player->getId(), $teamOb->getId(), $season);
        $em->getRepository(Gamers::class)->updateGamer($gamerId, $change, true);
        $em->getRepository(Rusplayer::class)->updateRusplayer($playerId, $change, true);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $teamOb, $change);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $entity->getGame(),
            'goal' => $entity->getGoal()
        ]);
        return new Response($response);
    }

    public function editLchplayer(SessionInterface $session, $id, $season, $team, $change)
    {
      $this->entityManager->getRepository(Lchplayer::class)->updateLchplayerGoal($id, $change);
      $player = $this->entityManager->getRepository(Lchplayer::class)->find($id);
      $player_id = $player->getPlayer()->getId();

      if (strpos($change, 'Game') !== false)
      {
        $this->entityManager->getRepository(Player::class)->updatePlayerLchGame($player_id, $change);
      }
      elseif (strpos($change, 'Goal') !== false)
      {
        $this->entityManager->getRepository(Player::class)->updatePlayerLchGoal($player_id, $change);
      }

      $session->set('lastPlayer', $player->getPlayer()->getName());

      $response = json_encode([
          'name' => $player->getPlayer()->getName(),
          'game' => $player->getGame(),
          'goal' => $player->getGoal()
      ]);
      return new Response($response);
    }

    public function newLchPlayer(Menu $serviceMenu,  $season, $team, $flag)
    {
        ini_set('memory_limit','64M');

        $entity = new Lchplayer();
        $club = $this->entityManager->getRepository(Team::class)->findOneByTranslit($team);

        $form   = $this->createForm(LchplayerType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

        $menu = $serviceMenu->generateEurocup($season);

        return $this->render('eurocup/newLchPlayer.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView()
        ));
    }

    public function createLchPlayer(SessionInterface $session, Menu $serviceMenu,  Request $request, $team, $season, $flag)
    {
        $entity  = new Lchplayer();
        $em = $this->entityManager;
        $club = $em->getRepository(Team::class)->findOneByTranslit($team);
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $entity->setGame(1);
        $form = $this->createForm(LchplayerType::class, $entity, ['season' => $season,
            'team' => $team, 'flag' => $flag, 'club' => $club]);

        $form->handleRequest($request);

        if(!$entity->getPlayer()) {
            $selectedPlayer = $session->get('lastPlayerAdd');
            $obPlayer = $this->entityManager->getRepository(Player::class)->findOneById($selectedPlayer);
            $entity->setPlayer($obPlayer);
        }

        $menu = $serviceMenu->generateEurocup($season);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer()->getId();
            $game = $entity->getGame();
            $game = $entity->getGame();
            $goal = $entity->getGoal();
            $em->getRepository(Player::class)
              ->updatePlayerLch($player, $game, $goal);
            $em->getRepository(Player::class)
              ->updatePlayerLch($player, $game, $goal);
            /*$em->getRepository('SteamFbstatBundle:Rusplayer')
                    ->updateRusplayerEc($player, $goal);*/
            return $this->redirect($this->generateUrl('eurocup_show', [
                'id' => $team,
                'season' => $season,
                'menu' => $menu,
                'turnir' => 'leagueChampions'
                    ]));
        }

        return $this->render('eurocup/newLchPlayer.html.twig', array(
            'entity' => $entity,
            'menu' => $menu,
            'form'   => $form->createView(),
        ));
    }

    public function editEc(SessionInterface $session, $id, $season, $team, $turnir, $change)
    {
        $em = $this->entityManager;
        $em->getRepository(Ecplayer::class)->updateEcplayer($id, $change);
        $ecplayer = $em->getRepository(Ecplayer::class)->find($id);
        $player = $ecplayer->getPlayer();
        $club = $ecplayer->getTeam();
        $gamerId = $em->getRepository(Gamers::class)->getGamerByPlayerAndTeamAndSeason($player->getId(), $club->getId(), $season);
        $em->getRepository(Gamers::class)->updateGamer($gamerId, $change, true);
        $em->getRepository(Rusplayer::class)->updateRusplayerEcTotal($player, $change);
        $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $change);
        $playerName = $player->getName();
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $ecplayer->getGame(),
            'goal' => $ecplayer->getGoal()
        ]);
        return new Response($response);
    }

    public function editMund(SessionInterface $session, $id, $change)
    {
        $em = $this->entityManager;

        $em->getRepository(Sostav::class)->updateGamer($id, $change);
        $sostavPlayer = $em->getRepository(Sostav::class)->find($id);
        $playerName = $sostavPlayer->getPlayer()->getName();
        $session->set('lastPlayer', $playerName);

        $response = json_encode([
            'name' => $playerName,
            'game' => $sostavPlayer->getGame(),
            'goal' => $sostavPlayer->getGoal()
        ]);
        return new Response($response);
    }

    public function newEc($season, $team)
    {
        ini_set('memory_limit','16M');

        $entity = new Ecplayer();

        $form   = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        return $this->render('rusplayer/newEc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createEc(Request $request, $team, $season, $turnir)
    {
        $entity  = new Ecplayer();
        $em = $this->entityManager;
        $club = $em->getRepository(Team::class)->findOneByTranslit($team);
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $cup = $em->getRepository(Turnir::class)->findOneByAlias($turnir);
        $entity->setTeam($club);
        $entity->setSeason($year);
        $entity->setTurnir($cup);
        $form = $this->createForm(RusType::class, $entity, ['season' => $season,
            'team' => $team]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $em->getRepository(Rusplayer::class)->updateRusplayerEc($player, $goal);
            $em->getRepository(Playersteam::class)->updatePlayersteam($player, $club, $goal);
            return $this->redirect($this->generateUrl('eurocup_showTeam', [
                'id' => $team,
                'turnir' => $turnir,
                'season' => $season
                    ]));
        }

        return $this->render('rusplayer/newEc.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newSb($season)
    {
        $entity = new Sbplayer();
        $form   = $this->createForm(SbplayerType::class, $entity,
         ['season' => $season]);

        return $this->render('rusplayer/newSb.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createSb(Request $request, $season)
    {
        $entity  = new Sbplayer();
        $form = $this->createForm(SbplayerType::class, $entity, ['season' => $season]);
        $em = $this->entityManager;
        $year = $em->getRepository(Seasons::class)->findOneByName($season);
        $entity->setSeason($year);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $player = $entity->getPlayer();
            $goal = $entity->getGoal();
            $games = $em->getRepository(Sbplayer::class)
              ->getSbSum($entity->getPlayer()->getId());
            $goals = $em->getRepository(Sbplayer::class)
              ->getSbSum($entity->getPlayer()->getId(), 'goal');
            $em->getRepository(Rusplayer::class)->updateRusplayerSb($player, $goal);

            return $this->redirect($this->generateUrl('sbornieRus', [
                'season' => $season
            ]));
        }

        return $this->render('rusplayer/newSb.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
            ]);
    }
}
