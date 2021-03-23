<?php

namespace App\Controller;

use App\Repository\SkillCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ContentController extends AbstractController
{
    /**
     * @Route("/category/{slug}/", name="content", requirements={ "slug" = "[a-z-_]+" })
     */
    public function category(
        string $slug,
        SkillCategoryRepository $skillCategoryRepository
    ): Response {
        $category = $skillCategoryRepository->findOneBy(['slug' => $slug,]);
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
    public function categories(SkillCategoryRepository $skillCategoryRepository): Response
    {
        $categories = $skillCategoryRepository->findBy([], ['name' => 'ASC'], 6);

        return $this->render('_partials/featured-categories.html.twig', [
            'categories' => $categories,
        ]);
    }
}
