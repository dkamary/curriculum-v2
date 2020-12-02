<?php

namespace App\Repository;

use App\Entity\UserAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAttachment[]    findAll()
 * @method UserAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAttachment::class);
    }

    // /**
    //  * @return UserAttachment[] Returns an array of UserAttachment objects
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
    public function findOneBySomeField($value): ?UserAttachment
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
