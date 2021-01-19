<?php

namespace App\Controller;

use App\Entity\NationCup;
use App\Entity\Team;
use App\Entity\Shiptable;
use App\Entity\Cup;
use App\Entity\Eurocup;
use App\Entity\Seasons;
use App\Service\Props;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiTeamsController extends ApiController
{
    private $team = null;

    public function getTeam(string $code): ?Team
    {
        if(!$this->team)
        {
            $this->team = $this->getDoctrine()->getRepository(Team::class)
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
        $champTables =  $this->getDoctrine()->getRepository(Shiptable::class)
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
        $country = $team->getCountry()->getName();
        $cupSeasons = [];
        $tops = $prop->getTops();
        if($country == 'Россия'){
            $cupSeasons = $this->getDoctrine()->getRepository(Seasons::class)
                ->getSeasonsTurnirByTeam($team->getId(), 'cups');
            foreach ($cupSeasons as &$cupSeason)
            {
                $cupSeason->setSeasonCupMatches($this->getDoctrine()
                    ->getRepository(Cup::class)
                    ->findByTeamAndSeason($team->getId(), $cupSeason->getName()));
            }
        } elseif(in_array($country, $tops)) {
            $cupSeasons = $this->getDoctrine()->getRepository(Seasons::class)
                ->getSeasonsTurnirByTeam($team->getId(), 'nationCups');
            foreach ($cupSeasons as &$cupSeason)
            {
                $cupSeason->setSeasonCupMatches($this->getDoctrine()
                    ->getRepository(NationCup::class)
                    ->findByTeamAndSeason($team->getId(), $cupSeason->getName()));
            }
        }
        $arrCup = [];
        foreach ($cupSeasons as $key => $obj){
            $seasonCupMatches = $obj->getSeasonCupMatches();
            $arrCup[$key] = ['season' => $obj->getName(), 'matches' => []];
            foreach ($seasonCupMatches as $matches){
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

        $euroSeasons = $this->getDoctrine()->getRepository(Seasons::class)
            ->getSeasonsTurnirByTeam($team->getId(), 'eurocups');
        foreach ($euroSeasons as &$season)
        {
            $season->setSeasonMatches($this->getDoctrine()
                ->getRepository(Eurocup::class)
                ->findAllBySeasonAndTeam($season->getName(), $team->getId()));
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