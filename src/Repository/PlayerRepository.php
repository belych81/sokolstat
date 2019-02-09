<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function getBirthdayPlayer($data)
    {
        return $this->createQueryBuilder('p')
            ->select('p.name, p.id, p.translit')
            ->where("p.born LIKE '%$data%'")
            ->orderBy('p.born', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAge($name)
    {
        $qb = $this->createQueryBuilder('p')
                ->select('p.born')
                ->where("p.name = :name")
                ->setParameter('name', $name);

        $query = $qb->getQuery();
        $age = $query->getScalarResult();
        $year = \substr($age[0]['born'], 0, 4);

        return \date('Y') - $year;
    }

    public function getLastPlayer() {

        $qb = $this->createQueryBuilder('p')
                ->select('p.name, p.id, p.translit')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(11);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function queryRusTeamPlayers($season, $team)
    {
        $year = \substr($season, 0, 4);
        $start = $year-39;
        $end = $year-16;
        $str_start = $start.'-01-01';
        $str_end = $end.'-12-31';
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.playersteams', 'pt')
                ->join('pt.team', 't')
                ->where("p.born BETWEEN :str_start AND :str_end")
                ->setParameter('str_start', $str_start)
                ->setParameter('str_end', $str_end)
                ->andWhere("pt.game >= 0")
                ->andWhere("t.translit = :team")
                ->setParameter('team', $team)
                ->orderBy('p.name');
    }
}
