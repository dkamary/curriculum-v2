<?php

namespace App\Repository;

use App\Entity\Other;
use App\Entity\OtherSkill;
use App\Entity\Skill;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Skill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skill[]    findAll()
 * @method Skill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    // /**
    //  * @return Skill[] Returns an array of Skill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Skill
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getSkills(User $user)
    {
        $competences = [];
        foreach ($user->getOthers() as $other) {
            /**
             * @var Other $other
             */
            foreach ($other->getOtherSkills() as $otherSkill) {
                /**
                 * @var OtherSkill $otherSkill
                 */
                $categoryIndex = $otherSkill->getSkill()->getCategory()->getId();
                if (!isset($competences[$categoryIndex])) {
                    $competences[$categoryIndex] = [];
                }
                $competences[$categoryIndex][] = $otherSkill->getSkill();
            }
        }

        return $competences;
    }

    /**
     * Get Skill by ID
     *
     * @param array $skillId
     * @return array|Skill[]
     */
    public function getSkillList(array $skillId = []): array
    {
        if ([] == $skillId) {
            return $this->findAll();
        } else {
            $qb = $this->createQueryBuilder('s');

            return $qb
                ->where($qb->expr()->in('s.id', $skillId))
                ->getQuery()
                ->getResult();
        }
    }

    /**
     * Get Count
     *
     * @param array $array
     * @return integer
     */
    public function getCount(array $array): int
    {
        $qb = $this->createQueryBuilder('s');
        $count = $qb->select('COUNT(s.id)')
            ->join(OtherSkill::class, 'os', Expr\Join::WITH, 'os.skill = s.id')
            ->join(Other::class, 'o', Expr\Join::WITH, 'o.id = os.other')
            ->where($qb->expr()->in('s.id', $array))
            ->getQuery()
            ->getSingleScalarResult();

        return $count;
    }

    /**
     * Get JSON Array
     *
     * @param array|Skill[] $skills
     * @return array
     */
    public function exportArray(array $skills): array
    {
        $array = [];
        foreach ($skills as $skill) {
            $array[] = $skill->exportArray();
        }

        return $array;
    }
}
