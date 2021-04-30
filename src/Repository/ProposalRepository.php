<?php

namespace App\Repository;

use App\Entity\Applier;
use App\Entity\Other;
use App\Entity\OtherSkill;
use App\Entity\Proposal;
use App\Entity\ProposalSkill;
use App\Entity\Skill;
use App\Entity\User;
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
     * @param User $user
     * @param string $keywords
     * @param int $area
     * @param int $category
     */
    public function search(?User $user = null, ?string $keywords = null, ?int $area = 0, ?int $category = 0): array
    {
        $proposals = [];
        $users = [];
        if(!is_null($user) && in_array('ROLE_COMPANY', $user->getRoles())) {
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
            VarDumper::dump($words);
            foreach($words as $w){
                if($w == '') continue;
                $keywordsCondition .= (!$first ? ' OR ' : '') . sprintf('u.firstname LIKE :w%d OR u.lastname LIKE :w%d OR s.name LIKE :w%d', $k, $k, $k);
                $qb->setParameter('w' . $k, '%' .$w .'%');
                VarDumper::dump(['w'.$k => '%' .$w .'%']);
                $k++;
                $first = false;
            }
            if($keywordsCondition !== '') {
                $qb->where('(' .$keywordsCondition .')');
            }

            VarDumper::dump($qb->getQuery()->getSQL());
            VarDumper::dump($qb->getQuery()->getDQL());

            $users = $qb
                ->getQuery()
                ->getResult();
        } else {
            $qb = $this->createQueryBuilder('p');
            $qb
                ->join(ProposalSkill::class, 'ps', Expr\Join::WITH, 'p.skills = ps.id')
                ->join(Skill::class, 's', Expr\Join::WITH, 'ps.skill = s.id');
            $words = explode(' ', trim($keywords));
            $keywordsCondition = '';
            $first = true;
            $k = 0;
            foreach($words as $w){
                $keywordsCondition .= (!$first ? ' OR ' : '') . sprintf('p.longDescription LIKE :w%d OR s.name LIKE :w%d', $k, $k);
                $qb->setParameter('w' . $k, '%' .$w .'%s');
                $k++;
                $first = false;
            }
            if($keywordsCondition !== '') {
                $qb->where($keywordsCondition);
            }
            
            $proposals = $qb
                ->getQuery()
                ->getResult();
        }

        return [
            'proposals' => $proposals,
            'users' => $users,
        ];
    }
}
