<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Player;
use App\Entity\NhlPlayer;
use App\Entity\Rusplayer;
use App\Entity\Cup;
use App\Entity\Team;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Entity\NationSupercup;
use App\Entity\UefaSupercup;
use App\Entity\NationCup;
use App\Entity\Shipplayer;
use App\Entity\Shiptable;
use App\Entity\RusSupercup;
use App\Service\Props;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    public function index(Props $props)
    {
        $bombTotal = $this->getDoctrine()->getRepository(Shipplayer::class)
          ->getBombSum($props->getLastSeason());
        $currentMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
            ->getCurMatches();
        $curcup = $this->getDoctrine()->getRepository(Cup::class)
            ->getCurMatches();
        $curRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
            ->getCurMatches();
        $cursupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
            ->getCurMatches();
        $curUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
            ->getCurMatches();
        $curNcup = $this->getDoctrine()->getRepository(NationCup::class)
            ->getCurMatches();
        $curEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getCurMatches();
        $curMatches5 = $this->getDoctrine()->getRepository(Tour::class)
            ->getCurMatches();
        $curmatch = array_merge($currentMatches, $curEcMatches,
          $curMatches5, $curRscMatches, $curcup,
          $cursupercup, $curNcup, $curUsupercup);
        $tomMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
            ->getTomMatches();
        $tomcup = $this->getDoctrine()->getRepository(Cup::class)
            ->getTomMatches();
        $tomRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
            ->getTomMatches();
        $tomsupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
            ->getTomMatches();
        $tomUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
            ->getTomMatches();
        $tomNcup = $this->getDoctrine()->getRepository(NationCup::class)
            ->getTomMatches();
        $tomEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getTomMatches();
        $tomMatches5 = $this->getDoctrine()->getRepository(Tour::class)
            ->getTomMatches();
        $tommatch = array_merge($tomMatches, $tomEcMatches,
          $tomMatches5, $tomRscMatches, $tomcup,
          $tomsupercup, $tomNcup, $tomUsupercup);
        $yescup = $this->getDoctrine()->getRepository(Cup::class)
            ->getYesterdayMatches();
        $yesterdayMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
                ->getYesterdayMatches();
        $yesterdayRscMatches = $this->getDoctrine()->getRepository(RusSupercup::class)
                ->getYesterdayMatches();
        $yessupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
            ->getYesterdayMatches();
        $yesUsupercup = $this->getDoctrine()->getRepository(UefaSupercup::class)
            ->getYesterdayMatches();
        $yesNcup = $this->getDoctrine()->getRepository(NationCup::class)
            ->getYesterdayMatches();
        $yesterdayEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getYesterdayMatches();
        $yesterdayMatches5 = $this->getDoctrine()->getRepository(Tour::class)
            ->getYesterdayMatches5();
        $yestmatch = array_merge($yesterdayMatches, $yesterdayEcMatches,
          $yesterdayMatches5, $yesterdayRscMatches, $yescup,
          $yessupercup, $yesNcup, $yesUsupercup);
        $mySort = function($f1,$f2)
                {
                   if($f1->getData() < $f2->getData()){
                       return -1;
                   }
                   elseif($f1->getData() > $f2->getData()) {
                       return 1;
                   }
                   else {
                       return 0;
                   }
                };
        uasort($tommatch, $mySort);
        uasort($curmatch, $mySort);
        uasort($yestmatch, $mySort);

        $birthdays = $this->getDoctrine()->getRepository(Player::class)
          ->getBirthdayPlayer(date('m-d'));
        $count=count($birthdays);
        for ($i=0; $i < $count; $i++) {
        $age[$i] = $this->getDoctrine()->getRepository(Player::class)
          ->getAge($birthdays[$i]['name']);
        $birthdays[$i][] =  $age[$i];
        }

        $lastPlayers = $this->getDoctrine()->getRepository(Player::class)
          ->getLastPlayer();
        $topMatchesRus = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopPlayers(20, 'game');
        $topMatchesRusCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopPlayersCurr(20, 'game', $props->getLastSeason());
        $topGoalsRus = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopPlayers(20, 'goal');
        $topGoalsRusCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopPlayersCurr(20, 'goal', $props->getLastSeason());
        $topGoalkeepers = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopGoalkeepers(20);
        $topGoalkeepersCurr = $this->getDoctrine()->getRepository(Rusplayer::class)
          ->getTopGoalkeepersCurr(20, $props->getLastSeason());

        return $this->render('news/index.html.twig', [
            'yestmatch' => $yestmatch,
            'curmatch' => $curmatch,
            'tommatch' => $tommatch,
            'bombTotal' => $bombTotal,
            'birthdays' => $birthdays,
            'lastPlayers' => $lastPlayers,
            'topMatchesRus' => $topMatchesRus,
            'topMatchesRusCurr' => $topMatchesRusCurr,
            'topGoalsRus' => $topGoalsRus,
            'topGoalsRusCurr' => $topGoalsRusCurr,
            'topGoalkeepers' => $topGoalkeepers,
            'topGoalkeepersCurr' => $topGoalkeepersCurr
        ]);
    }

    public function newspaper()
    {
      $today = date('j.m.Y');
      $fromDate = new \DateTime('now');
      $fromDate->setTime(0, 0, 0);
      $fromDate->modify('-28 days');
      $em = $this->getDoctrine();
      $rfplMatch = $em->getRepository(Rfplmatch::class)->findByLastYear($fromDate);
      $matches = $this->getDoctrine()->getRepository(Tour::class)
        ->findByLastYear($fromDate);
      foreach ($matches as &$match) {
        $match->getTeam()->setName(
          mb_convert_case($match->getTeam()->getName(), MB_CASE_TITLE, "UTF-8")
        );
        $match->getTeam2()->setName(
          mb_convert_case($match->getTeam2()->getName(), MB_CASE_TITLE, "UTF-8")
        );
      }
      $tours = [];
      foreach ($matches as $match) {
        $country = $match->getCountry()->getName();
        $tour = $match->getTour();
        $tours[$country]['tour'][$tour][] = $match;
      }
      $rfplTours = [];
      foreach ($rfplMatch as $value) {
        $tour = $value->getTour();
        if(!in_array($tour, $rfplTours))
        {
          $rfplTours[] = $tour;
        }
      }

      $entities = $this->getDoctrine()->getRepository(Shiptable::class)
              ->getTableAll('2019-20');
      foreach ($entities as $ent) {
        $tours[$ent->getCountry()->getName()]['table'][] = $ent;
      }

        $bombs = $this->getDoctrine()->getRepository(Shipplayer::class)
          ->getBomb5All('2019-20');
      
      return $this->render('news/newspaper.html.twig', [
        'rfplTours' => $rfplTours,
        'rfplMatch' => $rfplMatch,
        'tours' => $tours,
        'today' => $today
      ]);
    }

    public function soglasie()
    {
        return $this->render('news/soglasie.html.twig', []);
    }

    public function search(Request $request)
    {
        $query = htmlspecialchars($request->request->get('query'));
        $arQuery = explode(" ", $query);
        $em = $this->getDoctrine()->getManager();

        $responsePlayer = $em->getRepository(Player::class)->searchPlayers($arQuery);
        $responseNhlPlayer = $em->getRepository(NhlPlayer::class)->searchPlayers($arQuery);
        $responseTeam = $em->getRepository(Team::class)->searchTeams($arQuery);
        $player = [];
        foreach($responsePlayer as $val){
            $player['player/'.$val->getTranslit().'/'] = $val->getName();
        }
        foreach($responseNhlPlayer as $val){
            $player['nhl/player/'.$val->getTranslit().'/'] = $val->getName();
        }
        $team = [];
        foreach($responseTeam as $val){
            $team['team/'.$val->getTranslit()] = $val->getName();
        }
        return new JsonResponse(array_merge($player, $team));
    }

}
