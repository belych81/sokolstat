<?php

namespace App\Repository;

use App\Entity\NhlDivision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlDivision|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlDivision|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlDivision[]    findAll()
 * @method NhlDivision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlDivisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlDivision::class);
    }

    // /**
    //  * @return NhlDivision[] Returns an array of NhlDivision objects
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
    public function findOneBySomeField($value): ?NhlDivision
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