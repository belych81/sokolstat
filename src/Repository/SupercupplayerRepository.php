<?php

namespace App\Repository;

use App\Entity\Supercupplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Supercupplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supercupplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supercupplayer[]    findAll()
 * @method Supercupplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupercupplayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supercupplayer::class);
    }

    public function getScPlayer($id)
    {
      return $this->createQueryBuilder('sc')
              ->select('sc', 'r', 'ss')
              ->join('sc.player', 'r')
              ->join('sc.season', 'ss')
              ->where("r.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }
}
