<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Rusplayer;
use App\Entity\Team;
use App\Entity\Playersteam;
use App\Entity\Shiptable;
use App\Entity\Country;
use App\Entity\Player;
use App\Entity\Lchplayer;
use App\Entity\Gamers;
use App\Entity\Fnlplayer;
use App\Entity\Shipplayer;
use App\Entity\Cupplayer;
use App\Entity\Ecplayer;
use App\Entity\Sostav;
use App\Entity\Supercupplayer;
use App\Entity\Sbplayer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class RusplayerController extends AbstractController
{
  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
      $this->entityManager = $entityManager;
  }

    public function index(Request $request, SessionInterface $session, $page, $sort,
      $order, $team, $country)
    {
        $totalPlayers = $this->entityManager->getRepository(Rusplayer::class)
                            ->countPlayers($country, $team);
        $lastPage = ceil($totalPlayers / 20);
        $previousPage = $page > 1 ? $page-1 : 1;
        $nextPage = $page < $lastPage ? $page+1 : $lastPage;

        $entities = $this->entityManager->getRepository(Rusplayer::class)
                        ->getPlayers(20, $sort, $order, ($page-1)*20, $country, $team);
        if($team && $team != 'Команда' && $team != 'all')
        {
            $sort="pt.game";
            $kom = $this->entityManager->getRepository(Team::class)
              ->findOneByTranslit($team);
            for ($i=0, $cnt=count($entities); $i < $cnt; $i++)
            {
                $name[$i] = $entities[$i]->getPlayer()->getName();
                $ptgame[$i] = $this->entityManager->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $team, 'game')[0]->getGame();
                $ptgoal[$i] = $this->entityManager->getRepository(Playersteam::class)
                                 ->getStat($name[$i], $team, 'goal')[0]->getGoal();

                $entities[$i]->setGameTeam($ptgame[$i]);
                $entities[$i]->setGoalTeam($ptgoal[$i]);
            }
        }
        $countries = $this->entityManager->getRepository(Country::class)
          ->getCountryAll();
        $teams = $this->entityManager->getRepository(Shiptable::class)
          ->getTeamsRfpl();

        return $this->render('player/index.html.twig', [
            'entities' => $entities,
            'lastPage' => $lastPage,
            'previousPage' => $previousPage,
            'currentPage' => $page,
            'nextPage' => $nextPage,
            'totalPlayers' => $totalPlayers,
            'country' => $countries,
            'strana' => $country,
            'teams' => $teams,
            'club' => isset($kom) ? $kom->getName() : ''
            ]);
    }

    public function index_all(Request $request, SessionInterface $session, $page, $sort,
      $order, $team, $country)
    {
        $totalPlayers = $this->entityManager->getRepository(Player::class)
                            ->countPlayers($country, $team);
        $lastPage = ceil($totalPlayers / 20);
        $previousPage = $page > 1 ? $page-1 : 1;
        $nextPage = $page < $lastPage ? $page+1 : $lastPage;

        $entities = $this->entityManager->getRepository(Player::class)
                        ->getPlayers(20, $sort, $order, ($page-1)*20, $country, $team);
        $countries = $this->entityManager->getRepository(Country::class)
          ->getCountryAll();

        return $this->render('player/index_all.html.twig', [
            'entities' => $entities,
            'lastPage' => $lastPage,
            'previousPage' => $previousPage,
            'currentPage' => $page,
            'nextPage' => $nextPage,
            'totalPlayers' => $totalPlayers,
            'country' => $countries,
            'strana' => $country
            ]);
    }

    public function show($id)
    {
        $items = [];
        $player = $this->entityManager->getRepository(Player::class)
          ->findOneByTranslit($id);
        $popular = $this->entityManager->getRepository(Player::class)
          ->getSeems($id, $player->getCountry()->getName());
        shuffle($popular);
        $popular = array_slice($popular, 0, 6);
        $rusplayer = $this->entityManager->getRepository(Rusplayer::class)
          ->findByTranslit($id);
        $lchplayer = $this->entityManager->getRepository(Lchplayer::class)
          ->getLchplayer($id);
        $entities = $this->entityManager->getRepository(Gamers::class)
          ->getStatPlayer($id);
        $fnlplayer = $this->entityManager->getRepository(Fnlplayer::class)
          ->getStatPlayer($id);
	       $shipplayer = $this->entityManager->getRepository(Shipplayer::class)
         ->getShipplayer($id);
        $cups = $this->entityManager->getRepository(Cupplayer::class)
          ->getCupPlayer($id);
        $eurocups = $this->entityManager->getRepository(Ecplayer::class)
          ->getEcPlayer($id);
        $mundials = $this->entityManager->getRepository(Sostav::class)
          ->getMundialPlayer($id);
        $supercups = $this->entityManager->getRepository(Supercupplayer::class)
          ->getScPlayer($id);
        $sbplayers = $this->entityManager->getRepository(Sbplayer::class)
          ->getSbPlayer($id);
        $gamesSb = $this->entityManager->getRepository(Sbplayer::class)
          ->getSbSum($id);
        $goalsSb = $this->entityManager->getRepository(Sbplayer::class)
          ->getSbSum($id, 'goal');

        $items = array_merge($entities, $cups, $eurocups, $sbplayers, $supercups,
          $fnlplayer, $shipplayer);
        uasort($items, ['App\Service\Sort', 'sortBySeason']);
        uasort($mundials, ['App\Service\Sort', 'sortBySeason']);

        return $this->render('player/show.html.twig', [
            'entities' => $entities,
            'cups' => $cups,
            'eurocups' => $eurocups,
            'supercups' => $supercups,
            'sbplayers' => $sbplayers,
            'player' => $player,
            'shipplayer' => $shipplayer,
            'lchplayer' => $lchplayer,
            'rusplayer' => $rusplayer,
            'fnlplayer' => $fnlplayer,
            'gamesSb' => $gamesSb,
            'goalsSb' => $goalsSb,
            'mundials' => $mundials,
            'items' => $items,
            'popular' => $popular
        ]);
    }

    public function search()
    {
        $em = $this->entityManager->getManager();

        $q = htmlspecialchars($_GET['q']);
        $arQuery = explode(" ", $q);
        $players = false;
        if(strlen($q) > 1){
            $players = $em->getRepository(Player::class)->searchPlayers($arQuery);
        }
        if(!$players || count($players) != 1){
            return $this->render('rusplayer/search.html.twig', [
                'players' => $players,
                'query' => $q
                ]);
        } else {
            $id = $players[0]->getTranslit();
            $player = $em->getRepository(Player::class)->findByTranslit($id);
            $rusplayer = $em->getRepository(Rusplayer::class)->findByTranslit($id);
            $lchplayer = $em->getRepository(Lchplayer::class)->getLchplayer($id);
            $entities = $em->getRepository(Gamers::class)->getStatPlayer($id);
            $fnlplayer = $em->getRepository(Fnlplayer::class)->getStatPlayer($id);
            $shipplayer = $em->getRepository(Shipplayer::class)->getShipplayer($id);
            $cups = $em->getRepository(Cupplayer::class)->getCupPlayer($id);
            $eurocups = $em->getRepository(Ecplayer::class)->getEcPlayer($id);
            $supercups = $em->getRepository(Supercupplayer::class)->getScPlayer($id);
            $sbplayers = $em->getRepository(Sbplayer::class)->getSbPlayer($id);
            $gamesSb = $em->getRepository(Sbplayer::class)->getSbSum($id);
            $goalsSb = $em->getRepository(Sbplayer::class)->getSbSum($id, 'goal');

            return $this->render('rusplayer/show.html.twig', [
                'entities' => $entities,
                'cups' => $cups,
                'eurocups' => $eurocups,
                'supercups' => $supercups,
                'sbplayers' => $sbplayers,
                'player' => $player,
                'shipplayer' => $shipplayer,
                'lchplayer' => $lchplayer,
                'rusplayer' => $rusplayer,
                'fnlplayer' => $fnlplayer,
                'gamesSb' => $gamesSb,
                'goalsSb' => $goalsSb
                ]);
        }
    }
}
