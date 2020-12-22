<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findActiveTask()
    {
        return $this->createQueryBuilder('t')
            ->where('t.status = 1')
            ->orderBy('t.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findCompleteTask()
    {
        return $this->createQueryBuilder('t')
            ->where('t.status = 0')
            ->orderBy('t.data', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function deactiveTask($id, $data)
    {
      $qb = $this->createQueryBuilder('t')
          ->update('App\Entity\Task', 't')
          ->set('t.status', 0)
          ->set('t.dataend', '?2')
          ->where('t.id = ?1')
          ->setParameter(1, $id)
          ->setParameter(2, $data)
          ->getQuery();
      $qb->execute();
    }

}
