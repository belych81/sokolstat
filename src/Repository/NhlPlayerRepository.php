<?php

namespace App\Repository;

use App\Entity\NhlPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NhlPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayer[]    findAll()
 * @method NhlPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NhlPlayer::class);
    }

    // /**
    //  * @return NhlPlayer[] Returns an array of NhlPlayer objects
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
    public function findOneBySomeField($value): ?NhlPlayer
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
