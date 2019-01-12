<?php

namespace App\Repository;

use App\Entity\Ectable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ectable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ectable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ectable[]    findAll()
 * @method Ectable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EctableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ectable::class);
    }

    public function getEcTable($turnir, $season, $stadia)
    {
      return $this->createQueryBuilder('et')
              ->select('et')
              ->join('et.turnir', 't')
              ->join('et.season', 's')
              ->join('et.stadia', 'st')
              ->where("t.alias = :turnir")
              ->andWhere("s.name = :season")
              ->andWhere("st.alias = :stadia")
              ->setParameter('turnir', $turnir)
              ->setParameter('season', $season)
              ->setParameter('stadia', $stadia)
              ->orderBy('et.score', 'DESC')
              ->getQuery()
              ->getResult();
    }

    public function getLchTeams($season)
    {
      return $this->createQueryBuilder('et')
              ->select('et', 't', 's')
              ->join('et.turnir', 'tr')
              ->join('et.season', 's')
              ->join('et.team', 't')
              ->where("tr.alias = :turnir")
              ->andWhere("s.name = :season")
              ->setParameter('turnir', 'leagueChampions')
              ->setParameter('season', $season)
              ->orderBy('t.name')
              ->getQuery()
              ->getResult();
    }
}
