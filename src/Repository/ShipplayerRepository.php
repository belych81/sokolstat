<?php

namespace App\Repository;

use App\Entity\Shipplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shipplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipplayer[]    findAll()
 * @method Shipplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shipplayer::class);
    }

    public function getBombSum($season)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p', 't')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->orderBy('sp.sum DESC, p.name')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }

    public function getBomb5($season, $country)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->join('t.country', 'c')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('c.name = :country')
          ->setParameter('country', $country)
          ->orderBy('sp.goal DESC, p.name')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }

    public function getTeamStat($season, $id)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p', 't')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->where('s.name = :season')
          ->setParameter('season', $season)
          ->andWhere('t.translit = :id')
          ->setParameter('id', $id)
          ->orderBy('sp.goal DESC, p.name')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }

    public function getShipplayer($id)
    {
      return $this->createQueryBuilder('sp')
          ->select('sp', 'p', 's', 't')
          ->join('sp.season', 's')
          ->join('sp.team', 't')
          ->join('sp.player', 'p')
          ->where('p.translit = :id')
          ->setParameter('id', $id)
          ->orderBy('s.name, p.name')
          ->setMaxResults(20)
          ->getQuery()
          ->getResult()
      ;
    }

    public function updateShipplayerGoal($id, $change)
    {
        switch ($change) {
            case 'plus' : $changeParam = 's.goal+1'; $changeParam1 = 's.sum+1'; break;
            case 'minus' : $changeParam = 's.goal-1'; $changeParam1 = 's.sum-1'; break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Shipplayer', 's')
                ->set('s.goal', $changeParam)
                ->set('s.sum', $changeParam1)
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }

    public function updateShipplayerSum($id, $goal, $cup, $supercup, $eurocup)
    {
            $sum = $goal+$cup+$supercup+$eurocup;

            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Shipplayer', 's')
                ->set('s.sum', 's.sum+?2')
                ->where('s.id = ?1')
                ->setParameter(1, $id)
                ->setParameter(2, $sum)
                ->getQuery();

            $qb->execute();
        }

}
