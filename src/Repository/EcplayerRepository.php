<?php

namespace App\Repository;

use App\Entity\Ecplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ecplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecplayer[]    findAll()
 * @method Ecplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcplayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecplayer::class);
    }

    public function findEcPlayersByTeam($id, $season)
    {
        return $this->createQueryBuilder('e')
                ->select('e', 'r')
                ->join('e.season', 's')
                ->join('e.player', 'r')
                ->join('e.team', 'tm')
                ->join('e.turnir', 't')
                ->where("tm.translit = :id")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'id' => $id,
                    'season' => $season,
                        ])
                ->orderBy('e.game DESC, e.goal DESC, r.name')
                ->getQuery()
                ->getResult();
    }

    public function getEcPlayer($id)
    {
      return $this->createQueryBuilder('ec')
              ->select('ec')
              ->join('ec.player', 'r')
              ->where("r.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }

    public function updateEcplayer($id, $change)
    {
      switch ($change) {
        case 'plusGame':
          $param1 = 'e.game';
          $param2 = 'e.game+1';
          break;
        case 'minusGame':
          $param1 = 'e.game';
          $param2 = 'e.game-1';
          break;
        case 'minusGoal':
          $param1 = 'e.goal';
          $param2 = 'e.goal-1';
          break;
        case 'plusGoal':
          $param1 = 'e.goal';
          $param2 = 'e.goal+1';
          break;
      }
        $qb = $this->_em->createQueryBuilder()
            ->update('App\Entity\Ecplayer', 'e')
            ->set($param1, $param2)
            ->where('e.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $qb->execute();
    }
}
