<?php

namespace App\Repository;

use App\Entity\UserMotivation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserMotivation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMotivation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMotivation[]    findAll()
 * @method UserMotivation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMotivationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMotivation::class);
    }

    // /**
    //  * @return UserMotivation[] Returns an array of UserMotivation objects
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
    public function findOneBySomeField($value): ?UserMotivation
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
