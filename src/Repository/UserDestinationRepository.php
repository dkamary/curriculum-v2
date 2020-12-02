<?php

namespace App\Repository;

use App\Entity\UserDestination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserDestination|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserDestination|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserDestination[]    findAll()
 * @method UserDestination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserDestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDestination::class);
    }

    // /**
    //  * @return UserDestination[] Returns an array of UserDestination objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserDestination
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
