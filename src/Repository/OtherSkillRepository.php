<?php

namespace App\Repository;

use App\Entity\OtherSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OtherSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherSkill[]    findAll()
 * @method OtherSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtherSkill::class);
    }

    // /**
    //  * @return OtherSkill[] Returns an array of OtherSkill objects
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
    public function findOneBySomeField($value): ?OtherSkill
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
