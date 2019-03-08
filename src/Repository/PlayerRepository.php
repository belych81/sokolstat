<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function getBirthdayPlayer($data)
    {
        return $this->createQueryBuilder('p')
            ->select('p.name, p.id, p.translit')
            ->where("p.born LIKE '%$data%'")
            ->orderBy('p.born', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAge($name)
    {
        $qb = $this->createQueryBuilder('p')
                ->select('p.born')
                ->where("p.name = :name")
                ->setParameter('name', $name);

        $query = $qb->getQuery();
        $age = $query->getScalarResult();
        $year = \substr($age[0]['born'], 0, 4);

        return \date('Y') - $year;
    }

    public function getLastPlayer() {

        $qb = $this->createQueryBuilder('p')
                ->select('p.name, p.id, p.translit')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(11);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function queryRusTeamPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.playersteams', 'pt')
                ->join('pt.team', 't')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("pt.game >= 0")
                ->andWhere("t.translit = :team")
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }

    public function queryFnlPlayers($season)
    {
        $year = \substr($season, 0, 4);
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.rusplayers', 'rp')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("rp.game >= 0")
                ->orderBy('p.name');
    }

    public function queryPlayersNoRusplayer()
    {
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.rusplayers', 'rp')
                ->where("rp.id is null")
                ->orderBy('p.name');
    }

    public function queryGamerByLastSeasons()
    {
        return $query = $this->createQueryBuilder('p')
                ->where("p.born > '1982-01-01'")
                ->orderBy('p.name')
                ->groupBy('p.name');
    }

    public function updatePlayerGoal($id, $change, $goal=false, $cup=false,
      $supercup=false, $eurocup=false)
    {
        switch ($change) {
            case 'plus' :
                $changeParam = 's.goal+1';
                $changeParam1 = 's.sum+1';
                $changeParam2 = "s.cup";
                $changeParam3 = "s.supercup";
                $changeParam4 = "s.eurocup";
                break;
            case 'minus' :
                $changeParam = 's.goal-1';
                $changeParam1 = 's.sum-1';
                $changeParam2 = "s.cup";
                $changeParam3 = "s.supercup";
                $changeParam4 = "s.eurocup";
                break;
            default :
                $changeParam = "s.goal+$goal";
                $changeParam1 = "s.sum+$goal+$cup+$supercup+$eurocup";
                $changeParam2 = "s.cup+$cup";
                $changeParam3 = "s.supercup+$supercup";
                $changeParam4 = "s.eurocup+$eurocup";
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Player', 's')
                ->set('s.goal', $changeParam)
                ->set('s.cup', $changeParam2)
                ->set('s.supercup', $changeParam3)
                ->set('s.eurocup', $changeParam4)
                ->set('s.sum', $changeParam1)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function queryLchPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.shipplayers', 's')
                ->leftJoin('s.team', 'st')
                ->leftJoin('s.season', 'ss')
                ->leftJoin('p.gamers', 'g')
                ->leftJoin('g.team', 'gt')
                ->leftJoin('p.lchplayers', 'l')
                //->leftJoin('l.team', 'lt')
                ->leftJoin('l.season', 'ls')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("gt.translit = :team OR ss.id > 49 OR ls.id > 49 OR st.translit = :team OR p.id > 9500")
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }

    public function queryUpdatePlayers($season, $team)
    {
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.shipplayers', 'sp')
                ->join('sp.season', 's')
                ->join('sp.team', 't')
                ->where("s.name = :season")
                ->andWhere("t.translit = :team")
                ->setParameter('season', $season)
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }

    public function updatePlayerTurnirs($player_id, $cup, $eurocup, $supercup)
    {
        $sum = $cup + $eurocup + $supercup;

        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 's')
            ->set('s.cup', 's.cup+?2')
            ->set('s.eurocup', 's.eurocup+?3')
            ->set('s.supercup', 's.supercup+?4')
            ->set('s.sum', 's.sum+?7')
            ->where('s.id = ?1')
            ->setParameter(1, $player_id)
            ->setParameter(2, $cup)
            ->setParameter(3, $eurocup)
            ->setParameter(4, $supercup)
            ->setParameter(7, $sum)
            ->getQuery();

        $qb->execute();
    }

    public function updatePlayerLchGame($id, $change)
    {
        switch ($change)
        {
            case 'gamePlus' : $changeParam = 's.lch_game+1'; break;
            case 'gameMinus' : $changeParam = 's.lch_game-1'; break;
        }
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 's')
            ->set('s.lch_game', $changeParam)
            ->where('s.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $qb->execute();
    }

    public function updatePlayerLchGoal($id, $change)
    {
        switch ($change)
        {
            case 'goalPlus' : $changeParam = 's.lch_goal+1'; break;
            case 'goalMinus' : $changeParam = 's.lch_goal-1'; break;
        }
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 's')
            ->set('s.lch_goal', $changeParam)
            ->where('s.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $qb->execute();
    }

    public function updatePlayerLch($player, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 'r')
            ->set('r.lch_game', 'r.lch_game+1')
            ->set('r.lch_goal', 'r.lch_goal+?1')
            ->where('r.id = ?2')
            ->setParameter(1, $goal)
            ->setParameter(2, $player)
            ->getQuery();

        $qb->execute();
    }

    public function searchPlayers($arQuery)
    {
        $q = $this->createQueryBuilder('p')
            ->where("p.name LIKE '%$arQuery[0]%'")
            ->setMaxResults(20);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("p.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }
}
