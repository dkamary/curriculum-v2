<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Get Rank
     *
     * @param User $userId
     * @return integer
     */
    public function getRank(User $user): int
    {
        $qb = $this->createQueryBuilder('u');
        $count = $qb
            ->select($qb->expr()->count('u.id'))
            ->where($qb->expr()->eq('u.isActive', true))
            ->andWhere($qb->expr()->gte('u.score', $user->getScore()))
            ->getQuery()
            ->getSingleScalarResult();

        return $count;
    }

    /**
     * Get Position
     *
     * @param User $user
     * @return array
     */
    public function getPosition(User $user): array
    {
        $position = [];


        return $position;
    }
}
