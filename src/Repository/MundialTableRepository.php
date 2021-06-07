<?php

namespace App\Repository;

use App\Entity\MundialTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MundialTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method MundialTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method MundialTable[]    findAll()
 * @method MundialTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MundialTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MundialTable::class);
    }

    public function getTable($turnir, $season, $stadia)
    {
      return $this->createQueryBuilder('m')
              ->select('m')
              ->join('m.turnir', 't')
              ->join('m.stadia', 'st')
              ->where("t.alias = :turnir")
              ->andWhere("m.year = :season")
              ->andWhere("st.alias = :stadia")
              ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    'stadia' => $stadia
                        ])
              ->orderBy('m.score DESC, m.wins DESC, m.mz DESC, m.mp')
              ->getQuery()
              ->getResult();
    }

    public function getCountriesBySeason($year)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('c.name', 'c.translit')
                ->join('m.country', 'c')
                ->where("m.year = :year")
                ->setParameter('year', $year)
                ->groupBy('c')
                ->orderBy('c.name');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function updateTable($country, $country2, $score, $season)
    {
        $goal1 = substr($score, 0, strpos($score, '-'));
        $goal2 = substr($score, strpos($score, '-')+1);
        if ($goal1 == $goal2) {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\MundialTable', 'st')
                ->set('st.nich', 'st.nich+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.mp', 'st.mp+?2')
                ->set('st.score', 'st.score+1')
                ->where('st.country = ?3 OR st.country = ?4')
                ->andWhere('st.year = ?5')
                ->setParameter(1, $goal1)
                ->setParameter(2, $goal2)
                ->setParameter(3, $country)
                ->setParameter(4, $country2)
                ->setParameter(5, $season)
                ->getQuery();
            $qb->execute();
        } elseif ($goal1 != $goal2) {
            if ($goal1 < $goal2) {
                $winner = $country2;
                $looser = $country;
                $goalW = $goal2;
                $goalL = $goal1;
            } else {
                $winner = $country;
                $looser = $country2;
                $goalW = $goal1;
                $goalL = $goal2;
            }
        $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\MundialTable', 'st')
                ->set('st.wins', 'st.wins+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.mp', 'st.mp+?2')
                ->set('st.score', 'st.score+3')
                ->where('st.country = ?3')
                ->andWhere('st.year = ?4')
                ->setParameter(1, $goalW)
                ->setParameter(2, $goalL)
                ->setParameter(3, $winner)
                ->setParameter(4, $season)
                ->getQuery();

        $qb2 = $this->_em->createQueryBuilder()
                ->update('App\Entity\MundialTable', 'st')
                ->set('st.porazh', 'st.porazh+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.mp', 'st.mp+?2')
                ->where('st.country = ?3')
                ->andWhere('st.year = ?4')
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
