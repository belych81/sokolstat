<?php

namespace App\Repository;

use App\Entity\Ecplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ecplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecplayer[]    findAll()
 * @method Ecplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ecplayer::class);
    }

    public function findEcPlayersByTeam($id, $season)
    {
        return $this->createQueryBuilder('e')
                ->select('e', 'r')
                ->join('e.season', 's')
                ->join('e.player', 'r')
                ->join('e.team', 'tm')
                ->join('e.turnir', 't')
                ->where("tm.translit = :id")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'id' => $id,
                    'season' => $season,
                        ])
                ->orderBy('e.game', 'DESC')
                ->getQuery()
                ->getResult();
    }

    public function getEcPlayer($id)
    {
      return $this->createQueryBuilder('ec')
              ->select('ec')
              ->join('ec.player', 'r')
              ->where("r.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }
}
