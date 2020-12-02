<?php

namespace App\Repository;

use App\Entity\Applier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Applier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applier[]    findAll()
 * @method Applier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Applier::class);
    }

    // /**
    //  * @return Applier[] Returns an array of Applier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Applier
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
