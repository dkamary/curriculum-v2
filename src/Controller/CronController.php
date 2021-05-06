<?php

namespace App\Controller;

use App\Entity\ExperienceSkill;
use App\Entity\ProposalSkill;
use App\Repository\ExperienceSkillRepository;
use App\Repository\ProposalSkillRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/_cron")
 */
class CronController extends AbstractController
{
    /**
     * @Route("/xp", name="cron_all_xp")
     */
    public function xp(ExperienceSkillRepository $experienceSkillRepository): Response
    {
        $experienceSkills = $experienceSkillRepository->findAll();
        $k = 0;
        foreach ($experienceSkills as $expSkill) {
            /**
             * @var ExperienceSkill $expSkill
             */
            $experience = $expSkill->getExperience();
            $end = (is_null($experience->getEnd()) ? new DateTime('now') : $experience->getEnd());
            $diff = $end->diff($experience->getStart());
            $xp = $diff->y + ($diff->m / 12) + ($diff->d / 365);
            $expSkill->setXp($xp);
            ++$k;
        }
        $this->getDoctrine()->getManager()->flush();

        return new Response($k . ' Expérience mis à jour');
    }

    /**
     * @Route("/years", name="cron_all_proposal_skill")
     */
    public function years(ProposalSkillRepository $proposalSkillRepository): Response
    {
        $proposalSkills = $proposalSkillRepository->findAll();
        $k = 0;
        foreach ($proposalSkills as $pSkill) {
            /**
             * @var ProposalSkill $pSkill
             */
            $xp = rand(0, 10);
            $pSkill->setXp((float)$xp);
            ++$k;
        }
        $this->getDoctrine()->getManager()->flush();

        return new Response($k . ' Compétences d\'offre d\'emploi mis à jour');
    }
}
