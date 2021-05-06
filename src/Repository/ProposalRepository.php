<?php

namespace App\Repository;

use App\Entity\Applier;
use App\Entity\Experience;
use App\Entity\ExperienceSkill;
use App\Entity\LanguageKnowledge;
use App\Entity\Other;
use App\Entity\OtherSkill;
use App\Entity\Proposal;
use App\Entity\ProposalSkill;
use App\Entity\Skill;
use App\Entity\User;
use App\Entity\UserType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @method Proposal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proposal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proposal[]    findAll()
 * @method Proposal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proposal::class);
    }

    // /**
    //  * @return Proposal[] Returns an array of Proposal objects
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
    public function findOneBySomeField($value): ?Proposal
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Get Populars Proposals
     *
     * @param integer $count
     * @param string $min
     * @param string|null $max
     * @return Proposal[]
     */
    public function getPopulars(int $count = 4, string $min = 'now', ?string $max = null): array
    {
        $min = ($min == 'now') ? date('Y-m-d') : $min;
        $max = (is_null($max)) ? date(((int)date('Y') + 1) . '-12-31') : $max;
        // VarDumper::dump($min);
        // VarDumper::dump($max);
        $qb = $this->createQueryBuilder('p');
        $populars = $qb->where('(p.end IS NULL OR p.end < :max)')
            ->andWhere('p.start <= :min')
            ->orderBy('p.start', 'DESC')
            ->setMaxResults($count)
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->getQuery()
            ->getResult();
        // VarDumper::dump($populars);

        return $populars;
    }

    /**
     * Get Latest proposal
     *
     * @param integer $owner
     * @param integer $count
     * @param string $min
     * @param string|null $max
     * @return array
     */
    public function getLatest(int $owner, int $count = 4, string $min = 'now', ?string $max = null): array
    {
        $min = ($min == 'now') ? date('Y-m-d') : $min;
        $max = (is_null($max)) ? date(((int)date('Y') + 1) . '-12-31') : $max;
        $qb = $this->createQueryBuilder('p');
        $latest = $qb->where('(p.end IS NULL OR p.end < :max)')
            ->andWhere('p.start <= :min')
            ->andWhere('p.owner = :owner')
            ->orderBy('p.start', 'DESC')
            ->setMaxResults($count)
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->setParameter('owner', $owner)
            ->getQuery()
            ->getResult();

        return $latest;
    }

    /**
     * Search
     *
     * @param User|null $user
     * @param string|null $keywords
     * @param integer|null $knowledge
     * @param integer|null $exp
     * @param integer|null $language
     * @param integer|null $level
     * @return array
     */
    public function search(?User $user = null, ?string $keywords = null, ?int $knowledge = 0, ?int $exp = 0, ?int $language = 0, ?int $level = 0, int $page = 1, int $perpage = 20): array
    {
        $proposals = [];
        $users = [];
        if (!is_null($user) && in_array('ROLE_COMPANY', $user->getRoles())) {
            $users = $this->searchUser($keywords, $knowledge, $exp, $language, $level);
        } else {
            $proposals = $this->searchProposals($keywords, $knowledge, $exp, $language, $level);
        }

        return [
            'proposals' => $proposals,
            'users' => $users,
        ];
    }

    /**
     * Search Users
     *
     * @param string|null $keywords
     * @param integer|null $knowledge
     * @param integer|null $exp
     * @param integer|null $language
     * @param integer|null $level
     * @param integer $page
     * @param integer $perpage
     * @return array
     */
    public function searchUser(?string $keywords = null, ?int $knowledge = 0, ?int $exp = 0, ?int $language = 0, ?int $level = 0, int $page = 1, int $perpage = 20): array
    {
        /**
         * @var UserRepository $userRepository
         */
        $userRepository = $this->getEntityManager()->getRepository(User::class);
        $qb = $userRepository->createQueryBuilder('u');
        $qb
            ->join(Other::class, 'o', Expr\Join::WITH, 'u.id = o.owner')
            ->join(OtherSkill::class, 'os', Expr\Join::WITH, 'o.id = os.other')
            ->join(Skill::class, 's', Expr\Join::WITH, 'os.skill = s.id');
        $keywordsCondition = '';
        $first = true;
        $k = 0;
        $words = explode(' ', trim($keywords));
        foreach ($words as $w) {
            if ($w == '') continue;
            $keywordsCondition .= (!$first ? ' OR ' : '') . sprintf('u.firstname LIKE :w%d OR u.lastname LIKE :w%d OR s.name LIKE :w%d', $k, $k, $k);
            $qb->setParameter('w' . $k, '%' . $w . '%');
            $k++;
            $first = false;
        }

        $qb
            ->where('u.isActive = :active')
            ->setParameter('active', true)
            ->andWhere('u.userType = :userType')
            ->setParameter('userType', UserType::CANDIDAT);

        if ($keywordsCondition !== '') {
            $qb->andWhere('(' . $keywordsCondition . ')');
        }
        if ($knowledge > 0) {
            $qb
                ->andWhere('s.id = :knowledge')
                ->setParameter('knowledge', $knowledge);
            if ($exp > 0) {
                $qb
                    ->join(Experience::class, 'e', Expr\Join::WITH, 'u.id = e.owner')
                    ->join(ExperienceSkill::class, 'es', Expr\Join::WITH, 'e.id = es.experience')
                    ->AndWhere('es.xp >= :xp')
                    ->setParameter('xp', $exp);
            }
        }
        if ($language > 0) {
            $qb
                ->join(LanguageKnowledge::class, 'lk', Expr\Join::WITH, 'u.id = lk.owner')
                ->AndWhere('lk.language = :language')
                ->setParameter('language', $language);
            if ($level > 0) {
                $qb
                    ->AndWhere('lk.level >= :level')
                    ->setParameter('level', $level);
            }
        }
        // VarDumper::dump($qb->getQuery()->getSQL());

        $users = $qb
            ->setMaxResults($perpage)
            ->setFirstResult(($page - 1 < 0 ? 1 : ($page - 1)) * $perpage)
            ->getQuery()
            ->getResult();

        return $users;
    }

    /**
     * Search Proposals
     *
     * @param string|null $keywords
     * @param integer|null $knowledge
     * @param integer|null $exp
     * @param integer|null $language
     * @param integer|null $level
     * @param integer $page
     * @param integer $perpage
     * @return array
     */
    public function searchProposals(?string $keywords = null, ?int $knowledge = 0, ?int $exp = 0, ?int $language = 0, ?int $level = 0, int $page = 1, int $perpage = 20): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin(ProposalSkill::class, 'ps', Expr\Join::WITH, 'p.id = ps.proposal')
            ->leftJoin(Skill::class, 's', Expr\Join::WITH, 'ps.skill = s.id');
        $words = explode(' ', trim($keywords));
        $keywordsCondition = '';
        $first = true;
        $k = 0;
        foreach ($words as $w) {
            if ($w == '') continue;
            $keywordsCondition .= (!$first ? ' OR ' : '') . sprintf('p.longDescription LIKE :w%d OR s.name LIKE :w%d', $k, $k);
            $qb->setParameter('w' . $k, '%' . $w . '%');
            $k++;
            $first = false;
        }
        $where = false;
        if ($keywordsCondition !== '') {
            $qb->where('(' . $keywordsCondition . ')');
            $where = true;
        }
        if ($knowledge > 0) {
            if ($where) {
                $qb->andWhere('s.id = :knowledge');
            } else {
                $qb->where('s.id = :knowledge');
            }
            $qb->setParameter('knowledge', $knowledge);
            if ($exp > 0) {
                $qb
                    ->andWhere('ps.xp >= :exp')
                    ->setParameter('exp', $exp);
            }
        }

        $proposals = $qb
            ->setMaxResults($perpage)
            ->setFirstResult(($page - 1 < 0 ? 1 : ($page - 1)) * $perpage)
            ->getQuery()
            ->getResult();

        return $proposals;
    }
}
