<?php

namespace App\Repository;

use App\Entity\Stadia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stadia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stadia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stadia[]    findAll()
 * @method Stadia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StadiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stadia::class);
    }

    public function getStadiaCup($season)
    {
      return $this->createQueryBuilder('st')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.cups', 'c')
              ->join('s.season', 'sn')
              ->where("c.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->setParameter('season', $season)
              ->getQuery()
              ->getResult()
              ;
    }
}
