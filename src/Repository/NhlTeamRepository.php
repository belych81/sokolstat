<?php

namespace App\Repository;

use App\Entity\NhlTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NhlTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlTeam[]    findAll()
 * @method NhlTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NhlTeam::class);
    }

    // /**
    //  * @return NhlTeam[] Returns an array of NhlTeam objects
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
    public function findOneBySomeField($value): ?NhlTeam
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
