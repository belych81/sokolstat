<?php

namespace App\Repository;

use App\Entity\Shipplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shipplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipplayer[]    findAll()
 * @method Shipplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shipplayer::class);
    }

    public function getBombSum($season)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p', 't')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->orderBy('sp.sum', 'DESC', 'p.name', 'ASC')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }
    
}
