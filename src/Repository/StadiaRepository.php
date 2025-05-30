<?php

namespace App\Repository;

use App\Entity\Stadia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stadia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stadia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stadia[]    findAll()
 * @method Stadia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StadiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stadia::class);
    }

    public function getStadiaCup($season)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.games', 'c')
              ->join('c.season', 'sn')
              ->where("c.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->setParameter('season', $season)
              ->getQuery()
              ->getResult()
              ;
    }

    public function getStadiaEurocup($season, $turnir)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.games', 'c')
              ->join('c.season', 'sn')
              ->join('c.turnir', 't')
              ->where("c.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->andWhere("t.alias = :turnir")
              ->setParameter('season', $season)
              ->setParameter('turnir', $turnir)
              ->orderBy('s.rank ASC, s.alias')
              ->getQuery()
              ->getResult()
              ;
    }

    public function getStadiaEurocupByTeam($season, $team)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.eurocups', 'e')
              ->join('e.season', 'sn')
              ->where("e.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->setParameter('season', $season)
              ->andWhere("e.team = :team OR e.team2 = :team")
              ->setParameter('team', $team)
              ->getQuery()
              ->getResult()
              ;
    }

    public function getStadiaNationCup($season, $country)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.games', 'c')
              ->join('c.season', 'sn')
              ->join('c.turnir', 'cn')
              ->where("c.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->andWhere("cn.alias = :country")
              ->setParameter('season', $season)
              ->setParameter('country', $country."-cup")
              ->getQuery()
              ->getResult()
              ;
    }

    public function getStadiaCupLeague($season)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'c', 'sn')
              ->leftJoin('s.games', 'c')
              ->join('c.season', 'sn')
              ->join('c.turnir', 't')
              ->where("c.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->andWhere("t.alias = :turnir")
              ->setParameter('season', $season)
              ->setParameter('turnir', 'league-cup')
              ->getQuery()
              ->getResult()
              ;
    }

    public function getStadiaMundial($turnir, $season)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 't', 'm', 'sn')
              ->leftJoin('s.mundials', 'm')
              ->join('m.season', 'sn')
              ->join('m.turnir', 't')
              ->where("m.stadia = s.id")
              ->andWhere("sn.name = :season")
              ->andWhere("t.alias = :turnir")
              ->setParameter('season', $season)
              ->setParameter('turnir', $turnir)
              ->orderBy('s.rank ASC, s.alias')
              ->getQuery()
              ->getResult()
              ;
              ;
    }

    public function queryGroupStadia()
    {
        return $this->createQueryBuilder('s')
          ->where("s.alias LIKE '%group%'")
          ->orderBy('s.name', 'asc');
    }
}
