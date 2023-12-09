<?php

namespace App\Repository;

use App\Entity\Fnlplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fnlplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fnlplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fnlplayer[]    findAll()
 * @method Fnlplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FnlplayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
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
          ->leftJoin('p.rusplayers', 'r')
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

    public function updateFnlplayer($id, $change)
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
                ->update('App\Entity\Fnlplayer', 'g')
                ->set($changeParam, $changeParam2)
                ->where('g.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function updateFnlplayers($arr)
    {
      $qb = $this->_em->createQueryBuilder()
          ->update('App\Entity\Fnlplayer', 's')
          ->set('s.game', 's.game+'.$arr[2])
          ->where('s.id = ?1')
          ->setParameter(1, $arr[0])
          ->getQuery();

      $qb->execute();
    }

    public function updateFullFnlplayer($player_id, $game, $goal, $season, $team)
    {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Fnlplayer', 'f')
                ->set('f.game', 'f.game+:game')
                ->set('f.goal', 'f.goal+:goal')
                ->where('f.player = :player')
                ->andWhere('f.season = :season')
                ->andWhere('f.team = :team')
                ->setParameters(['player'=>$player_id, 'game'=>$game, 'goal'=>$goal,
               'season'=>$season, 'team'=>$team])
                ->getQuery();

            $qb->execute();
    }
}
