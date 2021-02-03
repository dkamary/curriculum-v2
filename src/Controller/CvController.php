<?php

namespace App\Controller;

use App\Entity\User;
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
    public function index(string $model): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();

        return $this->render('cv/' . $model . '.html.twig', [
            'user' => $user,
        ]);
    }
}
