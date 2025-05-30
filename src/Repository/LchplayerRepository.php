<?php

namespace App\Repository;

use App\Entity\Lchplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lchplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lchplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lchplayer[]    findAll()
 * @method Lchplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LchplayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lchplayer::class);
    }

    public function getBomb($season)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 's')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->where("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere("lp.goal > 0")
              ->orderBy('lp.goal DESC, p.name')
              ->setMaxResults(20)
              ->getQuery()
              ->getResult();
    }

    public function getLchTeamStat($season, $id)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 't')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->join('lp.team', 't')
              ->where("s.name = :season")
              ->andWhere('t.translit = :id')
              ->setParameter('season', $season)
              ->setParameter('id', $id)
              ->orderBy('lp.game DESC, lp.goal DESC, p.name')
              ->getQuery()
              ->getResult();
    }

    public function getLchplayer($id)
    {
      return $this->createQueryBuilder('lp')
              ->select('lp', 'p', 't', 's')
              ->join('lp.player', 'p')
              ->join('lp.season', 's')
              ->join('lp.team', 't')
              ->join('t.country', 'c')
              ->where('p.translit = :id')
              ->setParameter('id', $id)
              ->andWhere('c.name != :russia')
              ->setParameter('russia', 'Россия')
              ->orderBy('s.name')
              ->getQuery()
              ->getResult();
    }

    public function updateLchplayerGoal($id, $change)
    {
      switch ($change) {
          case 'plusGame' :
              $changeParam = 's.game';
              $changeParam2 = 's.game+1';
              break;
          case 'minusGame' :
              $changeParam = 's.game';
              $changeParam2 = 's.game-1';
              break;
          case 'plusGoal' :
              $changeParam = 's.goal';
              $changeParam2 = 's.goal+1';
              break;
          case 'minusGoal' :
              $changeParam = 's.goal';
              $changeParam2 = 's.goal-1';
              break;
      }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Lchplayer', 's')
                ->set($changeParam, $changeParam2)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

}
