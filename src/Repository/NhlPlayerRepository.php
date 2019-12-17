<?php

namespace App\Repository;

use App\Entity\NhlPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NhlPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayer[]    findAll()
 * @method NhlPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
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
                $changeParam = 'r.zero';
                $changeParam2 = 'r.zero-1';
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
}
