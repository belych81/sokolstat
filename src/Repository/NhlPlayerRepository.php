<?php

namespace App\Repository;

use App\Entity\NhlPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NhlPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayer[]    findAll()
 * @method NhlPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlPlayer::class);
    }

    public function updateNhlPlayer($playerId, $goal, $turnir)
    {
      if($turnir == 1)
      {
        $qb = $this->getEntityManager()->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'p')
                ->set('p.goalReg', 'p.goalReg + ?3')
                ->set('p.goalSum', 'p.goalSum + ?2')
                ->where('p.id = ?1')
                ->setParameter(1, $playerId)
                ->setParameter(2, $goal)
                ->setParameter(3, $goal)
                ->getQuery();
      }
      elseif($turnir == 2)
      {
        $qb = $this->getEntityManager()->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'p')
                ->set('p.goalPlayOff', 'p.goalPlayOff + ?3')
                ->set('p.goalSum', 'p.goalSum + ?2')
                ->where('p.id = ?1')
                ->setParameter(1, $playerId)
                ->setParameter(2, $goal)
                ->setParameter(3, $goal)
                ->getQuery();
      }
      else
      {
        return;
      }

          $qb->execute();
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
                ->leftJoin('p.nhlPlayersTeams', 'pt')
                ->join('pt.team', 't')
                ->where("t.translit = :team")
                ->setParameter('team', $team)
                ->orderBy('pt.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery();

        return $query->getSingleResult();
    }

    public function updateStatPlayer($player, $change)
    {
        $changeParam7 = false;
        switch ($change) {
            case 'plusAssist' :
                $changeParam = 'r.assistReg';
                $changeParam2 = 'r.assistReg+1';
                $changeParam3 = 'r.scoreReg';
                $changeParam4 = 'r.scoreReg+1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum+1';
                $changeParam7 = 'r.assistSum';
                $changeParam8 = 'r.assistSum+1';
                break;
            case 'minusAssist' :
                $changeParam = 'r.assistReg';
                $changeParam2 = 'r.assistReg-1';
                $changeParam3 = 'r.scoreReg';
                $changeParam4 = 'r.scoreReg-1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum-1';
                $changeParam7 = 'r.assistSum';
                $changeParam8 = 'r.assistSum-1';
                break;
            case 'plusGoal' :
                $changeParam = 'r.goalReg';
                $changeParam2 = 'r.goalReg+1';
                $changeParam3 = 'r.scoreReg';
                $changeParam4 = 'r.scoreReg+1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum+1';
                $changeParam7 = 'r.goalSum';
                $changeParam8 = 'r.goalSum+1';
                break;
            case 'minusGoal' :
                $changeParam = 'r.goalReg';
                $changeParam2 = 'r.goalReg-1';
                $changeParam3 = 'r.scoreReg';
                $changeParam4 = 'r.scoreReg-1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum-1';
                $changeParam7 = 'r.goalSum';
                $changeParam8 = 'r.goalSum-1';
                break;
            case 'plusGame' :
                $changeParam = 'r.gameReg';
                $changeParam2 = 'r.gameReg+1';
                $changeParam5 = 'r.gameSum';
                $changeParam6 = 'r.gameSum+1';
                break;
            case 'minusGame' :
                $changeParam = 'r.gameReg';
                $changeParam2 = 'r.gameReg-1';
                $changeParam5 = 'r.gameSum';
                $changeParam6 = 'r.gameSum-1';
                break;
            case 'plusMissed' :
                $changeParam = 'r.missedReg';
                $changeParam2 = 'r.missedReg+1';
                $changeParam5 = 'r.missedSum';
                $changeParam6 = 'r.missedSum+1';
                break;
            case 'minusMissed' :
                $changeParam = 'r.missedReg';
                $changeParam2 = 'r.missedReg-1';
                $changeParam5 = 'r.missedSum';
                $changeParam6 = 'r.missedSum-1';
            case 'plusZero' :
                $changeParam = 'r.zeroReg';
                $changeParam2 = 'r.zeroReg+1';
                $changeParam5 = 'r.zeroSum';
                $changeParam6 = 'r.zeroSum+1';
                break;
            case 'minusZero' :
                $changeParam = 'r.zeroReg';
                $changeParam2 = 'r.zeroReg-1';
                $changeParam5 = 'r.zeroSum';
                $changeParam6 = 'r.zeroSum-1';
                break;
            case 'plusAssistPo' :
                $changeParam = 'r.assistPlayOff';
                $changeParam2 = 'r.assistPlayOff+1';
                $changeParam3 = 'r.scorePlayOff';
                $changeParam4 = 'r.scorePlayOff+1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum+1';
                $changeParam7 = 'r.assistSum';
                $changeParam8 = 'r.assistSum+1';
                break;
            case 'minusAssistPo' :
                $changeParam = 'r.assistPlayOff';
                $changeParam2 = 'r.assistPlayOff-1';
                $changeParam3 = 'r.scorePlayOff';
                $changeParam4 = 'r.scorePlayOff-1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum-1';
                $changeParam7 = 'r.assistSum';
                $changeParam8 = 'r.assistSum-1';
                break;
            case 'plusGoalPo' :
                $changeParam = 'r.goalPlayOff';
                $changeParam2 = 'r.goalPlayOff+1';
                $changeParam3 = 'r.scorePlayOff';
                $changeParam4 = 'r.scorePlayOff+1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum+1';
                $changeParam7 = 'r.goalSum';
                $changeParam8 = 'r.goalSum+1';
                break;
            case 'minusGoalPo' :
                $changeParam = 'r.goalPlayOff';
                $changeParam2 = 'r.goalPlayOff-1';
                $changeParam3 = 'r.scorePlayOff';
                $changeParam4 = 'r.scorePlayOff-1';
                $changeParam5 = 'r.scoreSum';
                $changeParam6 = 'r.scoreSum-1';
                $changeParam7 = 'r.goalSum';
                $changeParam8 = 'r.goalSum-1';
                break;
            case 'plusGamePo' :
                $changeParam = 'r.gamePlayOff';
                $changeParam2 = 'r.gamePlayOff+1';
                $changeParam5 = 'r.gameSum';
                $changeParam6 = 'r.gameSum+1';
                break;
            case 'minusGamePo' :
                $changeParam = 'r.gamePlayOff';
                $changeParam2 = 'r.gamePlayOff-1';
                $changeParam5 = 'r.gameSum';
                $changeParam6 = 'r.gameSum-1';
                break;
            case 'plusMissedPo' :
                $changeParam = 'r.missedPlayOff';
                $changeParam2 = 'r.missedPlayOff+1';
                $changeParam5 = 'r.missedSum';
                $changeParam6 = 'r.missedSum+1';
                break;
            case 'minusMissedPo' :
                $changeParam = 'r.missedPlayOff';
                $changeParam2 = 'r.missedPlayOff-1';
                $changeParam5 = 'r.missedSum';
                $changeParam6 = 'r.missedSum-1';
            case 'plusZeroPo' :
                $changeParam = 'r.zeroPlayOff';
                $changeParam2 = 'r.zeroPlayOff+1';
                $changeParam5 = 'r.zeroSum';
                $changeParam6 = 'r.zeroSum+1';
                break;
            case 'minusZeroPo' :
                $changeParam = 'r.zeroPlayOff';
                $changeParam2 = 'r.zeroPlayOff-1';
                $changeParam5 = 'r.zeroSum';
                $changeParam6 = 'r.zeroSum-1';
                break;
        }
        if($changeParam7){
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->set($changeParam5, $changeParam6)
                ->set($changeParam7, $changeParam8)
                ->where('r.id = ?2')
                ->setParameter(2, $player)
                ->getQuery();
        } else {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam5, $changeParam6)
                ->where('r.id = ?2')
                ->setParameter(2, $player)
                ->getQuery();
        }
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

    public function queryLchPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        if(!intval($year)){
            $year = 2022;
        }
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->orderBy('p.name');
    }

    public function queryPlayersteam($season, $team)
    {
        $year = \substr($season, 0, 4);
        if(!intval($year)){
            $year = 2022;
        }
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.nhlPlayersTeams', 'pt')
                ->join('pt.team', 't')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("t.translit = :team")
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }
}
