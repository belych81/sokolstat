<?php

namespace App\Repository;

use App\Entity\NationCup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NationCup|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationCup|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationCup[]    findAll()
 * @method NationCup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationCupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
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
                ->select('c','s')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->groupBy('s')
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
}
