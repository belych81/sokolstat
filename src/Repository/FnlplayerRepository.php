<?php

namespace App\Repository;

use App\Entity\Fnlplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Fnlplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fnlplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fnlplayer[]    findAll()
 * @method Fnlplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FnlplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Fnlplayer::class);
    }

    public function getBomb5($season)
    {
      return $this->createQueryBuilder('f')
          ->select('f', 'p')
          ->join('f.season', 's')
          ->join('f.team', 't')
          ->join('f.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('f.goal > 0')
          ->orderBy('f.goal DESC, p.name')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }

    public function getTeamStat($season, $id)
    {
      return $this->createQueryBuilder('f')
          ->select('f', 'p', 't')
          ->join('f.season', 's')
          ->join('f.team', 't')
          ->join('f.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('t.translit = :id')
          ->setParameter('id', $id)
          ->orderBy('f.game DESC, f.goal DESC, p.name')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getStatPlayer($id)
    {
      return $this->createQueryBuilder('f')
          ->select('f', 'p', 't', 's')
          ->join('f.season', 's')
          ->join('f.team', 't')
          ->join('f.player', 'p')
          ->andWhere('p.translit = :id')
          ->setParameter('id', $id)
          ->orderBy('s.name')
          ->getQuery()
          ->getResult()
      ;
    }
}
