<?php

namespace App\Repository;

use App\Entity\MangaOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MangaOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method MangaOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method MangaOrder[]    findAll()
 * @method MangaOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MangaOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MangaOrder::class);
    }

    // /**
    //  * @return MangaOrder[] Returns an array of MangaOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MangaOrder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
