<?php

namespace App\Repository;

use App\Entity\Seasons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Seasons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seasons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seasons[]    findAll()
 * @method Seasons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seasons::class);
    }

    public function getSeasonsTurnirByTeam($team, $turnir)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'e')
              ->leftJoin('s.'.$turnir, 'e')
              ->where("e.season = s.id")
              ->andWhere("e.team = :team OR e.team2 = :team")
              ->setParameter('team', $team)
              ->orderBy('s.name', 'ASC')
              ->getQuery()
              ->getResult()
              ;
    }
}
