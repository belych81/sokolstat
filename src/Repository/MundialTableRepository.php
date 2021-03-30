<?php

namespace App\Repository;

use App\Entity\MundialTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MundialTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method MundialTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method MundialTable[]    findAll()
 * @method MundialTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MundialTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MundialTable::class);
    }

    // /**
    //  * @return MundialTable[] Returns an array of MundialTable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MundialTable
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
