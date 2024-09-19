<?php

namespace App\Repository;

use App\Entity\Ectable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ectable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ectable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ectable[]    findAll()
 * @method Ectable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EctableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ectable::class);
    }

    public function getEcTable($turnir, $season, $stadia)
    {
      return $this->createQueryBuilder('et')
              ->select('et')
              ->join('et.turnir', 't')
              ->join('et.season', 's')
              ->join('et.stadia', 'st')
              ->where("t.alias = :turnir")
              ->andWhere("s.name = :season")
              ->andWhere("st.alias = :stadia")
              ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    'stadia' => $stadia
                        ])
              ->orderBy('et.score DESC, et.wins DESC, et.mz DESC, et.mp')
              ->getQuery()
              ->getResult();
    }

    public function getLchTeams($season)
    {
      return $this->createQueryBuilder('et')
              ->select('et', 't', 's')
              ->join('et.turnir', 'tr')
              ->join('et.season', 's')
              ->join('et.team', 't')
              ->where("tr.alias = :turnir")
              ->andWhere("s.name = :season")
              ->setParameter('turnir', 'leagueChampions')
              ->setParameter('season', $season)
              ->orderBy('t.name')
              ->getQuery()
              ->getResult();
    }

    public function getStadiaByTeamAndSeason($season, $id)
    {
      return $this->createQueryBuilder('et')
              ->select('st.alias', 'st.name')
              ->join('et.season', 's')
              ->join('et.stadia', 'st')
              ->join('et.team', 't')
              ->where("t.translit = :team")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->setParameter('team', $id)
              ->orderBy('t.name')
              ->getQuery()
              ->getSingleResult();
    }

    public function updateEctable($team, $team2, $score, $season)
    {
        $goal1 = substr($score, 0, strpos($score, '-'));
        $goal2 = substr($score, strpos($score, '-')+1);
        if ($goal1 == $goal2) {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Ectable', 'st')
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
        } elseif ($goal1 != $goal2) {
            if ($goal1 < $goal2) {
                $winner = $team2;
                $looser = $team;
                $goalW = $goal2;
                $goalL = $goal1;
            } else {
                $winner = $team;
                $looser = $team2;
                $goalW = $goal1;
                $goalL = $goal2;
            }
        $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Ectable', 'st')
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

        $qb2 = $this->_em->createQueryBuilder()
                ->update('App\Entity\Ectable', 'st')
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
