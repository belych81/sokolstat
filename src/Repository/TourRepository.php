<?php

namespace App\Repository;

use App\Entity\Tour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tour[]    findAll()
 * @method Tour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tour::class);
    }

    public function findByLastWeek($data)
    {
        return $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->join('tm.country', 'c')
            ->where('t.data >= :data')
            ->andWhere('c.name IN (:fnl)')
            ->andWhere('t.status = 0')
            ->setParameter('data', $data)
            ->setParameter('fnl', ['Англия', 'Испания', 'Италия', 'Германия',
              'Франция'])
            ->orderBy('t.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getYesterdayMatches5()
    {
      return $this->createQueryBuilder('t')
          ->where('DATE_DIFF(t.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('t.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getCurMatches()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) = 0')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
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

    public function getLastSeason($country)
    {
        $qb = $this->createQueryBuilder('t')
                ->select('s.name')
                ->join('t.country', 'c')
                ->join('t.season', 's')
                ->where("c.name = :country")
                ->setParameter('country', $country)
                ->orderBy('t.id', 'DESC')
                ->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getMaxTour($country, $season) {

        $qb = $this->createQueryBuilder('t')
                ->select('t.tour')
                ->join('t.country', 'c')
                ->join('t.season', 's')
                ->where("c.name = :country")
                ->setParameter('country', $country)
                ->andWhere("s.name = :season")
                ->setParameter('season', $season)
                ->orderBy('t.id', 'DESC')
                ->setMaxResults(1);

        $query = $qb->getQuery();

        if ($query->getScalarResult()) {
            return $query->getSingleScalarResult();
        }

        return $query->getOneOrNullResult();
    }

    public function getMatches($country, $season, $tour)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.country', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.name = :country")
              ->setParameter('country', $country)
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere("t.tour = :tour")
              ->setParameter('tour', $tour)
              ->orderBy('t.data', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getLastMatchesByTeam($season, $team)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->join('t.team2', 'tm2')
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere("tm.translit = :team OR tm2.translit = :team")
              ->setParameter('team', $team)
              ->andWhere('t.status = 0')
              ->orderBy('t.data', 'DESC')
              ->setMaxResults(10)
              ->getQuery()
              ->getResult();
    }

    public function getTours($country, $season)
    {
      return $this->createQueryBuilder('t')
              ->select('DISTINCT t.tour')
              ->join('t.country', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.name = :country")
              ->setParameter('country', $country)
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.tour', 'ASC')
              ->getQuery()
              ->getResult();
    }

}
