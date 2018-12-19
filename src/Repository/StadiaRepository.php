<?php

namespace App\Repository;

use App\Entity\Stadia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stadia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stadia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stadia[]    findAll()
 * @method Stadia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StadiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stadia::class);
    }

    // /**
    //  * @return Stadia[] Returns an array of Stadia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stadia
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
