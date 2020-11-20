<?php

namespace App\Repository;

use App\Entity\NhlPlayOff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlPlayOff|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayOff|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayOff[]    findAll()
 * @method NhlPlayOff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayOffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlPlayOff::class);
    }

    // /**
    //  * @return NhlPlayOff[] Returns an array of NhlPlayOff objects
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
    public function findOneBySomeField($value): ?NhlPlayOff
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
