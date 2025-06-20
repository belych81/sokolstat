<?php

namespace App\Repository;

use App\Entity\Player;
use App\Service\Props;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function getListPlayer($limit = 0)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.name, p.translit, p.born, c.name as country')
            ->join('p.country', 'c')
            ->orderBy('p.born', 'ASC');

        if($limit > 0)
        {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getPopular($n = 20)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.name, p.translit, p.viewed')
            ->orderBy('p.viewed', 'DESC')
            ->setMaxResults($n);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getSeems($id, $country, $n = 20)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.name, p.translit')
            ->join('p.country', 'c')
            ->where('c.name = :country')
            ->setParameter('country', $country)
            ->orderBy('p.viewed', 'DESC')
            ->setMaxResults($n);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getBirthdayPlayer($data)
    {
        $qb = $this->createQueryBuilder('p')
              ->select('p.id, p.name, p.translit, TIMESTAMPDIFF(YEAR, p.born, CURRENT_TIMESTAMP()) age')
              ->where('DAY(p.born) = DAY(CURRENT_TIMESTAMP())')
              ->andWhere('MONTH(p.born) = MONTH(CURRENT_TIMESTAMP())')
              ->orderBy('p.viewed', 'DESC', 'p.born', 'ASC')
              ->setMaxResults(30);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getLastPlayer() {

        $qb = $this->createQueryBuilder('p')
                ->select('p.name, p.id, p.translit')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(11);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getMaxId() {

        $query = $this->createQueryBuilder('p')
                ->select('MAX(p.id)')
                ->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getLastOnePlayer() {

        $query = $this->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery();

        return $query->getSingleResult();
    }

    public function getLastTeamPlayer($team) {

        $query = $this->createQueryBuilder('p')
                ->leftJoin('p.playersteams', 'pt')
                ->join('pt.team', 't')
                ->where("t.translit = :team")
                ->setParameter('team', $team)
                ->orderBy('pt.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery();

        return $query->getSingleResult();
    }

    public function queryRusTeamPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
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
        $start = $year-42;
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

    public function querySbPlayers($season)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->join('p.country', 'c')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("c.name = 'Россия'")
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

    public function updatePlayerGame($id, $change, $game = 0)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = "s.game+1";
                 break;
            case 'minusGame' :
                $changeParam = "s.game-1";
                break;
            default :
                $changeParam = "s.game+$game";
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Player', 's')
                ->set('s.game', $changeParam)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function updateShipplayerSumGame($arr)
    {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Player', 's')
                ->set('s.game', 's.game+'.$arr[2])
                ->where('s.id = ?1')
                ->setParameter(1, $arr[1])
                ->getQuery();

            $qb->execute();
    }

    public function updatePlayerTotalGoal($id, $change, $goal = 0)
    {
        switch ($change) {
            case 'plusGoal' :
                $changeParam = "s.goal+1";
                $changeParam1 = "s.sum+1";
                 break;
            case 'minusGoal' :
                $changeParam = "s.goal-1";
                $changeParam1 = "s.sum-1";
                break;
            default :
                $changeParam = "s.goal+$goal";
                $changeParam1 = "s.sum+$goal";
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Player', 's')
                ->set('s.goal', $changeParam)
                ->set('s.sum', $changeParam1)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function updatePlayerGoal($id, $change, $goal=0, $cup=0,
      $supercup=0, $eurocup=0, $game=0, $sbornie=0)
    {
        switch ($change) {
            case 'plus' :
                $changeParam = "s.goal+$goal";
                $changeParam1 = "s.sum+1";
                $changeParam2 = "s.cup+$cup";
                $changeParam3 = "s.supercup+$supercup";
                $changeParam4 = "s.eurocup+$eurocup";
                $changeParam5 = "s.game";
                $changeParam6 = "s.sbornie+$sbornie";
                 break;
            case 'minus' :
                $changeParam = "s.goal-$goal";
                $changeParam1 = "s.sum-1";
                $changeParam2 = "s.cup-$cup";
                $changeParam3 = "s.supercup-$supercup";
                $changeParam4 = "s.eurocup-$eurocup";
                $changeParam6 = "s.sbornie-$sbornie";
                break;
            default :
                $changeParam = "s.goal+$goal";
                $changeParam1 = "s.sum+$goal+$cup+$supercup+$eurocup";
                $changeParam2 = "s.cup+$cup";
                $changeParam3 = "s.supercup+$supercup";
                $changeParam4 = "s.eurocup+$eurocup";
                $changeParam6 = "s.sbornie+$sbornie";
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Player', 's')
                ->set('s.goal', $changeParam)
                ->set('s.cup', $changeParam2)
                ->set('s.supercup', $changeParam3)
                ->set('s.eurocup', $changeParam4)
                ->set('s.sbornie', $changeParam6)
                ->set('s.sum', $changeParam1)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function queryLchPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                //->leftJoin('p.shipplayers', 's')
                //->leftJoin('p.gamers', 'g')
                //->leftJoin('p.lchplayers', 'l')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                //->orderBy('p.name')
                ;
    }

    public function queryRfplTrainers($season)
    {
        $year = \substr($season, 0, 4);
        $start = $year-75;
        $end = $year-32;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                //->orderBy('p.name')
                ;
    }

    public function queryTeamPlayers($season, $team, $country = [])
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';

        $props = new Props();
        $tops = $props->getTops();
        $noTops = $props->getNoTops();

        if(empty($country) || in_array($country, $tops) || in_array($country, $noTops)) {
          $relation = 'shipplayers';
        } elseif($country == 'Россия') {
          $relation = 'gamers';
        } else {
          $relation = 'lchplayers';
        }

        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.'.$relation, 's')
                ->join('s.team', 'st')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->andWhere('st.translit = :team')
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }

    public function queryTop5Players($season, $country)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->join('p.shipplayers', 's')
                ->join('s.team', 't')
                ->join('t.country', 'c')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->andWhere("c.name != :country")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->setParameter('country', $country)
                ->orderBy('p.name');
    }

    public function queryLChampPlayers($season)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->join('p.lchplayers', 's')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->orderBy('p.name');
    }

    public function queryMundialPlayers($season)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->join('p.sostavs', 's')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->orderBy('p.name');
    }

    public function queryCountryPlayers($season, $team, $country)
    {
        $year = \substr($season, 0, 4);
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';

        $props = new Props();
        $tops = $props->getTops();
        $noTops = $props->getNoTops();

        if(empty($country) || in_array($country, $tops) || in_array($country, $noTops)) {
          $relation = 'shipplayers';
        } elseif($country == 'Россия') {
          $relation = 'gamers';
        } else {
          $relation = 'lchplayers';
        }

        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.'.$relation, 's')
                ->join('s.team', 'st')
                ->join('st.country', 'c')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->andWhere('c.name = :country')
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->setParameter('country', $country)
                ->orderBy('p.name');
    }

    public function queryMundPlayers($year, $country)
    {
        $start = $year-42;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
          ->join('p.country', 'c')
          ->where("p.born BETWEEN :str_start AND :str_end")
          ->andWhere('c.translit = :country')
          ->setParameter('str_start', $str_start)
          ->setParameter('str_end', $str_end)
          ->setParameter('country', $country)
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

    public function queryUpdateFnlPlayers($season, $team)
    {
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.fnlplayers', 'f')
                ->join('f.season', 's')
                ->join('f.team', 't')
                ->where("s.name = :season")
                ->andWhere("t.translit = :team")
                ->setParameter('season', $season)
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }

    public function updatePlayerTurnirs($player_id, $game, $goal, $cup, $eurocup,
      $supercup)
    {
        $sum = $goal + $cup + $eurocup + $supercup;
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 's')
            ->set('s.game', 's.game+:game')
            ->set('s.goal', 's.goal+:goal')
            ->set('s.cup', 's.cup+:cup')
            ->set('s.eurocup', 's.eurocup+:eurocup')
            ->set('s.supercup', 's.supercup+:supercup')
            ->set('s.sum', 's.sum+:sum')
            ->where('s.id = :player')
            ->setParameters(['player'=>$player_id, 'cup'=>$cup, 'eurocup'=>$eurocup, 'supercup'=>$supercup, 'sum'=>$sum, 'game'=>$game, 'goal'=>$goal])
            ->getQuery();

        $qb->execute();
    }

    public function updatePlayerLchGame($id, $change)
    {
        switch ($change)
        {
            case 'plusGame' : $changeParam = 's.lch_game+1'; break;
            case 'minusGame' : $changeParam = 's.lch_game-1'; break;
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
            case 'plusGoal' : $changeParam = 's.lch_goal+1'; break;
            case 'minusGoal' : $changeParam = 's.lch_goal-1'; break;
        }
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 's')
            ->set('s.lch_goal', $changeParam)
            ->where('s.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $qb->execute();
    }

    public function updatePlayerLch($player, $game, $goal)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 'r')
            ->set('r.lch_game', 'r.lch_game+?1')
            ->set('r.lch_goal', 'r.lch_goal+?2')
            ->where('r.id = ?3')
            ->setParameter(1, $game)
            ->setParameter(2, $goal)
            ->setParameter(3, $player)
            ->getQuery();

        $qb->execute();
    }

    public function viewedPlayer($player)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Player', 'r')
            ->set('r.viewed', 'r.viewed+1')
            ->where('r.id = ?1')
            ->setParameter(1, $player)
            ->getQuery();

        $qb->execute();
    }

    public function searchPlayers($arQuery)
    {
        $q = $this->createQueryBuilder('p')
            ->where("p.born LIKE '%$arQuery[0]%'")
            ->orWhere("p.name LIKE '%$arQuery[0]%'")
            ->setMaxResults(10);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("p.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }

    public function countPlayers($country=null)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)')
            ->join('r.country', 'c');

        if($country && $country != 'all') {
            $qb->where('c.translit = ?1')
                ->setParameter(1, $country);
        }
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getPlayers($max, $sort, $order='desc', $offset=null, $country=null)
    {
        if ($sort == 'born')
        {
        $qb = $this->createQueryBuilder('p')
            ->join('p.country', 'c')
            ->orderBy('p.born', $order)
            ->setMaxResults($max);
        }
        else
        {
            $qb = $this->createQueryBuilder('p')
                ->join('p.country', 'c')
                ->orderBy('p.'.$sort, $order)
                ->setMaxResults($max)
                ;
        }

        if($country && $country != 'all')
        {
            $qb->where('c.translit = ?1')
                ->setParameter(1, $country);
        }

        if ($offset)
        {
            $qb->setFirstResult($offset);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
