<?php

namespace App\Controller;

use App\Repository\LanguageLevelRepository;
use App\Repository\LanguageRepository;
use App\Repository\ProposalRepository;
use App\Repository\SkillRepository;
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
        $knowledge = $query->getInt('knowledge');
        $exp = $query->getInt('exp');
        $language = $query->getInt('language');
        $level = $query->getInt('level');
        $page = $query->getInt('page', 1);
        $perpage = $query->getInt('per_page', 20);
        $results = $proposalRepository->search($user, $keywords, $knowledge, $exp, $language, $level, $page, $perpage);

        return $this->render('search/index.html.twig', [
            'results' => $results,
            'keywords' => $keywords,
        ]);
    }

    /**
     * @Route("/_form", name="search_form")
     */
    public function _form(SkillRepository $skillRepository, LanguageRepository $languageRepository, LanguageLevelRepository $languageLevelRepository): Response
    {
        $knowledges = $skillRepository->getKnowledges();
        $languages = $languageRepository->findBy([], ['name' => 'ASC']);
        $languageLevel = $languageLevelRepository->findBy([], ['score' => 'ASC']);

        return $this->render('search/_partials/form.html.twig', [
            'knowledges' => $knowledges,
            'languages' => $languages,
            'language_level' => $languageLevel,
        ]);
    }
}
