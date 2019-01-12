<?php

namespace App\Repository;

use App\Entity\Ecsostav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ecsostav|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecsostav|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecsostav[]    findAll()
 * @method Ecsostav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcsostavRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ecsostav::class);
    }

    // /**
    //  * @return Ecsostav[] Returns an array of Ecsostav objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ecsostav
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
