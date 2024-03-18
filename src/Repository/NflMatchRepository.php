<?php

namespace App\Repository;

use App\Entity\NflMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NflMatch>
 *
 * @method NflMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method NflMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method NflMatch[]    findAll()
 * @method NflMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NflMatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NflMatch::class);
    }

    public function getNextMatches($season, $team, int $cntLastMatches = 7)
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->join('t.season', 's')
            ->join('t.team', 'tm')
            ->join('t.team2', 'tm2')
            ->andWhere("s.name = :season")
            ->setParameter('season', $season)
            ->andWhere("tm.translit = :team OR tm2.translit = :team")
            ->setParameter('team', $team)
            ->andWhere('t.status = 0')
            ->orderBy('RAND()')
            ->setMaxResults($cntLastMatches)
            ->getQuery()
            ->getResult();
    }

    public function setStatus(int $id, $status)
    {
        $qb = $this->_em->createQueryBuilder('NflMatch', 'st')
                ->update('App\Entity\NflMatch', 'st')
                ->set('st.status', '?1')
                ->where('st.id = ?2')
                ->setParameter(1, $status)
                ->setParameter(2, $id)
                ->getQuery();
            $qb->execute();
    }
}
