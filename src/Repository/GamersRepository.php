<?php

namespace App\Repository;

use App\Entity\Gamers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gamers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gamers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gamers[]    findAll()
 * @method Gamers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gamers::class);
    }

    public function getBombOld($season)
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

    public function getBomb($season)
    {
      return $this->createQueryBuilder('g')
              ->select('g', 'r')
              ->join('g.player', 'r')
              ->join('g.season', 's')
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere('g.goal > 0')
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
              ->orderBy('g.game DESC, g.goal DESC, p.name')
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

    public function updateGamer($id, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game+1';
                break;
            case 'minusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game-1';
                break;
            case 'plusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Gamers', 'g')
                ->set($changeParam, $changeParam2)
                ->where('g.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }
}
