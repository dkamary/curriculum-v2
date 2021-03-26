<?php

namespace App\Controller;

use App\Entity\Proposal;
use App\Entity\User;
use App\Entity\UserType;
use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     */
    public function index(): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $data = [
            'user' => $user,
        ];
        if ($user->getUserType()->getId() == UserType::CANDIDAT) {
            $isInfo = is_null($user->getAvatarPath());
            $isProfile = is_null($user->getUserMotivation()->getId());
            $isAddress = is_null($user->getAddress()) || strlen(trim($user->getAddress())) < 3;
            $isExp = count($user->getExperiences()) < 1;
            $isTrain = count($user->getTrainings()) < 1;
            $isOther = count($user->getOthers()) < 1;
            $isLang = count($user->getLanguageKnowledges()) < 1;

            $data = [
                'user' => $user,
                'isInfo' => $isInfo,
                'isProfile' => $isProfile,
                'isAddress' => $isAddress,
                'isExp' => $isExp,
                'isTrain' => $isTrain,
                'isOther' => $isOther,
                'isLang' => $isLang,
            ];
        } elseif ($user->getUserType()->getId() == UserType::COMPANY) {
            $proposals = $user->getProposals();
            /**
             * @var ProposalRepository $repository
             */
            $repository = $this->getDoctrine()->getManager()->getRepository(Proposal::class);
            $latest = $repository->getLatest($user->getId());

            $data = [
                'user' => $user,
                'latest' => $latest,
            ];
        }

        return $this->render('dashboard/index.html.twig', $data);
    }
}
