<?php

namespace App\Repository;

use App\Entity\Achieve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Achieve>
 *
 * @method Achieve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Achieve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Achieve[]    findAll()
 * @method Achieve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchieveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achieve::class);
    }

//    /**
//     * @return Achieve[] Returns an array of Achieve objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Achieve
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
