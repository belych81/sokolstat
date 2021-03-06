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
              ->orderBy('g.totalgame DESC, g.game DESC, g.goal DESC, p.name')
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
                $changeParam3 = 'g.totalgame';
                $changeParam4 = 'g.totalgame+1';
                break;
            case 'minusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game-1';
                $changeParam3 = 'g.totalgame';
                $changeParam4 = 'g.totalgame-1';
                break;
            case 'plusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal+1';
                $changeParam3 = 'g.totalgoal';
                $changeParam4 = 'g.totalgoal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal-1';
                $changeParam3 = 'g.totalgoal';
                $changeParam4 = 'g.totalgoal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Gamers', 'g')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->where('g.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function countEntity(array $arFilter)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)');
        foreach($arFilter as $field => $value){
          if(!empty($value) && $value != 'all'){
            switch($field){
              case 'season':
                $qb->join('r.season', 's')
                    ->andWhere('s.id = :season')
                    ->setParameter('season', $value);
                break;
              case 'team':
                $qb->join('r.team', 't')
                    ->andWhere('t.id = :team')
                    ->setParameter('team', $value);
                break;
            }
          }
        }
        $query = $qb->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getEntity($max, $offset=null, $sort='id', $order='desc', array $arFilter)
    {
        $qb = $this->createQueryBuilder('r');
        switch($sort){
          case 'born':
            $qb->join('r.player', 'p')
                ->orderBy('p.born', $order);
            break;
          case 'player':
            $qb->join('r.player', 'p')
                ->orderBy('p.name', $order);
            break;
          case 'season':
            $qb->join('r.season', 's')
                ->orderBy('s.name', $order);
            break;
          case 'team':
            $qb->join('r.team', 't')
                ->orderBy('t.name', $order);
            break;
          case 'country':
            $qb->join('r.player', 'p')
                ->join('p.country', 'c')
                ->orderBy('c.name', $order);
            break;
          default:
            $qb->orderBy('r.'.$sort, $order);
        }
        if ($offset)
        {
            $qb->setFirstResult($offset);
        }
        foreach($arFilter as $field => $value){
          if(!empty($value) && $value != 'all'){
            switch($field){
              case 'season':
                $qb->join('r.season', 's')
                    ->andWhere('s.id = :season')
                    ->setParameter('season', $value);
                break;
              case 'team':
                $qb->join('r.team', 't')
                    ->andWhere('t.id = :team')
                    ->setParameter('team', $value);
                break;
                case 'country':
                  $qb->join('r.player', 'p')
                    ->join('p.country', 'c')
                    ->andWhere('c.id = :country')
                    ->setParameter('country', $value);
            }
          }
        }
        $qb->setMaxResults($max);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
