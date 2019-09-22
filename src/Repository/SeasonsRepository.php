<?php

namespace App\Repository;

use App\Entity\Seasons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Seasons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seasons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seasons[]    findAll()
 * @method Seasons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Seasons::class);
    }

    public function getSeasonsEurocupByTeam($team)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'e')
              ->leftJoin('s.eurocups', 'e')
              ->where("e.season = s.id")
              ->andWhere("e.team = :team OR e.team2 = :team")
              ->setParameter('team', $team)
              ->orderBy('s.name', 'ASC')
              ->getQuery()
              ->getResult()
              ;
    }

    public function getSeasonsCupByTeam($team)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c')
              ->leftJoin('s.cups', 'c')
              ->where("c.season = s.id")
              ->andWhere("c.team = :team OR c.team2 = :team")
              ->setParameter('team', $team)
              ->orderBy('s.name', 'ASC')
              ->getQuery()
              ->getResult()
              ;
    }
}
