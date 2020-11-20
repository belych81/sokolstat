<?php

namespace App\Repository;

use App\Entity\NhlTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlTeam[]    findAll()
 * @method NhlTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlTeam::class);
    }

    public function queryTeamsForSeason() {

        return $query = $this->createQueryBuilder('t')
                ->orderBy('t.name');
    }

    public function updateSvod($team, $team2, $goal1, $goal2)
    {
        if ($goal1 == $goal2)
        {
            $qb = $this->_em->createQueryBuilder('NhlTeam', 'st')
                ->update('App\Entity\NhlTeam', 'st')
                ->set('st.nich', 'st.nich+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.gamereg', 'st.gamereg+1')
                ->set('st.game', 'st.game+1')
                ->set('st.mp', 'st.mp+?2')
                ->set('st.score', 'st.score+1')
                ->where('st.id = ?3 OR st.id = ?4')
                ->setParameter(1, $goal1)
                ->setParameter(2, $goal2)
                ->setParameter(3, $team)
                ->setParameter(4, $team2)
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
            $qb = $this->_em->createQueryBuilder('NhlTeam', 'st')
                    ->update('App\Entity\NhlTeam', 'st')
                    ->set('st.wins', 'st.wins+1')
                    ->set('st.gamereg', 'st.gamereg+1')
                    ->set('st.game', 'st.game+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->set('st.score', 'st.score+3')
                    ->where('st.id = ?3')
                    ->setParameter(1, $goalW)
                    ->setParameter(2, $goalL)
                    ->setParameter(3, $winner)
                    ->getQuery();

            $qb2 = $this->_em->createQueryBuilder('NhlTeam', 'st')
                    ->update('App\Entity\NhlTeam', 'st')
                    ->set('st.porazh', 'st.porazh+1')
                    ->set('st.gamereg', 'st.gamereg+1')
                    ->set('st.game', 'st.game+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->where('st.id = ?3')
                    ->setParameter(1, $goalL)
                    ->setParameter(2, $goalW)
                    ->setParameter(3, $looser)
                    ->getQuery();

            $qb->execute();
            $qb2->execute();
        }

    }
}
