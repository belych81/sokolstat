<?php

namespace App\Repository;

use App\Entity\NationCup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NationCup|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationCup|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationCup[]    findAll()
 * @method NationCup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationCupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NationCup::class);
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

    public function getSeasons()
    {
        return $this->createQueryBuilder('c')
                ->select('DISTINCT s.name')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->getQuery()
                ->getResult();
    }

    public function findAllBySeasonAndStadiaAndCountry($season, $stadia, $country)
    {
        $qb = $this->createQueryBuilder('c')
                ->select('c', 'st', 't', 't2', 's')
                ->join('c.season', 's')
                ->join('c.stadia', 'st')
                ->join('c.country', 'cn')
                ->join('c.team', 't')
                ->join('c.team2', 't2')
                ->where('s.name = :season')
                ->andWhere('st.id = :stadia')
                ->andWhere('cn.name = :country')
                ->setParameters([
                    'season' => $season,
                    'stadia' => $stadia,
                    'country' => $country
                    ])
                ->orderBy('c.data', 'ASC')
                ;

        $query = $qb->getQuery();

        return $query->getResult();
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
}
