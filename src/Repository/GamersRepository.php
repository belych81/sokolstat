<?php

namespace App\Repository;

use App\Entity\Gamers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gamers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gamers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gamers[]    findAll()
 * @method Gamers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gamers::class);
    }

    public function getBomb($season)
    {
      return $this->createQueryBuilder('g')
              ->select('g', 'r')
              ->join('g.player', 'r')
              ->join('g.season', 's')
              ->where("g.goal > 0")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('g.goal DESC, r.name')
              ->setMaxResults(20)
              ->getQuery()
              ->getResult();
    }

    public function getRusTeamStat($season, $id)
    {
      return $this->createQueryBuilder('g')
              ->select('g', 'r', 'p', 't')
              ->join('g.player', 'p')
              ->join('g.season', 's')
              ->join('g.team', 't')
              ->leftJoin('p.rusplayers', 'r')
              ->where("t.translit = :id")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->setParameter('id', $id)
              ->orderBy('g.game DESC, p.name')
              ->getQuery()
              ->getResult();
    }

    public function getStatPlayer($id)
    {
      return $this->createQueryBuilder('g')
              ->select('g', 'p', 's', 't')
              ->join('g.player', 'p')
              ->join('g.season', 's')
              ->join('g.team', 't')
              ->where("p.translit = :id")
              ->setParameter('id', $id)
              ->orderBy('s.name')
              ->getQuery()
              ->getResult();
    }
}
