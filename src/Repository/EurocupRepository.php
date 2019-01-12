<?php

namespace App\Repository;

use App\Entity\Eurocup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Eurocup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eurocup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eurocup[]    findAll()
 * @method Eurocup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EurocupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eurocup::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('e')
            ->join('e.team', 'tm')
            ->join('tm.country', 'c')
            ->where('e.data >= :data')
            ->andWhere('c.name IN (:fnl)')
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
                ->select('e', 's')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->where("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->groupBy('s')
                ->orderBy('s.name')
                ->getQuery()
                ->getResult();
    }

    public function getEntityByTurnir($turnir, $season, $stadia)
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
                ->andWhere("st.alias = :stadia")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    'stadia' => $stadia,
                        ])
                ->orderBy('e.data');

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
}
