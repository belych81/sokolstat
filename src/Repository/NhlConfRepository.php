<?php

namespace App\Repository;

use App\Entity\NhlConf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlConf|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlConf|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlConf[]    findAll()
 * @method NhlConf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlConfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlConf::class);
    }

    // /**
    //  * @return NhlConf[] Returns an array of NhlConf objects
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
    public function findOneBySomeField($value): ?NhlConf
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
