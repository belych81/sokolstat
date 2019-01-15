<?php

namespace App\Repository;

use App\Entity\Sbplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sbplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sbplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sbplayer[]    findAll()
 * @method Sbplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SbplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sbplayer::class);
    }

    public function getSbPlayer($id)
    {
      return $this->createQueryBuilder('s')
              ->select('s', 'r', 'ss')
              ->join('s.player', 'r')
              ->join('s.season', 'ss')
              ->where("r.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }

    public function getSbSum($id, $choose = 'game')
    {
      $param = 'SUM(s.'.$choose.')';
      return $this->createQueryBuilder('s')
              ->select($param)
              ->join('s.player', 'p')
              ->where("p.id = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getSingleScalarResult();
    }
}
