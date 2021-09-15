<?php

namespace App\Repository;

use App\Entity\CupLeague;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CupLeague|null find($id, $lockMode = null, $lockVersion = null)
 * @method CupLeague|null findOneBy(array $criteria, array $orderBy = null)
 * @method CupLeague[]    findAll()
 * @method CupLeague[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupLeagueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CupLeague::class);
    }

    public function getSeasons()
    {
        return $this->createQueryBuilder('c')
                ->select('DISTINCT s.name')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->orderBy('s.name', 'ASC')
                ->getQuery()
                ->getResult();
    }

    public function findAllBySeasonAndStadia($season, $stadia)
    {
        $qb = $this->createQueryBuilder('c')
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
                ->orderBy('c.data', 'ASC')
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('n')
          ->where('DATE_DIFF(n.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('n.data', 'ASC')
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

}
