<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Team;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\Eurocup;
use App\Entity\Seasons;
use App\Service\ResizeImage;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    public function index()
    {
        $entities = $this->getDoctrine()->getRepository(Team::class)
                ->getTeams();
        $letters = [];
        foreach ($entities as $key => $value) {
          $team = $value->getName();
          $letter = \mb_substr($team, 0, 1);
          if(!in_array($letter, $letters)){
            $letters[] = $letter;
          }
        }
        return $this->render('team/index.html.twig', [
            'entities' => $entities,
            'letters' => $letters
        ]);
    }

    public function show(ResizeImage $resize, $code)
    {
        $team = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($code);

        if($img = $team->getImage()){
          $team->setImage($resize->ResizeImageGet($img, ['width' => 270, 'height' => 270]));
        }
        return $this->render('team/show.html.twig', [
            'team' => $team
        ]);
    }

    public function getByLetter($letter)
    {
      $entities = $this->getDoctrine()->getRepository(Team::class)
              ->getTeamsByLetter($letter);
        $teams = [];
        foreach ($entities as $key => $value) {
          $teams[] = [$value->getName(), $value->getTranslit()];
        }
        $response = json_encode([
            'teams' => $teams
        ]);
        return new Response($response);
    }

}
