<?php

namespace App\Repository;

use App\Entity\Turnir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Turnir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Turnir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Turnir[]    findAll()
 * @method Turnir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurnirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turnir::class);
    }

    // /**
    //  * @return Turnir[] Returns an array of Turnir objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Turnir
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
