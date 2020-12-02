<?php

namespace App\Repository;

use App\Entity\ExperienceSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExperienceSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceSkill[]    findAll()
 * @method ExperienceSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienceSkill::class);
    }

    // /**
    //  * @return ExperienceSkill[] Returns an array of ExperienceSkill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExperienceSkill
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
