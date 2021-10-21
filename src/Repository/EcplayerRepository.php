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

    public function countEntity(array $arFilter)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)');
        foreach($arFilter as $field => $value){
          if(!empty($value) && $value != 'all'){
            switch($field){
              case 'season':
                $qb->join('r.season', 's')
                    ->andWhere('s.id = :season')
                    ->setParameter('season', $value);
                break;
              case 'team':
                $qb->join('r.team', 't')
                    ->andWhere('t.id = :team')
                    ->setParameter('team', $value);
                break;
            }
          }
        }
        $query = $qb->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getEntity($max, $offset=null, $sort='id', $order='desc', array $arFilter)
    {
        $qb = $this->createQueryBuilder('r');
        switch($sort){
          case 'born':
            $qb->join('r.player', 'p')
                ->orderBy('p.born', $order);
            break;
          case 'player':
            $qb->join('r.player', 'p')
                ->orderBy('p.name', $order);
            break;
          case 'season':
            $qb->join('r.season', 's')
                ->orderBy('s.name', $order);
            break;
          case 'team':
            $qb->join('r.team', 't')
                ->orderBy('t.name', $order);
            break;
          case 'country':
            $qb->join('r.player', 'p')
                ->join('p.country', 'c')
                ->orderBy('c.name', $order);
            break;
          default:
            $qb->orderBy('r.'.$sort, $order);
        }
        if ($offset)
        {
            $qb->setFirstResult($offset);
        }
        foreach($arFilter as $field => $value){
          if(!empty($value) && $value != 'all'){
            switch($field){
              case 'season':
                $qb->join('r.season', 's')
                    ->andWhere('s.id = :season')
                    ->setParameter('season', $value);
                break;
              case 'team':
                $qb->join('r.team', 't')
                    ->andWhere('t.id = :team')
                    ->setParameter('team', $value);
                break;
                case 'country':
                  $qb->join('r.player', 'p')
                    ->join('p.country', 'c')
                    ->andWhere('c.id = :country')
                    ->setParameter('country', $value);
            }
          }
        }
        $qb->setMaxResults($max);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
