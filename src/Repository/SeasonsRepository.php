<?php

namespace App\Repository;

use App\Entity\Seasons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
              ->leftJoin('s.games', 'e')
              ->join('e.turnir', 't')
              ->where("e.season = s.id")
              ->andWhere("e.team = :team OR e.team2 = :team")
              ->andWhere("t.alias IN (:turnir)")
              ->setParameter('team', $team)
              ->setParameter('turnir', $turnir)
              ->orderBy('s.name', 'ASC')
              ->getQuery()
              ->getResult()
              ;
    }

    public function getSeasons()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function setNflLastMatch($id, $season, $data)
    {
        $qb = $this->_em->createQueryBuilder('Seasons', 's')
            ->update('App\Entity\Seasons', 's')
            ->set('s.lastdate', '?3')
            ->set('s.lastId', '?2')
            ->where('s.id = ?1')
            ->setParameter(1, $season)
            ->setParameter(2, $id)
            ->setParameter(3, $data)
            ->getQuery();
        $qb->execute();
    }
}
