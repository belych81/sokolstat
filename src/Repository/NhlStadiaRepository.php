<?php

namespace App\Repository;

use App\Entity\NhlStadia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlStadia|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlStadia|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlStadia[]    findAll()
 * @method NhlStadia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlStadiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlStadia::class);
    }

    // /**
    //  * @return NhlStadia[] Returns an array of NhlStadia objects
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
    public function findOneBySomeField($value): ?NhlStadia
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
