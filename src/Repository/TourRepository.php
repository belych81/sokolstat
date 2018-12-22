<?php

namespace App\Repository;

use App\Entity\Tour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tour[]    findAll()
 * @method Tour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tour::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->join('tm.country', 'c')
            ->where('t.data >= :data')
            ->andWhere('c.name IN (:fnl)')
            ->setParameter('data', $data)
            ->setParameter('fnl', ['Англия', 'Испания', 'Италия', 'Германия',
              'Франция'])
            ->orderBy('t.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Tour
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
