<?php

namespace App\Repository;

use App\Entity\Sostav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sostav|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sostav|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sostav[]    findAll()
 * @method Sostav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SostavRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sostav::class);
    }

    public function getSbPlayersByCountry($season, $country)
    {    
        $qb = $this->createQueryBuilder('sv')
                ->select('sv')
                ->join('sv.country', 'c')
                ->join('sv.season', 's')
                ->join('sv.player', 'p')
                ->where("c.translit = :country")
                ->andWhere("s.name = :season")
                ->setParameters([
                    'country' => $country,
                    'season' => $season,
                        ])
                ->add('orderBy','sv.game DESC, sv.number ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
