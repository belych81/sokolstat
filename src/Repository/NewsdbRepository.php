<?php

namespace App\Repository;

use App\Entity\Newsdb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Newsdb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newsdb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newsdb[]    findAll()
 * @method Newsdb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsdbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Newsdb::class);
    }

    // /**
    //  * @return Newsdb[] Returns an array of Newsdb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Newsdb
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
