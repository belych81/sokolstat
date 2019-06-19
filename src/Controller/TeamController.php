<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Team;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    public function index()
    {
        $entities = $this->getDoctrine()->getRepository(Team::class)
                ->getTeams();

        return $this->render('team/index.html.twig', [
            'entities' => $entities
        ]);
    }

}
