<?php

namespace App\Repository;

use App\Entity\Mundial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Mundial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mundial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mundial[]    findAll()
 * @method Mundial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MundialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mundial::class);
    }

    public function getSeasonsByTurnir($turnir)
    {

        $qb = $this->createQueryBuilder('m')
                ->select('DISTINCT s.name')
                ->join('m.turnir', 't')
                ->join('m.season', 's')
                ->where("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getEntityByTurnir($turnir, $season, $stadia_id = null)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('m', 't', 's', 'st', 'tm')
                ->join('m.turnir', 't')
                ->join('m.season', 's')
                ->join('m.stadia', 'st')
                ->join('m.country', 'tm')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    ]);

        if ($stadia_id) {
            $qb->andWhere('m.stadia = :stadia_id')
                    ->setParameter('stadia_id', $stadia_id);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getCountriesBySeason($year)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('c.name', 'c.translit')
                ->join('m.season', 's')
                ->join('m.country', 'c')
                ->where("s.name = :year")
                ->setParameter('year', $year)
                ->groupBy('c')
                ->orderBy('c.name');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getCurMatches()
    {
      return $this->createQueryBuilder('r')
          ->where('DATE_DIFF(r.data, :data) = 0')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('r.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('r')
          ->where('DATE_DIFF(r.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('r.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getTomMatches()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) = 1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getEntityByWeek($date, $turnir)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('m', 's', 'st', 't')
                ->join('m.turnir', 't')
                ->join('m.season', 's')
                ->join('m.stadia', 'st')
                ->join('m.country', 'c')
                ->where("m.data >= :data")
                ->setParameter('data', $date)
                ->andWhere("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->andWhere("m.status = 0")
                ->orderBy('st.rank, m.data, m.id');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
