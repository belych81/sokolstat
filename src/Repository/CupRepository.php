<?php

namespace App\Repository;

use App\Entity\Cup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cup[]    findAll()
 * @method Cup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
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
                ->select('c','s')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->groupBy('s')
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
              ->select('t.id', 't.name', 't.translit')
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
}
