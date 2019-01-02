<?php

namespace App\Repository;

use App\Entity\NhlPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NhlPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method NhlPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method NhlPlayer[]    findAll()
 * @method NhlPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NhlPlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NhlPlayer::class);
    }

    public function updateNhlPlayer($playerId, $goal, $turnir)
    {
      if($turnir == 1)
      {
        $qb = $this->getEntityManager()->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'p')
                ->set('p.goalReg', 'p.goalReg + ?3')
                ->set('p.goalSum', 'p.goalSum + ?2')
                ->where('p.id = ?1')
                ->setParameter(1, $playerId)
                ->setParameter(2, $goal)
                ->setParameter(3, $goal)
                ->getQuery();
      }
      elseif($turnir == 2)
      {
        $qb = $this->getEntityManager()->createQueryBuilder()
                ->update('App\Entity\NhlPlayer', 'p')
                ->set('p.goalPlayOff', 'p.goalPlayOff + ?3')
                ->set('p.goalSum', 'p.goalSum + ?2')
                ->where('p.id = ?1')
                ->setParameter(1, $playerId)
                ->setParameter(2, $goal)
                ->setParameter(3, $goal)
                ->getQuery();
      }
      else
      {
        return;
      }

          $qb->execute();
    }
}
