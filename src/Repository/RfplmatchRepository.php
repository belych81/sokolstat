<?php

namespace App\Repository;

use App\Entity\Rfplmatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rfplmatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rfplmatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rfplmatch[]    findAll()
 * @method Rfplmatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RfplmatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rfplmatch::class);
    }

    public function findByLastYear($data)
    {
        return $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->where('t.data >= :data')
            ->setParameter('data', $data)
            ->orderBy('t.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Rfplmatch
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
