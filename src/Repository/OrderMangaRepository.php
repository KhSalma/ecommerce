<?php

namespace App\Repository;

use App\Entity\OrderManga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderManga|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderManga|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderManga[]    findAll()
 * @method OrderManga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderMangaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderManga::class);
    }

    public function FindTotal()
    {  
        $em = $this->getEntityManager();
        $dql = "SELECT SUM(om.price) FROM App\Entity\OrderManga om  ";
        $query = $em->createQuery($dql)
                    ->getSingleScalarResult();
         return $query ;
       
    }

    // /**
    //  * @return OrderManga[] Returns an array of OrderManga objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderManga
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
