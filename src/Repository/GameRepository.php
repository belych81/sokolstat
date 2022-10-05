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

    public function getLastMatchesByTeam($season, $team, $cntLastMatches)
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
              ->setMaxResults($cntLastMatches)
              ->getQuery()
              ->getResult();
    }

    public function getTours($country, $season)
    {
      if($country != 'fnl'){
        $country .= '-champ';
      }

      return $this->createQueryBuilder('t')
              ->select('DISTINCT t.tour')
              ->join('t.turnir', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.alias = :country")
              ->setParameter('country', $country)
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.tour', 'ASC')
              ->getQuery()
              ->getResult();
    }

    public function getMaxTour($country, $season)
    {
        if($country != 'fnl'){
          $country .= '-champ';
        }

        $qb = $this->createQueryBuilder('t')
                ->select('t.tour')
                ->join('t.turnir', 'c')
                ->join('t.season', 's')
                ->where("c.alias = :country")
                ->setParameter('country', $country)
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
      if($country != 'fnl'){
        $country .= '-champ';
      }

      return $this->createQueryBuilder('t')
              ->select('t')
              ->join('t.turnir', 'c')
              ->join('t.season', 's')
              ->join('t.team', 'tm')
              ->where("c.alias = :country")
              ->setParameter('country', $country)
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

    public function getMatchesTomm()
    {
      return $this->createQueryBuilder('c')
          ->where('DATE_DIFF(c.data, :data) >= -2')
          ->setParameter('data', date('Y-m-d', time()))
          ->orderBy('c.data', 'ASC')
          ->getQuery()
          ->getResult()
      ;
    }

    public function findByLastWeek($data, $noFnl = false, $turnir = false, $noTurnir = false)
    {
       $qb = $this->createQueryBuilder('t')
            ->join('t.team', 'tm')
            ->join('t.turnir', 'tr')
            ->where('t.data >= :data')
            ->andWhere('t.status = 0')
            ->setParameter('data', $data);

        if($noFnl) {
          $qb->andWhere('tr.alias IN (:fnl)')
             ->setParameter('fnl', ['england-champ', 'spain-champ', 'italy-champ', 'germany-champ',
              'france-champ', 'fnl', 'england-cup', 'spain-cup', 'italy-cup', 'germany-cup',
               'france-cup']);
        }
        if($turnir) {
          $qb->andWhere('tr.alias = :turnir')
             ->setParameter('turnir', $turnir);
        }
        if($noTurnir) {
          $qb->andWhere('tr.alias != :turnir')
             ->setParameter('turnir', $noTurnir);
        }
        $qb->orderBy('t.data', 'ASC');

        return  $qb->getQuery()->getResult();
    }

    public function getEntityByWeek($date, $turnir)
    {
        $qb = $this->createQueryBuilder('e')
                ->select('e', 's', 'st', 'tm', 'tm2', 't')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.team', 'tm')
                ->join('e.team2', 'tm2')
                ->where("e.data >= :data")
                ->setParameter('data', $date)
                ->andWhere("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->andWhere("e.status = 0")
                ->orderBy('st.rank, e.data, e.id');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getNationSupercup($country)
    {
      if($country == 'uefa'){
        $alias = 'supercup';
      } else {
        $alias = $country."-supercup";
      }
        return $this->createQueryBuilder('n')
                ->select('n', 's', 'tm')
                ->join('n.season', 's')
                ->join('n.team', 'tm')
                ->join('n.turnir', 'cn')
                ->where('cn.alias = :country')
                ->setParameter('country', $alias)
                ->orderBy('s.name', 'DESC')
                ->getQuery()
                ->getResult();
    }

    public function getEntityByTurnirStadia($turnir, $season, $stadia)
    {
        return $this->createQueryBuilder('e')
                ->select('e', 's', 'st', 'tm', 'tm2')
                ->join('e.turnir', 't')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.team', 'tm')
                ->join('e.team2', 'tm2')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->andWhere('st.id = :stadia')
                ->setParameters([
                    'season' => $season,
                    'turnir' => $turnir,
                    'stadia' => $stadia
                    ])
                ->orderBy('e.data, e.id')
                ->getQuery()
                ->getResult();
    }

    public function findByTeamAndSeason($team, $season, $turnir)
    {
        return $this->createQueryBuilder('c')
            ->select('c', 't', 't2', 's')
            ->join('c.season', 's')
            ->join('c.turnir', 'tr')
            ->join('c.team', 't')
            ->join('c.team2', 't2')
            ->where('c.team = :team OR c.team2 = :team')
            ->andWhere('s.name = :season')
            ->andWhere("tr.alias = :turnir")
            ->setParameters([
                'season' => $season,
                'turnir' => $turnir,
                'team' => $team
                ])
            ->getQuery()
            ->getResult();
    }

    public function getTeams($season, $turnir, $league = null)
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
              ->join('c.turnir', 'tr')
              ->join('c.stadia', 'st')
              ->where("s.name = :season")
              ->andWhere("st.name = :stadia")
              ->andWhere("tr.alias = :turnir")
              ->setParameters(['season' => $season, 'turnir' => $turnir, 'stadia' => '1/16 финала'])
              ->orderBy('t.name')
              ->getQuery()
              //->setCacheable(true)
              ->getResult()
              ;
    }

}
