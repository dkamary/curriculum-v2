<?php

namespace App\Controller;

use App\Entity\ProposalSkill;
use App\Form\ProposalSkillType;
use App\Repository\ProposalSkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/proposal/skill")
 */
class ProposalSkillController extends AbstractController
{
    /**
     * @Route("/", name="proposal_skill_index", methods={"GET"})
     */
    public function index(ProposalSkillRepository $proposalSkillRepository): Response
    {
        return $this->render('proposal_skill/index.html.twig', [
            'proposal_skills' => $proposalSkillRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="proposal_skill_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $proposalSkill = new ProposalSkill();
        $form = $this->createForm(ProposalSkillType::class, $proposalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proposalSkill);
            $entityManager->flush();

            return $this->redirectToRoute('proposal_skill_index');
        }

        return $this->render('proposal_skill/new.html.twig', [
            'proposal_skill' => $proposalSkill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposal_skill_show", methods={"GET"})
     */
    public function show(ProposalSkill $proposalSkill): Response
    {
        return $this->render('proposal_skill/show.html.twig', [
            'proposal_skill' => $proposalSkill,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proposal_skill_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProposalSkill $proposalSkill): Response
    {
        $form = $this->createForm(ProposalSkillType::class, $proposalSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposal_skill_index');
        }

        return $this->render('proposal_skill/edit.html.twig', [
            'proposal_skill' => $proposalSkill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposal_skill_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProposalSkill $proposalSkill): Response
    {
        if ($this->isCsrfTokenValid('delete' . $proposalSkill->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposalSkill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proposal_skill_index');
    }

    /**
     * @Route("/_erase", name="proposal_skill_erase")
     */
    public function erase(Request $request, ProposalSkillRepository $proposalSkillRepository): Response
    {
        $post = $request->request;
        $proposalSkill = $proposalSkillRepository->findOneBy([
            'id' => $post->getInt('id'),
        ]);
        if (is_null($proposalSkill)) {
            return $this->json([
                'done' => false,
                'message' => 'La competence est introuvable',
            ]);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($proposalSkill);
        $entityManager->flush();

        return $this->json([
            'done' => true,
            'message' => 'Competence effacée',
        ]);
    }
}
