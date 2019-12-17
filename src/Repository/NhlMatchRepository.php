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

    public function getMatches ($season)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.data', 'ASC')
              ->getQuery()
              ->getResult();
    }
}
