<?php

namespace App\Repository;

use App\Entity\Lchplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lchplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lchplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lchplayer[]    findAll()
 * @method Lchplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LchplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lchplayer::class);
    }

    public function getBomb($season)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 's')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->where("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('lp.goal DESC, p.name')
              ->setMaxResults(20)
              ->getQuery()
              ->getResult();
    }

    public function getLchTeamStat($season, $id)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 't')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->join('lp.team', 't')
              ->where("s.name = :season")
              ->andWhere('t.translit = :id')
              ->setParameter('season', $season)
              ->setParameter('id', $id)
              ->orderBy('lp.game DESC, p.name')
              ->getQuery()
              ->getResult();
    }

    public function getLchplayer($id)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 't', 's')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->join('lp.team', 't')
              ->where('p.translit = :id')
              ->setParameter('id', $id)
              ->orderBy('s.name')
              ->getQuery()
              ->getResult();
    }
}
