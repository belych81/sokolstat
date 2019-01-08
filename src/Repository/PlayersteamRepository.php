<?php

namespace App\Repository;

use App\Entity\Playersteam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Playersteam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playersteam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playersteam[]    findAll()
 * @method Playersteam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayersteamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Playersteam::class);
    }

    public function getStat($name, $team, $param)
    {
        switch ($param) {
            case 'game' : $select = 'p.game'; break;
            case 'goal' : $select = 'p.goal'; break;
        }
        $qb = $this->createQueryBuilder('p')
                ->join('p.team', 't')
                ->join('p.player', 'n')
                ->where("n.name = :name")
                ->setParameter('name', $name)
                ->andWhere("t.translit = :team")
                ->setParameter('team', $team);

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
