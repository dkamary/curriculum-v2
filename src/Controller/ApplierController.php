<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/applier")
 */
class ApplierController extends AbstractController
{
    /**
     * @Route("/", name="applier")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('applier/index.html.twig', [
            'user' => $user,
        ]);
    }
}
