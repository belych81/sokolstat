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

    public function getTopGoalkeepersCurr($max, $season) {

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
}
