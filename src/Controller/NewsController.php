<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Shipplayer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{

    /**
     * Lists all News entities.
     *
     */
    public function index()
    {
        $bombTotal = $this->getDoctrine()->getRepository(Shipplayer::class)
          ->getBombSum('2018-19');
        $currentMatches = $this->getDoctrine()->getRepository(Rfplmatch::class)
            ->getNewMatches();


        $yesterdayMatches = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getYesterdayMatches();
        $tomorrowMatches = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getTomorrowMatches();
        $currentMundMatches = $em->getRepository('SteamFbstatBundle:Mundial')->getNewMatches();
        $yesterdayMundMatches = $em->getRepository('SteamFbstatBundle:Mundial')
                ->getYesterdayMatches();
        $tomorrowMundMatches = $em->getRepository('SteamFbstatBundle:Mundial')->getTomorrowMatches();
        $curcup = $em->getRepository('SteamFbstatBundle:Cup')->getNewMatches();
        $yescup = $em->getRepository('SteamFbstatBundle:Cup')->getYesterdayMatches();
        $tomcup = $em->getRepository('SteamFbstatBundle:Cup')->getTomorrowMatches();
        $cursupercup = $em->getRepository('SteamFbstatBundle:NationSupercup')->getNewMatches();
        $yessupercup = $em->getRepository('SteamFbstatBundle:NationSupercup')->getYesterdayMatches();
        $tomsupercup = $em->getRepository('SteamFbstatBundle:NationSupercup')->getTomorrowMatches();
        $currentEcMatches = $em->getRepository('SteamFbstatBundle:Eurocup')->getNewMatches();
        $yesterdayEcMatches = $em->getRepository('SteamFbstatBundle:Eurocup')
                ->getYesterdayMatches();
        $tomorrowEcMatches = $em->getRepository('SteamFbstatBundle:Eurocup')->getTomorrowMatches();
        $currentMatches5 = $em->getRepository('SteamFbstatBundle:Rfplmatch')->getNewMatches5();
        $yesterdayMatches5 = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getYesterdayMatches5();
        $tomorrowMatches5 = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getTomorrowMatches5();
        $currentMatches1 = $em->getRepository('SteamFbstatBundle:Rfplmatch')->getNewMatches1();
        $yesterdayMatches1 = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getYesterdayMatches1();
        $tomorrowMatches1 = $em->getRepository('SteamFbstatBundle:Rfplmatch')
                ->getTomorrowMatches1();
        $curmatch = array_merge($currentMatches, $currentEcMatches, $currentMatches5,
                $currentMatches1, $currentMundMatches, $curcup, $cursupercup);
        $yestmatch = array_merge($yesterdayMatches, $yesterdayEcMatches, $yesterdayMatches5,
                $yesterdayMatches1, $yesterdayMundMatches, $yescup, $yessupercup);
        $tommatch = array_merge($tomorrowMatches, $tomorrowEcMatches, $tomorrowMatches5,
                $tomorrowMatches1, $tomorrowMundMatches, $tomcup, $tomsupercup);

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
        $birthdays = $em->getRepository('SteamFbstatBundle:Player')->getBirthdayPlayer(date('m-d'));
        $count=count($birthdays);
        for ($i=0; $i < $count; $i++) {
        $age[$i] = $em->getRepository('SteamFbstatBundle:Player')->getAge($birthdays[$i]['name']);
        $birthdays[$i][] =  $age[$i];
        }
        $lastPlayers = $em->getRepository('SteamFbstatBundle:Player')->getLastPlayer();
        $topMatchesRus = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopPlayers(20, 'game');
        $topMatchesRusCurr = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopPlayersCurr(20, 'game', '2018-19');
        $topGoalsRus = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopPlayers(20, 'goal');
        $topGoalsRusCurr = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopPlayersCurr(21, 'goal', '2018-19');
        $topGoalkeepers = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopGoalkeepers(20);
        $topGoalkeepersCurr = $em->getRepository('SteamFbstatBundle:Rusplayer')->getTopGoalkeepersCurr(20, '2018-19');

        return $this->render('SteamFbstatBundle:News:index.html.twig', [
            'yestmatch' => $yestmatch,
            'tommatch' => $tommatch,
            'curmatch' => $curmatch,
            'birthdays' => $birthdays,
            'bombTotal' => $bombTotal,
            'lastPlayers' => $lastPlayers,
            'topMatchesRus' => $topMatchesRus,
            'topMatchesRusCurr' => $topMatchesRusCurr,
            'topGoalsRus' => $topGoalsRus,
            'topGoalsRusCurr' => $topGoalsRusCurr,
            'topGoalkeepers' => $topGoalkeepers,
            'topGoalkeepersCurr' => $topGoalkeepersCurr
        ]);
    }



}
