<?php

namespace App\Repository;

use App\Entity\NhlTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlTable[]    findAll()
 * @method NhlTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlTable::class);
    }

    public function getSeasons()
    {
        return $this->createQueryBuilder('st')
                ->select('st','s')
                ->join('st.team', 't')
                ->join('st.season', 's')
                ->groupBy('s')
                ->orderBy('s.name')
                ->getQuery()
                ->getResult()
                ;
    }

    public function updateNhltable($team, $team2, $goal1, $goal2, $season)
    {
        if ($goal1 == $goal2)
        {
            $qb = $this->_em->createQueryBuilder('NhlTable', 'st')
                ->update('App\Entity\NhlTable', 'st')
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
            $qb = $this->_em->createQueryBuilder('NhlTable', 'st')
                    ->update('App\Entity\NhlTable', 'st')
                    ->set('st.wins', 'st.wins+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->set('st.score', 'st.score+2')
                    ->where('st.team = ?3')
                    ->andWhere('st.season = ?4')
                    ->setParameter(1, $goalW)
                    ->setParameter(2, $goalL)
                    ->setParameter(3, $winner)
                    ->setParameter(4, $season)
                    ->getQuery();

            $qb2 = $this->_em->createQueryBuilder('NhlTable', 'st')
                    ->update('App\Entity\NhlTable', 'st')
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

        public function getTable($season)
        {
            return $this->createQueryBuilder('st')
                ->select('st', 't')
                ->join('st.team', 't')
                ->join('st.season', 's')
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

        public function getTeams($season)
        {
          return $this->createQueryBuilder('st')
                  ->select('t.id', 't.name', 't.translit', 't.image', 't.image2')
                  ->join('st.team', 't')
                  ->join('st.season', 's')
                  ->andWhere("s.name = :season")
                  ->setParameter('season', $season)
                  ->orderBy('t.name')
                  ->getQuery()
                  ->getResult()
                  ;
        }

}
