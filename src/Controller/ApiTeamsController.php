<?php

namespace App\Controller;

use App\Entity\NationCup;
use App\Entity\Team;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\Game;
use App\Entity\Seasons;
use App\Service\Props;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ApiTeamsController extends ApiController
{
    private $team = null;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTeam(string $code): ?Team
    {
        if(!$this->team)
        {
            $this->team = $this->entityManager->getRepository(Team::class)
                ->findOneByTranslit($code);
        }
        return $this->team;
    }
    /**
     * @Route("/api/team/champ/{code}", methods="GET")
     */
    public function getChamp(string $code)
    {
        $team = $this->getTeam($code);
        $champTables =  $this->entityManager->getRepository(Shiptable::class)
            ->getShiptablesByTeam($team->getId());
        $arrChamp = [];
        foreach ($champTables as $obj){
            $arrChamp[] = [
                'season' => $obj->getSeason()->getName(),
                'wins' => $obj->getWins(),
                'nich' => $obj->getNich(),
                'porazh' => $obj->getPorazh(),
                'mz' => $obj->getMz(),
                'mp' => $obj->getMp(),
                'score' => $obj->getScore()

            ];
        }
        return $this->respond($arrChamp);
    }

    /**
     * @Route("/api/team/cup/{code}", methods="GET")
     */
    public function getCup(Props $prop, $code)
    {
        $team = $this->getTeam($code);
        $country = $team->getCountry()->getTranslit();
        $cupSeasons = [];
        $tops = $prop->getTops();
        $euroSeasons = $this->entityManager->getRepository(Seasons::class)
            ->getSeasonsTurnirByTeam($team->getId(), $country . '-cup');
 
        foreach ($euroSeasons as &$season)
        {
            $season->setSeasonMatches($this->entityManager
                ->getRepository(Game::class)
                ->findByTeamAndSeason($team, $season->getName(), $country . '-cup'));
        }

        $arrCup = [];
        foreach ($euroSeasons as $key => $obj){
            $seasonMatches = $obj->getSeasonMatches();
            $arrCup[$key] = ['season' => $obj->getName(), 'matches' => []];
            foreach ($seasonMatches as $matches){
                $arrCup[$key]['matches'][] = [
                    'data' => $matches->getData()->format("d.m"),
                    'stadia' => $matches->getStadia()->getName(),
                    'team' => $matches->getTeam()->getName(),
                    'team2' => $matches->getTeam2()->getName(),
                    'bomb' => $matches->getBomb(),
                    'score' => $matches->getScore()
                ];
            }
        }

        return $this->respond($arrCup);
    }

    /**
     * @Route("/api/team/eurocup/{code}", methods="GET")
     */
    public function getEurocup($code)
    {
        $team = $this->getTeam($code);

        $euroSeasons = $this->entityManager->getRepository(Seasons::class)
            ->getSeasonsTurnirByTeam($team->getId(), ['leagueChampions', 'leagueEuropa']);
 
        foreach ($euroSeasons as &$season)
        {
            $season->setSeasonMatches($this->entityManager
                ->getRepository(Game::class)
                ->findByTeamAndSeason($team, $season->getName(), ['leagueChampions', 'leagueEuropa']));
        }

        $arrEurocup = [];
        foreach ($euroSeasons as $key => $obj){
            $seasonMatches = $obj->getSeasonMatches();
            $arrEurocup[$key] = ['season' => $obj->getName(), 'matches' => []];
            foreach ($seasonMatches as $matches){
                $arrEurocup[$key]['matches'][] = [
                    'data' => $matches->getData()->format("d.m"),
                    'stadia' => $matches->getStadia()->getName(),
                    'turnir' => $matches->getTurnir()->getName(),
                    'team' => $matches->getTeam()->getName(),
                    'team2' => $matches->getTeam2()->getName(),
                    'bomb' => $matches->getBomb(),
                    'score' => $matches->getScore()
                ];
            }
        }
        return $this->respond($arrEurocup);
    }
}