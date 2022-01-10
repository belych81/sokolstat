<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function getLastMatchesByTeam($season, $team)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->join('t.team2', 'tm2')
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere("tm.translit = :team OR tm2.translit = :team")
              ->setParameter('team', $team)
              ->andWhere('t.status = 0')
              ->orderBy('t.data', 'DESC')
              ->setMaxResults(10)
              ->getQuery()
              ->getResult();
    }

    public function getTours($country, $season)
    {
      return $this->createQueryBuilder('t')
              ->select('DISTINCT t.tour')
              ->join('t.turnir', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.alias = :country")
              ->setParameter('country', $country."-champ")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.tour', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getMaxTour($country, $season) {

        $qb = $this->createQueryBuilder('t')
                ->select('t.tour')
                ->join('t.turnir', 'c')
                ->join('t.season', 's')
                ->where("c.alias = :country")
                ->setParameter('country', $country.'-champ')
                ->andWhere("s.name = :season")
                ->setParameter('season', $season)
                ->orderBy('t.id', 'DESC')
                ->setMaxResults(1);

        $query = $qb->getQuery();

        if ($query->getScalarResult()) {
            return $query->getSingleScalarResult();
        }

        return $query->getOneOrNullResult();
    }

    public function getMatches($country, $season, $tour)
    {
      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.turnir', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.alias = :country")
              ->setParameter('country', $country."-champ")
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->andWhere("t.tour = :tour")
              ->setParameter('tour', $tour)
              ->orderBy('t.data', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getCurMatches()
    {
      return $this->createQueryBuilder('r')
          ->where('DATE_DIFF(r.data, :data) = 0')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('r.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function getYesterdayMatches()
    {
      return $this->createQueryBuilder('r')
          ->where('DATE_DIFF(r.data, :data) = -1')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('r.data', 'ASC')
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

    public function getSeasons($turnir)
    {
        return $this->createQueryBuilder('c')
                ->select('DISTINCT s.name')
                ->join('c.season', 's')
                ->join('c.team', 't')
                ->join('c.turnir', 'cn')
                ->where('cn.alias = :turnir')
                ->setParameter('turnir', $turnir)
                ->orderBy('s.name', 'ASC')
                ->getQuery()
                ->getResult();
    }

    public function findAllBySeasonAndStadiaAndCountry($season, $stadia, $country)
    {
        $qb = $this->createQueryBuilder('c')
                ->select('c', 'st', 't', 't2', 's')
                ->join('c.season', 's')
                ->join('c.stadia', 'st')
                ->join('c.turnir', 'cn')
                ->join('c.team', 't')
                ->join('c.team2', 't2')
                ->where('s.name = :season')
                ->andWhere('st.id = :stadia')
                ->andWhere('cn.alias = :country')
                ->setParameters([
                    'season' => $season,
                    'stadia' => $stadia,
                    'country' => $country."-cup"
                    ])
                ->orderBy('c.data', 'ASC')
                ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

}
