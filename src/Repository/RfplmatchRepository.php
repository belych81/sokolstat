<?php

namespace App\Repository;

use App\Entity\Rfplmatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rfplmatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rfplmatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rfplmatch[]    findAll()
 * @method Rfplmatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RfplmatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rfplmatch::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->where('t.data >= :data')
            ->andWhere('t.status = 0')
            ->setParameter('data', $data)
            ->orderBy('t.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getList($max, $offset = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->orderBy('t.data', 'ASC')
            ->setMaxResults($max);

        if ($offset)
        {
            $qb->setFirstResult($offset);
        }

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

    public function getMaxTour($season)
    {
        $qb = $this->createQueryBuilder('r')
                ->select('r.tour')
                ->join('r.season', 's')
                ->where("s.name = :season")
                ->setParameter('season', $season)
                ->orderBy('r.id', 'DESC')
                ->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getScalarResult();
    }

    public function getRusMatches ($season, $tour)
    {
      return $this->createQueryBuilder('r')
              ->select('r')
              ->join('r.team', 'tm')
              ->join('r.season', 's')
              ->where("s.name = :season")
              ->andWhere("r.tour = :tour")
              ->setParameter('season', $season)
              ->setParameter('tour', $tour)
              ->orderBy('r.data', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getTours($season)
    {
      return $this->createQueryBuilder('r')
              ->select('DISTINCT r.tour')
              ->join('r.team', 'tm')
              ->join('r.season', 's')
              ->where("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('r.tour', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function countMatches()
    {
          $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ;

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
