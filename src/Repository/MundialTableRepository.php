<?php

namespace App\Repository;

use App\Entity\MundialTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MundialTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method MundialTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method MundialTable[]    findAll()
 * @method MundialTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MundialTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MundialTable::class);
    }

    public function getTable($turnir, $season, $stadia)
    {
      return $this->createQueryBuilder('m')
              ->select('m')
              ->join('m.turnir', 't')
              ->join('m.stadia', 'st')
              ->where("t.alias = :turnir")
              ->andWhere("m.year = :season")
              ->andWhere("st.alias = :stadia")
              ->setParameters([
                    'turnir' => $turnir,
                    'season' => $season,
                    'stadia' => $stadia
                        ])
              ->orderBy('m.score DESC, m.wins DESC, m.mz')
              ->getQuery()
              ->getResult();
    }
}
