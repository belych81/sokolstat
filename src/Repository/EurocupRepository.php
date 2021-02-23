<?php

namespace App\Repository;

use App\Entity\Eurocup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Eurocup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eurocup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eurocup[]    findAll()
 * @method Eurocup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EurocupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eurocup::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('e')
            ->join('e.team', 'tm')
            ->join('e.team2', 'tm2')
            ->join('tm.country', 'c')
            ->join('tm2.country', 'c2')
            ->where('e.data >= :data')
            ->andWhere('c.name IN (:fnl) OR c2.name IN (:fnl)')
            ->andWhere('e.status = 0')
            ->setParameter('data', $data)
            ->setParameter('fnl', ['Англия', 'Испания', 'Италия', 'Германия',
              'Франция', 'Россия'])
            ->orderBy('e.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('e')
          ->where('DATE_DIFF(e.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('e.data', 'ASC')
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

    public function getLastStadia($turnir, $season)
    {
        return $this->createQueryBuilder('e')
                ->select('st.name, st.alias')
                ->join('e.stadia', 'st')
                ->join('e.season', 's')
                ->join('e.turnir', 't')
                ->where("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->andWhere("s.name = :season")
                ->setParameter('season', $season)
                ->orderBy('e.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getResult();
    }

    public function getSeasonsByTurnir($turnir)
    {
        return $this->createQueryBuilder('e')
                ->select('DISTINCT s.name')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->where("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->orderBy('s.name')
                ->getQuery()
                ->getResult();
    }

    public function getEntityByTurnir($turnir, $season)
    {
        $qb = $this->createQueryBuilder('e')
                ->select('e', 's', 'st', 'tm', 'tm2', 'es')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.team', 'tm')
                ->join('e.team2', 'tm2')
                ->leftJoin('e.ecsostav', 'es')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season
                        ])
                ->orderBy('e.data, e.id');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getEntityByWeek($date)
    {
        $qb = $this->createQueryBuilder('e')
                ->select('e', 's', 'st', 'tm', 'tm2', 'es')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.team', 'tm')
                ->join('e.team2', 'tm2')
                ->leftJoin('e.ecsostav', 'es')
                ->where("e.data >= :data")
                ->setParameter('data', $date)
                ->andWhere("e.status = 0")
                ->orderBy('e.data, e.id');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getStadiaByTurnir($turnir, $season)
    {
        $qb = $this->createQueryBuilder('e')
                ->select('e', 'st')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                        ])
                ->groupBy('st');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getEntityByTurnirStadia($turnir, $season, $stadia)
    {
        return $this->createQueryBuilder('e')
                ->select('e', 's', 'st', 'tm', 'tm2', 'es')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.team', 'tm')
                ->join('e.team2', 'tm2')
                ->leftJoin('e.ecsostav', 'es')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->andWhere('st.id = :stadia')
                ->setParameters([
                    'season' => $season,
                    'turnir' => $turnir,
                    'stadia' => $stadia
                    ])
                ->orderBy('e.data, e.id')
                ->getQuery()
                ->getResult();
    }

    public function getEurocupByTeam($teamId)
    {
        return $this->createQueryBuilder('e')
            ->join('e.season', 's')
            ->where('e.team = :team OR e.team2 = :team')
            ->setParameter('team', $teamId)
            ->orderBy('s.name', 'asc', 'e.data', 'asc')
            ->getQuery()
            ->getResult();
    }

    public function findAllBySeasonAndTeam($season, $team)
    {
        return $this->createQueryBuilder('e')
                ->select('e', 't', 't2', 's')
                ->join('e.season', 's')
                ->join('e.team', 't')
                ->join('e.team2', 't2')
                ->where('s.name = :season')
                ->andWhere('e.team = :team OR e.team2 = :team')
                ->setParameters([
                    'season' => $season,
                    'team' => $team
                    ])
                ->getQuery()
                ->getResult();
    }
}
