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
use App\Entity\Gamer;
use App\Entity\Fnlplayer;
use App\Entity\Shipplayer;
use App\Entity\Cupplayer;
use App\Entity\Ecplayer;
use App\Entity\Supercupplayer;
use App\Entity\Sbplayer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RusplayerController extends AbstractController
{
    public function index(Request $request, SessionInterface $session)
    {
        if ($request->getMethod() == 'POST') {

            $session->set('country', \htmlspecialchars(trim($request->query->get('country'))));
            $session->set('teams', \htmlspecialchars(trim($request->query->get('teams'))));

        }
        $page = $request->query->get('page') ? intval($request->query->get('page')) : 1;
        $sort = 'totalgame';
        $order = 'desc';
        if($request->query->get('sort'))
        {
            $arSort = explode("_", htmlspecialchars($request->query->get('sort')));
            $sort = $arSort[0];
            $order = $arSort[1];
        }
        $totalPlayers = $this->getDoctrine()->getRepository(Rusplayer::class)
                            ->countPlayers($session->get('country'), $session->get('teams'));
        $lastPage = ceil($totalPlayers / 20);
        $previousPage = $page > 1 ? $page-1 : 1;
        $nextPage = $page < $lastPage ? $page+1 : $lastPage;
        $entities = $this->getDoctrine()->getRepository(Rusplayer::class)
                        ->getPlayers(20, $sort, ($page-1)*20, $session->get('country'),
                                $session->get('teams'));
        if($session->get('teams') && $session->get('teams') != 'Команда') {
            $sort="pt.game";
        $kom = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByName($session->get('teams'));
        $id=$kom->getTranslit();
        for ($i=0, $cnt=count($entities); $i < $cnt; $i++) {
            $name[$i] = $entities[$i]->getPlayer()->getName();
            $ptgame[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                             ->getStat($name[$i], $id, 'game')[0]->getGame();
            $ptgoal[$i] = $this->getDoctrine()->getRepository(Playersteam::class)
                             ->getStat($name[$i], $id, 'goal')[0]->getGoal();

            $entities[$i]->setGameTeam($ptgame[$i]);
            $entities[$i]->setGoalTeam($ptgoal[$i]);
        }
        }
        $country = $this->getDoctrine()->getRepository(Country::class)
          ->getCountryAll();
        $teams = $this->getDoctrine()->getRepository(Shiptable::class)
          ->getTeamsRfpl();

        return $this->render('player/index.html.twig', [
            'entities' => $entities,
            'lastPage' => $lastPage,
            'previousPage' => $previousPage,
            'currentPage' => $page,
            'nextPage' => $nextPage,
            'totalPlayers' => $totalPlayers,
            'country' => $country,
            'strana' => $request->query->get('country'),
            'teams' => $teams,
            'club' => $request->query->get('teams')
            ]);
    }

    public function show($id)
    {
        $player = $this->getDoctrine()->getRepository(Player::class)
          ->findByTranslit($id);
        $rusplayer = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->findByTranslit($id);
        $lchplayer = $this->getDoctrine()->getRepository(Lchplayer::class)
          ->getLchplayer($id);
        $entities = $this->getDoctrine()->getRepository(Gamer::class)
          ->getStatPlayer($id);
        $fnlplayer = $this->getDoctrine()->getRepository(Fnlplayer::class)
          ->getStatPlayer($id);
	       $shipplayer = $this->getDoctrine()->getRepository(Shipplayer::class)
         ->getShipplayer($id);
        $cups = $this->getDoctrine()->getRepository(Cupplayer::class)
          ->getCupPlayer($id);
        $eurocups = $this->getDoctrine()->getRepository(Ecplayer::class)
          ->getEcPlayer($id);
        $supercups = $this->getDoctrine()->getRepository(Supercupplayer::class)
          ->getScPlayer($id);
        $sbplayers = $this->getDoctrine()->getRepository(Sbplayer::class)
          ->getSbPlayer($id);
        $gamesSb = $this->getDoctrine()->getRepository(Sbplayer::class)
          ->getSbSum($id);
        $goalsSb = $this->getDoctrine()->getRepository(Sbplayer::class)
          ->getSbSum($id, 'goal');

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
            'goalsSb' => $goalsSb
            ]);
    }
}
