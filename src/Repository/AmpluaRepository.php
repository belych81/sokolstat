<?php

namespace App\Repository;

use App\Entity\Amplua;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Amplua|null find($id, $lockMode = null, $lockVersion = null)
 * @method Amplua|null findOneBy(array $criteria, array $orderBy = null)
 * @method Amplua[]    findAll()
 * @method Amplua[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmpluaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Amplua::class);
    }

    // /**
    //  * @return Amplua[] Returns an array of Amplua objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Amplua
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
