<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\Team;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\Eurocup;
use App\Entity\Seasons;

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

    public function show($code)
    {
        $team = $this->getDoctrine()->getRepository(Team::class)
          ->findOneByTranslit($code);
        $country = $team->getCountry()->getName();
        $champTable =  $this->getDoctrine()->getRepository(Shiptable::class)
            ->getShiptablesByTeam($team->getId());
        $cup = [];
        $eurocup = [];
        if($country == 'Россия'){
          $cup = $this->getDoctrine()->getRepository(Cup::class)
              ->getCupByTeam($team->getId());
        }
        $eurocup = $this->getDoctrine()->getRepository(Eurocup::class)
            ->getEurocupByTeam($team->getId());

        $euroSeasons = $this->getDoctrine()->getRepository(Seasons::class)
          ->getSeasonsEurocupByTeam($team->getId());
        foreach ($euroSeasons as &$season)
        {
          $season->setSeasonMatches($this->getDoctrine()
            ->getRepository(Eurocup::class)
            ->findAllBySeasonAndTeam($season->getName(), $team->getId()));
        }
        $cupSeasons = $this->getDoctrine()->getRepository(Seasons::class)
          ->getSeasonsCupByTeam($team->getId());
        foreach ($cupSeasons as &$cupSeason)
        {
          $cupSeason->setSeasonCupMatches($this->getDoctrine()
            ->getRepository(Cup::class)
            ->findByTeamAndSeason($team->getId(), $cupSeason->getName()));
        }

        return $this->render('team/show.html.twig', [
            'team' => $team,
            'champTable' => $champTable,
            'cups' => $cup,
            'eurocups' => $eurocup,
            'euroSeasons' => $euroSeasons,
            'cupSeasons' => $cupSeasons
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
