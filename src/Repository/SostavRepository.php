<?php

namespace App\Repository;

use App\Entity\Sostav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sostav|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sostav|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sostav[]    findAll()
 * @method Sostav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SostavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
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

    public function getMundialPlayer($id)
    {
      return $this->createQueryBuilder('sv')
              ->select('sv')
              ->join('sv.player', 'r')
              ->where("r.translit = :id")
              ->setParameter('id', $id)
              ->getQuery()
              ->getResult();
    }

    public function updateGamer($id, $change)
    {
        switch ($change) {
            case 'plusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game+1';
                break;
            case 'minusGame' :
                $changeParam = 'g.game';
                $changeParam2 = 'g.game-1';
                break;
            case 'plusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal+1';
                break;
            case 'minusGoal' :
                $changeParam = 'g.goal';
                $changeParam2 = 'g.goal-1';
                break;
        }
            $qb = $this->_em->createQueryBuilder()
                ->update('App\Entity\Sostav', 'g')
                ->set($changeParam, $changeParam2)
                ->where('g.id = ?1')
                ->setParameter(1, $id)
                ->getQuery();

            $qb->execute();
    }
}
