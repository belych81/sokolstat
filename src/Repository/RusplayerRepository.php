<?php

namespace App\Repository;

use App\Entity\Rusplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rusplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rusplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rusplayer[]    findAll()
 * @method Rusplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RusplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rusplayer::class);
    }

    public function getTopPlayers($max, $type) {

            $qb = $this->createQueryBuilder('r')
                ->select('p.name', 'p.translit', 'r.'.$type)
                ->join('r.player', 'p')
                ->orderBy('r.'.$type, 'DESC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopGoalkeepers($max) {

            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->orderBy('r.goal', 'ASC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopPlayersCurr($max, $type, $season)
    {
        $qb = $this->createQueryBuilder('r')
                ->select('DISTINCT r.id', 'p.name', 'p.translit', 'r.'.$type)
                ->join('r.player', 'p')
                ->join('p.gamers', 'g')
                ->join('g.season', 's')
                ->where('s.name = ?1')
                ->setParameter(1, $season)
                ->orderBy('r.'.$type, 'DESC')
                ->setMaxResults($max);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopGoalkeepersCurr($max, $season)
    {
            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->leftJoin('p.gamers', 'g')
                ->join('g.season', 's')
                ->where('s.name = ?1')
                ->setParameter(1, $season)
                ->andWhere('r.goal < 0')
                ->orderBy('r.goal', 'ASC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function countPlayers($country=null, $team=null)
    {
        if($team && $team != 'all') {
          $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->leftJoin('p.playersteams', 'pt')
                ->join('pt.team', 'tm')
                ->where('r.totalgame > 0')
                ;
        } else {
            $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->where('r.totalgame > 0');
        }
        if($country && $country != 'all') {
            $qb->where('c.translit = ?1')
                ->setParameter(1, $country);
        }
        if($team && $team != 'all') {
            $qb->andWhere('tm.translit = ?2')
                ->setParameter(2, $team);
        }
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getPlayers($max, $sort, $order='desc', $offset=null, $country=null,
      $team=null)
    {
        if($team && $team != 'all')
        {
            if($sort == 'totalgame')
            {
                $sortBy = 'r.totalgame';
            }
            elseif($sort == 'totalgoal')
            {
                $sortBy = 'r.totalgoal';
            }
            else
            {
                $sortBy='pt.'.$sort;
            }
          if ($sort == 'born')
          {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->leftJoin('p.playersteams', 'pt')
                  ->join('pt.team', 'tm')
                  ->where('r.totalgame > 0')
                  ->orderBy('p.born', $order)
                  ->setMaxResults($max);
          }
          else
          {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->leftJoin('p.playersteams', 'pt')
                  ->join('pt.team', 'tm')
                  ->where('r.totalgame > 0')
                  ->orderBy($sortBy, $order)
                  ->setMaxResults($max)
                  ;
          }
        }
        else
        {
            if ($sort == 'born')
            {
            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->where('r.totalgame > 0')
                ->orderBy('p.born', $order)
                ->setMaxResults($max);
            }
            else
            {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->where('r.totalgame > 0')
                  ->orderBy('r.'.$sort, $order)
                  ->setMaxResults($max)
                  ;
            }
        }

        if($country && $country != 'all')
        {
            $qb->where('c.translit = ?1')
                ->setParameter(1, $country);
        }

        if($team && $team != 'all')
        {
            $qb->andWhere('tm.translit = ?2')
                ->setParameter(2, $team);
        }

        if ($offset)
        {
            $qb->setFirstResult($offset);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findByTranslit($id)
    {
      return $this->createQueryBuilder('r')
              ->select('r', 'p')
              ->join('r.player', 'p')
              ->where("p.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }

    public function updateRusplayer($player, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.game';
                $changeParam2 = 'r.game+1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame+1';
                break;
            case 'minusGame' :
                $changeParam = 'r.game';
                $changeParam2 = 'r.game-1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame-1';
                break;
            case 'plusGoal' :
                $changeParam = 'r.goal';
                $changeParam2 = 'r.goal+1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'r.goal';
                $changeParam2 = 'r.goal-1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateSbplayer($player, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.sbgame';
                $changeParam2 = 'r.sbgame+1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame+1';
                break;
            case 'minusGame' :
                $changeParam = 'r.sbgame';
                $changeParam2 = 'r.sbgame-1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame-1';
                break;
            case 'plusGoal' :
                $changeParam = 'r.sbgoal';
                $changeParam2 = 'r.sbgoal+1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'r.sbgoal';
                $changeParam2 = 'r.sbgoal-1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerTotalChamp($player, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.game';
                $changeParam2 = 'r.game+1';

                break;
            case 'minusGame' :
                $changeParam = 'r.game';
                $changeParam2 = 'r.game-1';

                break;
            case 'plusGoal' :
                $changeParam = 'r.goal';
                $changeParam2 = 'r.goal+1';

                break;
            case 'minusGoal' :
                $changeParam = 'r.goal';
                $changeParam2 = 'r.goal-1';

                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerTotal($player, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.totalgame';
                $changeParam2 = 'r.totalgame+1';

                break;
            case 'minusGame' :
                $changeParam = 'r.totalgame';
                $changeParam2 = 'r.totalgame-1';

                break;
            case 'plusGoal' :
                $changeParam = 'r.totalgoal';
                $changeParam2 = 'r.totalgoal+1';

                break;
            case 'minusGoal' :
                $changeParam = 'r.totalgoal';
                $changeParam2 = 'r.totalgoal-1';

                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerEcTotal($player, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.ecgame';
                $changeParam2 = 'r.ecgame+1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame+1';
                break;
            case 'minusGame' :
                $changeParam = 'r.ecgame';
                $changeParam2 = 'r.ecgame-1';
                $changeParam3 = 'r.totalgame';
                $changeParam4 = 'r.totalgame-1';
                break;
            case 'plusGoal' :
                $changeParam = 'r.ecgoal';
                $changeParam2 = 'r.ecgoal+1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'r.ecgoal';
                $changeParam2 = 'r.ecgoal-1';
                $changeParam3 = 'r.totalgoal';
                $changeParam4 = 'r.totalgoal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerChamp($player, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Rusplayer', 'r')
            ->set('r.game', 'r.game+1')
            ->set('r.goal', 'r.goal+?1')
            ->set('r.totalgame', 'r.totalgame+1')
            ->set('r.totalgoal', 'r.totalgoal+?1')
            ->where('r.player = ?2')
            ->setParameter(1, $goal)
            ->setParameter(2, $player)
            ->getQuery();

        $qb->execute();
    }

    public function updateRusplayerTotalFnl($player, $game, $goal)
    {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set('r.fnlgame', 'r.fnlgame+?1')
                ->set('r.fnlgoal', 'r.fnlgoal+?2')
                ->where('r.player = ?3')
                ->setParameter(1, $game)
                ->setParameter(2, $goal)
                ->setParameter(3, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerFnl($player, $change)
    {

        switch ($change) {
            case 'plusGame' :
                $changeParam = 'r.fnlgame';
                $changeParam2 = 'r.fnlgame+1';

                break;
            case 'minusGame' :
                $changeParam = 'r.fnlgame';
                $changeParam2 = 'r.fnlgame-1';

                break;
            case 'plusGoal' :
                $changeParam = 'r.fnlgoal';
                $changeParam2 = 'r.fnlgoal+1';

                break;
            case 'minusGoal' :
                $changeParam = 'r.fnlgoal';
                $changeParam2 = 'r.fnlgoal-1';

                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Rusplayer', 'r')
                ->set($changeParam, $changeParam2)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->getQuery();

            $qb->execute();
    }

    public function updateRusplayerEc($player, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Rusplayer', 'r')
            ->set('r.totalgame', 'r.totalgame+1')
            ->set('r.totalgoal', 'r.totalgoal+?1')
            ->set('r.ecgame', 'r.ecgame+1')
            ->set('r.ecgoal', 'r.ecgoal+?1')
            ->where('r.player = ?2')
            ->setParameter(1, $goal)
            ->setParameter(2, $player)
            ->getQuery();

        $qb->execute();
    }

    public function updateRusplayerCup($player, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Rusplayer', 'r')
            ->set('r.totalgame', 'r.totalgame+1')
            ->set('r.totalgoal', 'r.totalgoal+?1')
            ->set('r.cupgame', 'r.cupgame+1')
            ->set('r.cupgoal', 'r.cupgoal+?1')
            ->where('r.player = ?2')
            ->setParameter(1, $goal)
            ->setParameter(2, $player)
            ->getQuery();

        $qb->execute();
    }

    public function updateRusplayerSb($player, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Rusplayer', 'r')
            ->set('r.totalgame', 'r.totalgame+1')
            ->set('r.totalgoal', 'r.totalgoal+?1')
            ->set('r.sbgame', 'r.sbgame+1')
            ->set('r.sbgoal', 'r.sbgoal+?1')
            ->where('r.player = ?2')
            ->setParameter(1, $goal)
            ->setParameter(2, $player)
            ->getQuery();

        $qb->execute();
    }
}
