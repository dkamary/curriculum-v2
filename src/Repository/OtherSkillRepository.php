<?php

namespace App\Repository;

use App\Entity\Other;
use App\Entity\OtherSkill;
use App\Entity\Skill;
use App\Entity\SkillCategory;
use App\Entity\SkillLevel;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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

    /**
     * Get User'other knowledge order by Skill category and skill level desc
     *
     * @param User $user
     * @return array
     */
    public function getOthers(User $user): array
    {
        $otherSkills = $this->createQueryBuilder('os')
            ->join(Skill::class, 's', Join::WITH, 'os.skill = s.id')
            ->join(SkillCategory::class, 'sc', Join::WITH, 's.category = sc.id')
            ->join(SkillLevel::class, 'sl', Join::WITH, 'os.level = sl.id')
            ->join(Other::class, 'o', Join::WITH, 'os.other = o.id')
            ->where('o.owner = :user')
            ->orderBy('sc.name', 'ASC')
            ->addOrderBy('sl.rank', 'DESC')
            ->setParameter('user', $user->getId())
            ->getQuery()
            ->getResult();

        return $otherSkills;
    }

    /**
     * Undocumented function
     *
     * @param OtherSkill[] $others
     * @return array
     */
    public function formatToArray(array $others): array
    {
        $array = [];
        foreach ($others as $os) {
            if (!isset($array[$os->getSkill()->getCategory()->getName()])) {
                $array[$os->getSkill()->getCategory()->getName()] = [];
            }
            $array[$os->getSkill()->getCategory()->getName()][] = $os;
        }

        return $array;
    }
}
