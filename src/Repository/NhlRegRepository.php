<?php

namespace App\Repository;

use App\Entity\NhlReg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NhlReg|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlReg|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlReg[]    findAll()
 * @method NhlReg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlRegRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NhlReg::class);
    }

    // /**
    //  * @return NhlReg[] Returns an array of NhlReg objects
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
    public function findOneBySomeField($value): ?NhlReg
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
