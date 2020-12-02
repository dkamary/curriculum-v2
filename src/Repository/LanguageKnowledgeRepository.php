<?php

namespace App\Repository;

use App\Entity\LanguageKnowledge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LanguageKnowledge|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageKnowledge|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageKnowledge[]    findAll()
 * @method LanguageKnowledge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageKnowledgeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageKnowledge::class);
    }

    // /**
    //  * @return LanguageKnowledge[] Returns an array of LanguageKnowledge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LanguageKnowledge
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
