<?php

namespace App\Repository;

use App\Entity\Shiptable;
use App\Service\Props;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shiptable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shiptable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shiptable[]    findAll()
 * @method Shiptable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShiptableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shiptable::class);
    }

    public function translateCountry($country, Props $props)
    {
      $arCountries = array_merge($props->getTops(), $props->getNoTops());
      $translate = $props->getTranslateCountry();

      if($country == 'uefa'){
        return [
            'country' => '',
            'rusCountry' => 'УЕФА'
          ];
      }
      return [
                'country' => $arCountries[$country],
                'rusCountry' => $translate[$country]
              ];
    }

    public function getTable($country, $season)
    {
        return $this->createQueryBuilder('st')
            ->select('st', 't')
            ->join('st.team', 't')
            ->join('st.season', 's')
            ->join('st.country', 'c')
            ->where('c.name = :country')
            ->andWhere('s.name = :season')
            ->setParameter('country', $country)
            ->setParameter('season', $season)
            ->orderBy('st.score DESC, st.wins DESC, st.mz DESC, st.mp')
            ->getQuery()
            ->getResult();
    }

    public function getTableAll($season)
    {
        return $this->createQueryBuilder('st')
            ->select('st', 't')
            ->join('st.team', 't')
            ->join('st.season', 's')
            ->join('st.country', 'c')
            ->andWhere('s.name = :season')
            ->setParameter('season', $season)
            ->orderBy('st.score DESC, st.wins DESC, st.mz DESC, st.mp')
            ->getQuery()
            ->getResult();
    }

    public function findByTeamAndSeason($teamId, $season)
    {
        return $this->createQueryBuilder('st')
            ->select('st.id')
            ->join('st.season', 's')
            ->where('st.team = :team')
            ->andWhere('s.name = :season')
            ->setParameter('team', $teamId)
            ->setParameter('season', $season)
            ->getQuery()
            ->getResult();
    }

    public function getShiptableByTeam($teamId, $season)
    {
        return $this->createQueryBuilder('st')
            ->join('st.season', 's')
            ->where('st.team = :team')
            ->andWhere('s.name = :season')
            ->setParameter('team', $teamId)
            ->setParameter('season', $season)
            ->getQuery()
            ->getResult();
    }

    public function getShiptablesByTeam($teamId)
    {
        return $this->createQueryBuilder('st')
            ->join('st.season', 's')
            ->where('st.team = :team')
            ->setParameter('team', $teamId)
            ->orderBy('s.name', 'asc')
            ->getQuery()
            ->getResult();
    }

    public function getSeasons($country, $team = null)
    {
        $query = $this->createQueryBuilder('st')
                ->select('DISTINCT s.name')
                ->join('st.team', 't')
                ->join('st.season', 's')
                ->join('st.country', 'c')
                ->where("c.name = :country")
                ->setParameter('country', $country);

        if($team){
          $query->andWhere("t.translit = :team")
                ->setParameter('team', $team);
        }
        return $query->orderBy('s.name')
                     ->getQuery()
                     ->getResult();
    }

    public function getTeams($season, $country, $arTeams = [])
    {
      $qb = $this->createQueryBuilder('st')
              ->select('t.id', 't.name', 't.translit', 't.image', 't.image2')
              ->join('st.team', 't')
              ->join('st.season', 's')
              ->join('st.country', 'c')
              ->where("c.name = :country")
              ->setParameter('country', $country)
              ->andWhere("s.name = :season")
              ->setParameter('season', $season);
      if(!empty($arTeams)){
        $qb->andWhere("t.translit IN (:teams)")
            ->setParameter('teams', $arTeams);
      }
              
      return $qb->orderBy('t.name')
                ->getQuery()
                ->getResult()
              ;
    }

    public function getTeamsRfpl($all = false)
    {
        $qb = $this->createQueryBuilder('st')
                ->select('distinct t.name, t.translit')
                ->join('st.team', 't')
                ->join('st.country', 'c');

        if(!$all){
            $qb->where("c.name = :country")
                ->setParameters([
                'country' => 'Россия',
                ]);
        }
                
        return $qb->orderBy('t.name')
                ->getQuery()
                ->getResult();
    }

    public function updateShiptable($team, $team2, $goal1, $goal2, $season)
    {
        if ($goal1 == $goal2)
        {
            $qb = $this->_em->createQueryBuilder('Shiptable', 'st')
                ->update('App\Entity\Shiptable', 'st')
                ->update('App\Entity\Shiptable', 'st')
                ->set('st.nich', 'st.nich+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.mp', 'st.mp+?2')
                ->set('st.score', 'st.score+1')
                ->where('st.team = ?3 OR st.team = ?4')
                ->andWhere('st.season = ?5')
                ->setParameter(1, $goal1)
                ->setParameter(2, $goal2)
                ->setParameter(3, $team)
                ->setParameter(4, $team2)
                ->setParameter(5, $season)
                ->getQuery();
            $qb->execute();
        }
        elseif ($goal1 != $goal2)
        {
            if ($goal1 < $goal2)
            {
                $winner = $team2;
                $looser = $team;
                $goalW = $goal2;
                $goalL = $goal1;
            }
            else
            {
                $winner = $team;
                $looser = $team2;
                $goalW = $goal1;
                $goalL = $goal2;
            }
            $qb = $this->_em->createQueryBuilder('Shiptable', 'st')
                    ->update('App\Entity\Shiptable', 'st')
                    ->set('st.wins', 'st.wins+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->set('st.score', 'st.score+3')
                    ->where('st.team = ?3')
                    ->andWhere('st.season = ?4')
                    ->setParameter(1, $goalW)
                    ->setParameter(2, $goalL)
                    ->setParameter(3, $winner)
                    ->setParameter(4, $season)
                    ->getQuery();

            $qb2 = $this->_em->createQueryBuilder('Shiptable', 'st')
                    ->update('App\Entity\Shiptable', 'st')
                    ->set('st.porazh', 'st.porazh+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->where('st.team = ?3')
                    ->andWhere('st.season = ?4')
                    ->setParameter(1, $goalL)
                    ->setParameter(2, $goalW)
                    ->setParameter(3, $looser)
                    ->setParameter(4, $season)
                    ->getQuery();

            $qb->execute();
            $qb2->execute();
        }

    }
}
