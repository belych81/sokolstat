<?php

namespace App\Repository;

use App\Entity\NationSupercup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NationSupercup|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationSupercup|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationSupercup[]    findAll()
 * @method NationSupercup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationSupercupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NationSupercup::class);
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('n')
          ->where('DATE_DIFF(n.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('n.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }
}
