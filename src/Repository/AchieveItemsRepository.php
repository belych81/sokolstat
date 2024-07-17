<?php

namespace App\Repository;

use App\Entity\AchieveItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AchieveItems>
 *
 * @method AchieveItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchieveItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchieveItems[]    findAll()
 * @method AchieveItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchieveItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AchieveItems::class);
    }

//    /**
//     * @return AchieveItems[] Returns an array of AchieveItems objects
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

//    public function findOneBySomeField($value): ?AchieveItems
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
