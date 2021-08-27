<?php

namespace App\Repository;

use App\Entity\Cup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cup[]    findAll()
 * @method Cup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cup::class);
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getCurMatches()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) = 0')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getTomMatches()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) = 1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getSeasons()
    {
        return $this->createQueryBuilder('c')
                ->select('DISTINCT s.name')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->getQuery()
                ->getResult();
    }

    public function findAllBySeasonAndStadia($season, $stadia)
    {
        return $this->createQueryBuilder('c')
                ->select('c', 'st', 't', 't2', 's')
                ->join('c.season', 's')
                ->join('c.stadia', 'st')
                ->join('c.team', 't')
                ->join('c.team2', 't2')
                ->where('s.name = :season')
                ->andWhere('st.id = :stadia')
                ->setParameters([
                    'season' => $season,
                    'stadia' => $stadia
                    ])
                ->getQuery()
                ->getResult();
    }

    public function getTeams($season, $league = null)
    {
      $strJoin = 'c.team2';
      if($league == 2)
      {
        $strJoin = 'c.team';
      }

      return $this->createQueryBuilder('c')
              ->select('DISTINCT t.id', 't.name', 't.translit', 't.image')
              ->join($strJoin, 't')
              ->join('c.season', 's')
              ->join('c.stadia', 'st')
              ->where("s.name = :season")
              ->andWhere("st.name = :stadia")
              ->setParameters(['season' => $season, 'stadia' => '1/16 финала'])
              ->orderBy('t.name')
              ->getQuery()
              ->getResult()
              ;
    }

    public function findByTeamAndSeason($team, $season)
    {
        return $this->createQueryBuilder('c')
            ->select('c', 't', 't2', 's')
            ->join('c.season', 's')
            ->join('c.team', 't')
            ->join('c.team2', 't2')
            ->where('c.team = :team OR c.team2 = :team')
            ->andWhere('s.name = :season')
            ->setParameters([
                'season' => $season,
                'team' => $team
                ])
            ->getQuery()
            ->getResult();
    }

    public function getCupByTeam($teamId)
    {
        return $this->createQueryBuilder('c')
            ->join('c.season', 's')
            ->where('c.team = :team OR c.team2 = :team')
            ->setParameter('team', $teamId)
            ->orderBy('s.name', 'asc', 'c.data', 'asc')
            ->getQuery()
            ->getResult();
    }

    public function getEntity($max, $offset=null, $sort='id', $order='desc')
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.'.$sort, $order)
            ->setMaxResults($max)
            ;
        if ($offset)
        {
            $qb->setFirstResult($offset);
        }
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function countEntity()
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)');

        $query = $qb->getQuery();
        return $query->getSingleScalarResult();
    }
}
