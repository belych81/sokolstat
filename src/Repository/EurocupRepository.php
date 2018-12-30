<?php

namespace App\Repository;

use App\Entity\Eurocup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Eurocup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eurocup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eurocup[]    findAll()
 * @method Eurocup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EurocupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eurocup::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('e')
            ->join('e.team', 'tm')
            ->join('tm.country', 'c')
            ->where('e.data >= :data')
            ->andWhere('c.name IN (:fnl)')
            ->setParameter('data', $data)
            ->setParameter('fnl', ['Англия', 'Испания', 'Италия', 'Германия',
              'Франция', 'Россия'])
            ->orderBy('e.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Eurocup
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
