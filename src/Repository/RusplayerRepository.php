<?php

namespace App\Repository;

use App\Entity\Rusplayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rusplayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rusplayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rusplayer[]    findAll()
 * @method Rusplayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RusplayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rusplayer::class);
    }

    public function getTopPlayers($max, $type) {

            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->orderBy('r.'.$type, 'DESC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopGoalkeepers($max) {

            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->orderBy('r.goal', 'ASC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopPlayersCurr($max, $type, $season) {

            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->leftJoin('p.gamers', 'g')
                ->join('g.season', 's')
                ->where('s.name = ?1')
                ->setParameter(1, $season)
                ->orderBy('r.'.$type, 'DESC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getTopGoalkeepersCurr($max, $season)
    {
            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->leftJoin('p.gamers', 'g')
                ->join('g.season', 's')
                ->where('s.name = ?1')
                ->setParameter(1, $season)
                ->andWhere('r.goal < 0')
                ->orderBy('r.goal', 'ASC')
                ->setMaxResults($max)
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function countPlayers($country=null, $team=null)
    {
        if($team && $team != 'Команда') {
        $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->leftJoin('p.playersteams', 'pt')
                ->join('pt.team', 'tm')
                ->where('r.totalgame > 0')
                ;
        } else {
            $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->where('r.totalgame > 0');
        }
        if($country && $country != 'Страна') {
            $qb->where('c.name = ?1')
                ->setParameter(1, $country);
        }
        if($team && $team != 'Команда') {
            $qb->andWhere('tm.name = ?2')
                ->setParameter(2, $team);
        }
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getPlayers($max, $sort, $order='desc', $offset=null, $country=null,
      $team=null)
    {
        if($team && $team != 'Команда')
        {
            if($sort == 'totalgame')
            {
                $sortBy = 'r.totalgame';
            }
            elseif($sort == 'totalgoal')
            {
                $sortBy = 'r.totalgoal';
            }
            else
            {
                $sortBy='pt.'.$sort;
            }
          if ($sort == 'born')
          {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->leftJoin('p.playersteams', 'pt')
                  ->join('pt.team', 'tm')
                  ->where('r.totalgame > 0')
                  ->orderBy('p.born', $order)
                  ->setMaxResults($max);
          }
          else
          {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->leftJoin('p.playersteams', 'pt')
                  ->join('pt.team', 'tm')
                  ->where('r.totalgame > 0')
                  ->orderBy($sortBy, 'DESC')
                  ->setMaxResults($max)
                  ;
          }
        }
        else
        {
            if ($sort == 'born')
            {
            $qb = $this->createQueryBuilder('r')
                ->join('r.player', 'p')
                ->join('p.country', 'c')
                ->where('r.totalgame > 0')
                ->orderBy('p.born', $order)
                ->setMaxResults($max);
            }
            else
            {
              $qb = $this->createQueryBuilder('r')
                  ->join('r.player', 'p')
                  ->join('p.country', 'c')
                  ->where('r.totalgame > 0')
                  ->orderBy('r.'.$sort, 'DESC')
                  ->setMaxResults($max)
                  ;
            }
        }

        if($country && $country != 'Страна')
        {
            $qb->where('c.name = ?1')
                ->setParameter(1, $country);
        }

        if($team && $team != 'Команда')
        {
            $qb->andWhere('tm.name = ?2')
                ->setParameter(2, $team);
        }

        if ($offset)
        {
            $qb->setFirstResult($offset);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
