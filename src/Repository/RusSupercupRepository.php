<?php

namespace App\Repository;

use App\Entity\RusSupercup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RusSupercup|null find($id, $lockMode = null, $lockVersion = null)
 * @method RusSupercup|null findOneBy(array $criteria, array $orderBy = null)
 * @method RusSupercup[]    findAll()
 * @method RusSupercup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RusSupercupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RusSupercup::class);
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

    public function getEntity()
    {        
        return $this->createQueryBuilder('r')
                ->select('r', 's', 'tm')
                ->join('r.season', 's')
                ->join('r.team', 'tm')
                ->orderBy('s.name', 'DESC')
                ->getQuery()
                ->getResult();
    }
}
