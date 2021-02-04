<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OtherSkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("curriculum")
 */
class CvController extends AbstractController
{
    /**
     * @Route("/{model}", name="curriculum_render", requirements={ "model" = "\w+" })
     */
    public function index(string $model, OtherSkillRepository $otherSkillRepository): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $others = $otherSkillRepository->getOthers($user);

        return $this->render('cv/' . $model . '.html.twig', [
            'user' => $user,
            'others' => $otherSkillRepository->formatToArray($others),
        ]);
    }
}
