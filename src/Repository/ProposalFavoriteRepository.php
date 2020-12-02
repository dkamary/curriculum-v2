<?php

namespace App\Repository;

use App\Entity\ProposalFavorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProposalFavorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposalFavorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposalFavorite[]    findAll()
 * @method ProposalFavorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposalFavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProposalFavorite::class);
    }

    // /**
    //  * @return ProposalFavorite[] Returns an array of ProposalFavorite objects
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
    public function findOneBySomeField($value): ?ProposalFavorite
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
