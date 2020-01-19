<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function getSvod($country)
    {
        return $this->createQueryBuilder('t')
                ->join('t.country', 'c')
                ->where("c.translit = :country")
                ->setParameter('country', $country)
                ->andWhere('t.game > 0')
                ->orderBy('t.score', 'desc')
                ->getQuery()
                ->getResult();
    }

    public function updateSvod($team, $team2, $goal1, $goal2)
    {
        if ($goal1 == $goal2)
        {
            $qb = $this->_em->createQueryBuilder('Team', 'st')
                ->update('App\Entity\Team', 'st')
                ->set('st.nich', 'st.nich+1')
                ->set('st.mz', 'st.mz+?1')
                ->set('st.game', 'st.game+1')
                ->set('st.mp', 'st.mp+?2')
                ->set('st.score', 'st.score+1')
                ->where('st.id = ?3 OR st.id = ?4')
                ->setParameter(1, $goal1)
                ->setParameter(2, $goal2)
                ->setParameter(3, $team)
                ->setParameter(4, $team2)
                ->getQuery();
            $qb->execute();
        }
        elseif ($goal1 != $goal2)
        {
            if ($goal1 < $goal2)
            {
                $winner = $team2;
                $looser = $team;
                $goalW = $goal2;
                $goalL = $goal1;
            }
            else
            {
                $winner = $team;
                $looser = $team2;
                $goalW = $goal1;
                $goalL = $goal2;
            }
            $qb = $this->_em->createQueryBuilder('Team', 'st')
                    ->update('App\Entity\Team', 'st')
                    ->set('st.wins', 'st.wins+1')
                    ->set('st.game', 'st.game+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->set('st.score', 'st.score+3')
                    ->where('st.id = ?3')
                    ->setParameter(1, $goalW)
                    ->setParameter(2, $goalL)
                    ->setParameter(3, $winner)
                    ->getQuery();

            $qb2 = $this->_em->createQueryBuilder('Team', 'st')
                    ->update('App\Entity\Team', 'st')
                    ->set('st.porazh', 'st.porazh+1')
                    ->set('st.game', 'st.game+1')
                    ->set('st.mz', 'st.mz+?1')
                    ->set('st.mp', 'st.mp+?2')
                    ->where('st.id = ?3')
                    ->setParameter(1, $goalL)
                    ->setParameter(2, $goalW)
                    ->setParameter(3, $looser)
                    ->getQuery();

            $qb->execute();
            $qb2->execute();
        }

    }

    public function getTeams()
    {
        return $this->createQueryBuilder('t')
                ->orderBy('t.name', 'asc')
                ->getQuery()
                ->getResult();
    }

    public function queryTeams()
    {
        return $this->createQueryBuilder('t')
                ->orderBy('t.name', 'asc');
    }

    public function getTeamsByLetter($letter)
    {
        return $this->createQueryBuilder('t')
                ->where("t.name LIKE '$letter%'")
                ->orderBy('t.name', 'asc')
                ->getQuery()
                ->getResult();
    }

    public function queryTeamsForForm($country, $season) {

        return $query = $this->createQueryBuilder('t')
                ->leftJoin('t.shiptables', 'st')
                ->join('st.country', 'c')
                ->join('st.season', 's')
                ->where("c.name = :country")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'country' => $country,
                    'season' => $season,
                        ])
                ->orderBy('t.name');
    }

    public function queryTeamsForCup($country) {

        return $query = $this->createQueryBuilder('t')
                ->join('t.country', 'c')
                ->where("c.translit = :country")
                ->setParameters([
                    'country' => $country
                        ])
                ->orderBy('t.name');
    }

    public function queryTeamsForEc($turnir, $season)
    {
        return $query = $this->createQueryBuilder('t')
                ->leftJoin('t.ectables', 'e')
                ->join('e.season', 's')
                ->join('e.turnir', 'tr')
                ->where("s.name = :season")
                ->andWhere("tr.alias = :turnir")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season
                        ])
                ->orderBy('t.name');
    }

    public function searchTeams($arQuery)
    {
        $q = $this->createQueryBuilder('t')
            ->orWhere("t.name LIKE '%$arQuery[0]%'")
            ->setMaxResults(10);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("t.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }
}
