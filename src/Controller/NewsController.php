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



        return $this->render('news/index.html.twig', [
            'bombTotal' => $bombTotal
        ]);
    }



}
