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

    public function findByTranslit($name)
    {
        return $this->createQueryBuilder('t')
                ->select('t.id, t.name, t.translit, t.image')
                ->where("t.translit = :name")
                ->setParameter('name', $name)
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

    public function queryTeamsForEc($turnir, $season, $stadia)
    {
        return $query = $this->createQueryBuilder('t')
                ->leftJoin('t.ectables', 'e')
                ->join('e.season', 's')
                ->join('e.stadia', 'st')
                ->join('e.turnir', 'tr')
                ->where("st.alias = :stadia")
                ->andWhere("s.name = :season")
                ->andWhere("tr.alias = :turnir")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    'stadia' => $stadia
                        ])
                ->orderBy('t.name');
    }
}
