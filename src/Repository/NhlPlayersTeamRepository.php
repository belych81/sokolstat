<?php

namespace App\Repository;

use App\Entity\NhlPlayersTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NhlPlayersTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayersTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayersTeam[]    findAll()
 * @method NhlPlayersTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayersTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NhlPlayersTeam::class);
    }

    public function getStat($name, $team)
    {
        $qb = $this->createQueryBuilder('p')
                ->join('p.team', 't')
                ->join('p.player', 'n')
                ->where("n.name = :name")
                ->setParameter('name', $name)
                ->andWhere("t.translit = :team")
                ->setParameter('team', $team);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function updateNhlplayers($player, $team, $arr, $fields)
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
                ->update('App\Entity\NhlPlayersTeam', 's')
                ->set('s.' . $field, 's.' . $field . $change .$val)
                ->where('s.player = ?2')
                ->setParameter(2, $player)
                ->andWhere('s.team = ?3')
                ->setParameter(3, $team)
                ->getQuery();

            $qb->execute();
        }
    }

    public function updatePlayersteam($player, $team, $change)
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
              $changeParam = 'r.zero';
              $changeParam2 = 'r.zero-1';
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
                ->update('App\Entity\NhlPlayersTeam', 'r')
                ->set($changeParam, $changeParam2)
                ->set($changeParam3, $changeParam4)
                ->set($changeParam5, $changeParam6)
                ->set($changeParam7, $changeParam8)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->andWhere('r.team = ?3')
                ->setParameter(3, $team)
                ->getQuery();
        } else {
          $qb = $this->_em->createQueryBuilder()
              ->update('App\Entity\NhlPlayersTeam', 'r')
              ->set($changeParam, $changeParam2)
              ->set($changeParam5, $changeParam6)
              ->where('r.player = ?2')
              ->setParameter(2, $player)
              ->andWhere('r.team = ?3')
              ->setParameter(3, $team)
              ->getQuery();
        }
            $qb->execute();
    }
}
