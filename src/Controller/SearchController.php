<?php

namespace App\Controller;

use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search")
     */
    public function index(Request $request, ProposalRepository $proposalRepository): Response
    {
        $user = $this->getUser();
        $query = $request->query;
        $keywords = $query->get('search');
        $area = $query->get('area');
        $category = $query->get('category');
        $results = $proposalRepository->search($user, $keywords, $area, $category);

        return $this->render('search/index.html.twig', [
            'results' => $results,
        ]);
    }
}
