<?php

namespace App\Repository;

use App\Entity\NhlReg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NhlReg|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlReg|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlReg[]    findAll()
 * @method NhlReg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlRegRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlReg::class);
    }

    public function getTeamStat($season, $id)
    {
      return $this->createQueryBuilder('sp')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->join('p.amplua', 'a')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('t.translit = :id')
          ->setParameter('id', $id)
          ->andWhere('a.name != :amplua')
          ->setParameter('amplua', 'вратарь')
          ->orderBy('sp.scoreSum DESC, sp.goalSum DESC, p.name')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getTeamGoalie($season, $id)
    {
      return $this->createQueryBuilder('sp')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->join('p.amplua', 'a')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('t.translit = :id')
          ->setParameter('id', $id)
          ->andWhere('a.name = :amplua')
          ->setParameter('amplua', 'вратарь')
          ->orderBy('sp.gameSum DESC, sp.missedSum ASC, p.name')
          ->getQuery()
          ->getResult()
      ;
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

    public function updateNhlplayers($arr, $fields)
    {
        $fields[] = 'scoreSum';

        $change = '+';
        $val = $arr[2];
        if($val < 0){
            $change = '-';
        }
        $val = abs($val);

        foreach($fields as $field){                      
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\NhlReg', 's')
                ->set('s.' . $field, 's.' . $field . $change .$val)
                ->where('s.id = ?1')
                ->setParameter(1, $arr[0])
                ->getQuery();

            $qb->execute();
        }
    }

    public function updateGamer($id, $change)
    {
        $changeParam7 = false;
        switch ($change) {
            case 'plusAssist' :
                $changeParam = 'g.assist';
                $changeParam2 = 'g.assist+1';
                $changeParam7 = 'g.score';
                $changeParam8 = 'g.scoreSum';
                $changeParam3 = 'g.score+1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.assistSum';
                $changeParam6 = 'g.assistSum+1';
                break;
            case 'minusAssist' :
                $changeParam = 'g.assist';
                $changeParam2 = 'g.assist-1';
                $changeParam3 = 'g.score-1';
                $changeParam4 = 'g.scoreSum-1';
                $changeParam5 = 'g.assistSum';
                $changeParam6 = 'g.assistSum-1';
                $changeParam7 = 'g.score';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'plusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal+1';
                $changeParam3 = 'g.score+1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.goalSum';
                $changeParam6 = 'g.goalSum+1';
                $changeParam7 = 'g.score';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'minusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal-1';
                $changeParam3 = 'g.score-1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.goalSum';
                $changeParam6 = 'g.goalSum-1';
                $changeParam7 = 'g.score';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'plusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game+1';
                $changeParam5 = 'g.gameSum';
                $changeParam6 = 'g.gameSum+1';
                break;
            case 'minusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game-1';
                $changeParam5 = 'g.gameSum';
                $changeParam6 = 'g.gameSum-1';
                break;
            case 'plusMissed' :
                $changeParam = 'g.missed';
                $changeParam2 = 'g.missed+1';
                $changeParam5 = 'g.missedSum';
                $changeParam6 = 'g.missedSum+1';
                break;
            case 'minusMissed' :
                $changeParam = 'g.missed';
                $changeParam2 = 'g.missed-1';
                $changeParam5 = 'g.missedSum';
                $changeParam6 = 'g.missedSum-1';
                break;
            case 'plusZero' :
                $changeParam = 'g.zero';
                $changeParam2 = 'g.zero+1';
                $changeParam5 = 'g.zeroSum';
                $changeParam6 = 'g.zeroSum+1';
                break;
            case 'minusZero' :
                $changeParam = 'g.zero';
                $changeParam2 = 'g.zero-1';
                $changeParam5 = 'g.zeroSum';
                $changeParam6 = 'g.zeroSum-1';
                break;
            case 'plusAssistPo' :
                $changeParam = 'g.assistPlayOff';
                $changeParam2 = 'g.assistPlayOff+1';
                $changeParam7 = 'g.scorePlayOff';
                $changeParam8 = 'g.scoreSum';
                $changeParam3 = 'g.scorePlayOff+1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.assistSum';
                $changeParam6 = 'g.assistSum+1';
                break;
            case 'minusAssistPo' :
                $changeParam = 'g.assistPlayOff';
                $changeParam2 = 'g.assistPlayOff-1';
                $changeParam3 = 'g.scorePlayOff-1';
                $changeParam4 = 'g.scoreSum-1';
                $changeParam5 = 'g.assistSum';
                $changeParam6 = 'g.assistSum-1';
                $changeParam7 = 'g.scorePlayOff';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'plusGoalPo' :
                $changeParam = 'g.goalPlayOff';
                $changeParam2 = 'g.goalPlayOff+1';
                $changeParam3 = 'g.scorePlayOff+1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.goalSum';
                $changeParam6 = 'g.goalSum+1';
                $changeParam7 = 'g.scorePlayOff';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'minusGoalPo' :
                $changeParam = 'g.goalPlayOff';
                $changeParam2 = 'g.goalPlayOff-1';
                $changeParam3 = 'g.scorePlayOff-1';
                $changeParam4 = 'g.scoreSum+1';
                $changeParam5 = 'g.goalSum';
                $changeParam6 = 'g.goalSum-1';
                $changeParam7 = 'g.scorePlayOff';
                $changeParam8 = 'g.scoreSum';
                break;
            case 'plusGamePo' :
                $changeParam = 'g.gamePlayOff';
                $changeParam2 = 'g.gamePlayOff+1';
                $changeParam5 = 'g.gameSum';
                $changeParam6 = 'g.gameSum+1';
                break;
            case 'minusGamePo' :
                $changeParam = 'g.gamePlayOff';
                $changeParam2 = 'g.gamePlayOff-1';
                $changeParam5 = 'g.gameSum';
                $changeParam6 = 'g.gameSum-1';
                break;
            case 'plusMissedPo' :
                $changeParam = 'g.missedPlayOff';
                $changeParam2 = 'g.missedPlayOff+1';
                $changeParam5 = 'g.missedSum';
                $changeParam6 = 'g.missedSum+1';
                break;
            case 'minusMissedPo' :
                $changeParam = 'g.missedPlayOff';
                $changeParam2 = 'g.missedPlayOff-1';
                $changeParam5 = 'g.missedSum';
                $changeParam6 = 'g.missedSum-1';
                break;
            case 'plusZeroPo' :
                $changeParam = 'g.zeroPlayOff';
                $changeParam2 = 'g.zeroPlayOff+1';
                $changeParam5 = 'g.zeroSum';
                $changeParam6 = 'g.zeroSum+1';
                break;
            case 'minusZeroPo' :
                $changeParam = 'g.zeroPlayOff';
                $changeParam2 = 'g.zeroPlayOff-1';
                $changeParam5 = 'g.zeroSum';
                $changeParam6 = 'g.zeroSum-1';
                break;
        }
        if($changeParam7){
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\NhlReg', 'g')
                ->set($changeParam, $changeParam2)
                ->set($changeParam7, $changeParam3)
                ->set($changeParam8, $changeParam4)
                ->set($changeParam5, $changeParam6)
                ->where('g.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();
        } else {
          $qb = $this->_em->createQueryBuilder()
              ->update('App\Entity\NhlReg', 'g')
              ->set($changeParam, $changeParam2)
              ->set($changeParam5, $changeParam6)
              ->where('g.id = ?1')
              ->setParameter(1, $id)
              ->getQuery();
        }
            $qb->execute();
    }

    public function getBomb($season)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('sp.score > 0')
          ->getQuery()
          ->getResult()
      ;
    }

    public function searchPlayers($arQuery, $season)
    {
        $q = $this->createQueryBuilder('n')
            ->join('n.player', 'p')
            ->join('n.season', 's')
            ->where('s.name = :season')
            ->setParameter('season', $season)
            ->andWhere("p.name LIKE '%$arQuery[0]%'")
            ->setMaxResults(10);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("p.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }

    public function getMinPlayers($season)
    {
        $q = $this->createQueryBuilder('n')
            ->join('n.player', 'p')
            ->join('n.season', 's')
            ->where('s.name = :season')
            ->setParameter('season', $season)
            ->andWhere("p.name LIKE '%$arQuery[0]%'")
            ->setMaxResults(10);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("p.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }

    public function updateTeamPlayer(int $id, int $team_id)
    {
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\NhlReg', 'g')
            ->set('g.team', '?2')
            ->where('g.id = ?1')
            ->setParameter(1, $id)
            ->setParameter(2, $team_id)
            ->getQuery();
        $qb->execute();
    }
}
