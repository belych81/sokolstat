<?php

namespace App\Repository;

use App\Entity\UefaSupercup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UefaSupercup|null find($id, $lockMode = null, $lockVersion = null)
 * @method UefaSupercup|null findOneBy(array $criteria, array $orderBy = null)
 * @method UefaSupercup[]    findAll()
 * @method UefaSupercup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UefaSupercupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UefaSupercup::class);
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('u')
          ->where('DATE_DIFF(u.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('u.data', 'ASC')
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
        return $this->createQueryBuilder('u')
                ->select('u', 's', 'tm')
                ->join('u.season', 's')
                ->join('u.team', 'tm')
                ->orderBy('s.name', 'DESC')
                ->getQuery()
                ->getResult();
    }
}
