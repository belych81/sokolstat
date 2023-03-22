<?php

namespace App\Repository;

use App\Entity\NhlMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlMatch[]    findAll()
 * @method NhlMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlMatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlMatch::class);
    }

    public function getMatches($curDate, $season)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->andWhere("t.data LIKE '%$curDate%'")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.data', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getDates($season)
    {
      return $this->createQueryBuilder('t')
              ->select('DISTINCT DATE(t.data)')
              ->join('t.season', 's')
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.data', 'ASC')
              ->getQuery()
              ->getResult();
    }
}
