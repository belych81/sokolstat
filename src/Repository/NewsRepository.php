<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function getNews($max, $offset=null) {

        $qb = $this->createQueryBuilder('n')
                ->where('n.active = 1')
                ->orderBy('n.data', 'DESC')
                ->setMaxResults($max);

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }


    public function countNews() {

        $qb = $this->createQueryBuilder('n')
                ->select('count(n.id)');

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
