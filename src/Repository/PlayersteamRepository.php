<?php

namespace App\Repository;

use App\Entity\Playersteam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Playersteam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playersteam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playersteam[]    findAll()
 * @method Playersteam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayersteamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Playersteam::class);
    }

    public function getStat($name, $team, $param)
    {
        switch ($param) {
            case 'game' : $select = 'p.game'; break;
            case 'goal' : $select = 'p.goal'; break;
        }
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

    public function updatePlayersteam($player, $team, $change)
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
            default:
                $changeParam = 'r.game';
                $changeParam2 = 'r.game+1';
        }
        if(is_int($change)) {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Playersteam', 'r')
                ->set('r.game', 'r.game+1')
                ->set('r.goal', "r.goal+$change")
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->andWhere('r.team = ?3')
                ->setParameter(3, $team)
                ->getQuery();
        } else {
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Playersteam', 'r')
                ->set($changeParam, $changeParam2)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->andWhere('r.team = ?3')
                ->setParameter(3, $team)
                ->getQuery();
        }
            $qb->execute();
    }

    public function updateTotalTeam($player, $team, $change)
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
                ->update('App\Entity\Playersteam', 'r')
                ->set($changeParam, $changeParam2)
                ->where('r.player = ?2')
                ->setParameter(2, $player)
                ->andWhere('r.team = ?3')
                ->setParameter(3, $team)
                ->getQuery();

            $qb->execute();
    }
}
