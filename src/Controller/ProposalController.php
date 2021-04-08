<?php

namespace App\Controller;

use App\Entity\Applier;
use App\Entity\Proposal;
use App\Entity\ProposalSkill;
use App\Entity\User;
use App\Form\ProposalSkillType;
use App\Form\ProposalType;
use App\Repository\ApplierRepository;
use App\Repository\ProposalRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * @Route("/dashboard/proposal")
 */
class ProposalController extends AbstractController
{
    /**
     * @Route("/", name="proposal_index")
     */
    public function index(Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $proposal = new Proposal();
        $form = $this->createForm(ProposalType::class, $proposal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugger = new AsciiSlugger();
            $ref = $slugger->slug($proposal->getReference());
            $proposal
                ->setOwner($user)
                ->setReference($ref)
                ->setSlug($ref);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($proposal);
            $manager->flush();
            $this->addFlash('success', 'Nouvel offre d\'emploi ajouté');

            $this->redirectToRoute('proposal_index');
        }

        return $this->render('proposal/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/proposal/{id}/edit", name="proposal_edit", requirements={ "id" = "\d+" })
     */
    public function edit(Request $request, Proposal $proposal): Response
    {
        $form = $this->createForm(ProposalType::class, $proposal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugger = new AsciiSlugger();
            $ref = $slugger->slug($proposal->getReference());
            $proposal
                ->setReference($ref)
                ->setSlug($ref);
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('success', 'Offre d\'emploi mis à jour');

            $this->redirectToRoute('proposal_edit', ['id' => $proposal->getId()]);
        }

        $proposalSkill = new ProposalSkill();
        $skillForm = $this->createForm(ProposalSkillType::class, $proposalSkill);
        $skillForm->handleRequest($request);

        if ($skillForm->isSubmitted() && $skillForm->isValid()) {
            $proposalSkill->setProposal($proposal);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($proposalSkill);
            $manager->flush();

            $this->addFlash('success', 'Offre d\'emploi mis à jour');

            $this->redirectToRoute('proposal_edit', ['id' => $proposal->getId()]);
        }

        return $this->render('proposal/edit.html.twig', [
            'user' => $this->getUser(),
            'proposal' => $proposal,
            'form' => $form->createView(),
            'skill_form' => $skillForm->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="proposal_delete")
     */
    public function delete(Request $request, ProposalRepository $proposalRepository, EntityManagerInterface $manager): Response
    {
        $post = $request->request;
        $id = $post->getInt('id');
        $proposal = $proposalRepository->findOneBy(['id' => $id]);
        $message = '';
        if ($proposal) {
            /**
             * @var Proposal $proposal
             */
            $proposal
                ->setIsActive(false)
                ->setDeletedAt(new DateTime());
            $manager->flush();
            $message = 'Offre d\'emploi effacé';
            // $this->addFlash('success', $message);
        }

        return $this->json([
            'done' => 'true',
            'message' => $message,
            // 'proposal' => $proposal,
        ]);
    }

    /**
     * @Route("/appliers/{ref}", name="proposal_appliers", requirements={ "ref" = "[a-zA-Z0-9_-]+" })
     */
    public function appliers(string $ref, ProposalRepository $proposalRepository, ApplierRepository $applierRepository): Response
    {
        $proposal = $proposalRepository->findOneBy(['reference' => $ref]);
        if ($proposal) {
            /**
             * @var Applier[] $appliers
             */
            $appliers = $applierRepository->findBy([
                'proposal' => $proposal->getId(),
            ], [
                'applyDate' => 'ASC',
            ]);

            return $this->render('proposal/appliers.html.twig', [
                'appliers' => $appliers,
                'proposal' => $proposal,
            ]);
        } else {
            return new NotFoundResourceException('Offre d\'emploi avec la référence "' . $ref . '" introuvable');
        }
    }

    /**
     * @Route("/proposal/cancel/{id}", name="proposal_cancel", requirements={ "id" = "\d+" })
     */
    public function cancel(Request $request, Applier $applier): Response
    {
        $proposal = $applier->getProposal();
        if ($this->isCsrfTokenValid('delete' . $applier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($applier);
            $entityManager->flush();

            $this->addFlash('success', 'Votre candidature a été retiré avec succès');
        }

        $route = $request->request->get('_route', 'proposal_show');
        if ($route == 'proposal_show') {

            return $this->redirectToRoute($route, [
                'slug' => $proposal->getSlug(),
            ]);
        } else {

            return $this->redirectToRoute($route);
        }
    }

    /**
     * @Route("/_populars", name="proposal_populars")
     */
    public function populars(ProposalRepository $proposalRepository): Response
    {
        $populars = $proposalRepository->getPopulars(10);

        return $this->render('_partials/popular-post.html.twig', [
            'populars' => $populars,
        ]);
    }

    /**
     * @Route("/_update", name="proposal_global_update")
     */
    public function update(ProposalRepository $proposalRepository): Response
    {
        $slugger = new AsciiSlugger();
        foreach ($proposalRepository->findAll() as $prop) {
            $prop->setSlug($slugger->slug($prop->getReference()));
        }
        $this->getDoctrine()->getManager()->flush();

        return new Response('Done');
    }
}
