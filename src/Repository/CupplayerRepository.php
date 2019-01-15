<?php

namespace App\Repository;

use App\Entity\Cupplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cupplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cupplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cupplayer[]    findAll()
 * @method Cupplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cupplayer::class);
    }

    public function getCupTeamStat($season, $id)
    {
      return $this->createQueryBuilder('c')
              ->select('c', 'r', 't')
              ->join('c.season', 's')
              ->join('c.player', 'r')
              ->join('c.team', 't')
              ->where('s.name = :season')
              ->andWhere('t.translit = :id')
              ->setParameters([
                  'season' => $season,
                  'id' => $id
                  ])
              ->getQuery()
              ->getResult();
    }

    public function getCupPlayer($id)
    {
      return $this->createQueryBuilder('c')
              ->select('c', 'p', 's')
              ->join('c.season', 's')
              ->join('c.player', 'p')
              ->where('p.translit = :id')
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }
}
