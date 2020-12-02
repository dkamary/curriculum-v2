<?php

namespace App\Repository;

use App\Entity\ProposalAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProposalAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProposalAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProposalAttachment[]    findAll()
 * @method ProposalAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposalAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProposalAttachment::class);
    }

    // /**
    //  * @return ProposalAttachment[] Returns an array of ProposalAttachment objects
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
    public function findOneBySomeField($value): ?ProposalAttachment
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
