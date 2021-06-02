<?php

namespace App\Controller;

use App\Repository\ProposalCategoryRepository;
use App\Repository\SkillCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\VarDumper\VarDumper;

class ContentController extends AbstractController
{
    /**
     * @Route("/category/{slug}/", name="content_category", requirements={ "slug" = "[a-z-_]+" })
     */
    public function category(
        string $slug,
        ProposalCategoryRepository $proposalCategoryRepository
    ): Response {
        $category = $proposalCategoryRepository->findOneBy(['slug' => $slug,]);
        if (is_null($category)) {
            throw new NotFoundResourceException('La categorie avec l\'url "' . $slug . '" est introuvable');
        }

        return $this->render('content/category.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/_categories", name="featured_categories")
     */
    public function categories(ProposalCategoryRepository $proposalCategoryRepository): Response
    {
        $categories = $proposalCategoryRepository->findBy([], ['name' => 'ASC'], 6);

        return $this->render('_partials/featured-categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/_proposal/categories", name="proposal_categories")
     */
    public function proposalCategories(ProposalCategoryRepository $proposalCategoryRepository): Response
    {
        $categories = $proposalCategoryRepository->findBy(['isActive' => true], ['name' => 'ASC'], 6);
        VarDumper::dump($categories);

        return $this->render('_partials/featured-categories.html.twig', [
            'categories' => $categories,
        ]);
    }
}
