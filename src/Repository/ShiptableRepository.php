<?php

namespace App\Repository;

use App\Entity\Shiptable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shiptable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shiptable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shiptable[]    findAll()
 * @method Shiptable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShiptableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shiptable::class);
    }

    public function translateCountry($country) {
        switch ($country) {
            case 'russia' : $country = 'Россия'; $rusCountry = 'России';
              break;
            case 'england' : $country = 'Англия'; $rusCountry = 'Англии';
              break;
            case 'spain' : $country = 'Испания'; $rusCountry = 'Испании';
              break;
            case 'italy' : $country = 'Италия'; $rusCountry = 'Италии';
              break;
            case 'germany' : $country = 'Германия'; $rusCountry = 'Германии';
              break;
            case 'france' : $country = 'Франция'; $rusCountry = 'Франции';
              break;
            case 'fnl' : $country = 'ФНЛ'; $rusCountry = 'ФНЛ';
              break;
            default : $country = ''; $rusCountry = 'УЕФА';
        }
        return [
            'country' => $country,
            'rusCountry' => $rusCountry
                ];
    }

    public function getTable($country, $season)
    {
        return $this->createQueryBuilder('st')
            ->select('st', 't')
            ->join('st.team', 't')
            ->join('st.season', 's')
            ->join('st.country', 'c')
            ->where('c.name = :country')
            ->andWhere('s.name = :season')
            ->setParameter('country', $country)
            ->setParameter('season', $season)
            ->orderBy('st.score DESC, st.wins DESC, st.mz')
            ->getQuery()
            ->getResult();
    }

    public function getSeasons($country)
    {
        return $this->createQueryBuilder('st')
                ->select('st','s')
                ->join('st.team', 't')
                ->join('st.season', 's')
                ->join('st.country', 'c')
                ->where("c.name = :country")
                ->setParameter('country', $country)
                ->groupBy('s')
                ->orderBy('s.name')
                ->getQuery()
                ->getResult()
                ;
    }

    public function getTeams($season, $country)
    {
      return $this->createQueryBuilder('st')
              ->select('t.id', 't.name', 't.translit')
              ->join('st.team', 't')
              ->join('st.season', 's')
              ->join('st.country', 'c')
              ->where("c.name = :country")
              ->setParameter('country', $country)
              ->andWhere("s.name = :season")
              ->setParameter('season', $season)
              ->orderBy('t.name')
              ->getQuery()
              ->getResult()
              ;
    }

    public function getTeamsRfpl()
    {
        return $this->createQueryBuilder('st')
                ->select('distinct t.name')
                ->join('st.team', 't')
                ->join('t.country', 'c')
                ->where("c.name = :country")
                    ->setParameters([
                    'country' => 'Россия',
                        ])
                ->orderBy('t.name')
                ->getQuery()
                ->getResult();
    }
}
