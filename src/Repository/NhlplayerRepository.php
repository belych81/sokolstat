<?php

namespace App\Repository;

use App\Entity\NhlPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nhlplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nhlplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nhlplayer[]    findAll()
 * @method Nhlplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlplayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nhlplayer::class);
    }

    // /**
    //  * @return Nhlplayer[] Returns an array of Nhlplayer objects
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
    public function findOneBySomeField($value): ?Nhlplayer
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
