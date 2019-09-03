<?php

namespace App\Repository;

use App\Entity\Seasons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Seasons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seasons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seasons[]    findAll()
 * @method Seasons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Seasons::class);
    }

}
