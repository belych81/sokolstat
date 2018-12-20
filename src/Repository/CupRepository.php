<?php

namespace App\Repository;

use App\Entity\Cup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cup[]    findAll()
 * @method Cup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cup::class);
    }

    // /**
    //  * @return Cup[] Returns an array of Cup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cup
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
