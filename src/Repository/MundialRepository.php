<?php

namespace App\Repository;

use App\Entity\Mundial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mundial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mundial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mundial[]    findAll()
 * @method Mundial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MundialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mundial::class);
    }

    public function getSeasonsByTurnir($turnir)
    {

        $qb = $this->createQueryBuilder('m')
                ->select('m', 's')
                ->join('m.turnir', 't')
                ->join('m.season', 's')
                ->where("t.alias = :turnir")
                ->setParameter('turnir', $turnir)
                ->groupBy('s');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getEntityByTurnir($turnir, $season, $stadia_id = null)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('m', 't', 's', 'st', 'tm')
                ->join('m.turnir', 't')
                ->join('m.season', 's')
                ->join('m.stadia', 'st')
                ->join('m.country', 'tm')
                ->where("t.alias = :turnir")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    ]);

        if ($stadia_id) {
            $qb->andWhere('m.stadia = :stadia_id')
                    ->setParameter('stadia_id', $stadia_id);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getCountriesBySeason($year)
    {        
        $qb = $this->createQueryBuilder('m')
                ->select('c.name', 'c.translit')
                ->join('m.season', 's')
                ->join('m.country', 'c')
                ->where("s.name = :year")
                ->setParameter('year', $year)
                ->groupBy('c')
                ->orderBy('c.name');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
