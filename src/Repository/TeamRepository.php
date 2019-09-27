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
                ->where("c.name = :country")
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
            ->setMaxResults(20);

        foreach($arQuery as $key => $val){
            if($key == 0) continue;
            $q->andWhere("t.name LIKE '%$val%'");
        }
        $qb = $q->getQuery();

        return $qb->getResult();
    }
}
