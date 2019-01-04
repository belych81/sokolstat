<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Rfplmatch;
use App\Entity\Eurocup;
use App\Entity\NationSupercup;
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
        $yescup = $this->getDoctrine()->getRepository(Cup::class)
            ->getYesterdayMatches();
        $yessupercup = $this->getDoctrine()->getRepository(NationSupercup::class)
            ->getYesterdayMatches();
        $yesterdayEcMatches = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getYesterdayMatches();
        $yesterdayMatches5 = $this->getDoctrine()->getRepository(Tour::class)
            ->getYesterdayMatches5();
        $yestmatch = array_merge($yesterdayMatches, $yesterdayEcMatches,
          $yesterdayMatches5, $yesterdayMatches1, $yesterdayMundMatches, $yescup,
          $yessupercup);


        return $this->render('news/index.html.twig', [
            'yestmatch' => $yestmatch,
            'bombTotal' => $bombTotal
        ]);
    }



}
