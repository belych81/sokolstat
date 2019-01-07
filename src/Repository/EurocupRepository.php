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
}
