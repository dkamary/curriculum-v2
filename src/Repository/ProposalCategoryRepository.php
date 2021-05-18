<?php

namespace App\Repository;

use App\Entity\ProposalCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProposalCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposalCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposalCategory[]    findAll()
 * @method ProposalCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposalCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProposalCategory::class);
    }

    // /**
    //  * @return ProposalCategory[] Returns an array of ProposalCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProposalCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
