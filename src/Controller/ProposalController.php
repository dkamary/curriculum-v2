<?php

namespace App\Controller;

use App\Entity\Proposal;
use App\Entity\User;
use App\Form\ProposalType;
use App\Repository\ApplierRepository;
use App\Repository\ProposalRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
            $proposal->setOwner($user);
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
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('success', 'Offre d\'emploi mis à jour');

            $this->redirectToRoute('proposal_edit', ['id' => $proposal->getId()]);
        }

        return $this->render('proposal/edit.html.twig', [
            'user' => $this->getUser(),
            'proposal' => $proposal,
            'form' => $form->createView(),
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
     * @Route("/appliers/{ref}", name="proposal_appliers", requirements={ "ref" = "\w+" })
     */
    public function appliers(string $ref, ProposalRepository $proposalRepository, ApplierRepository $applierRepository): Response
    {
        $proposal = $proposalRepository->findOneBy(['ref' => $ref]);
        if ($proposal) {
            $appliers = $applierRepository->findBy([
                'proposal' => $proposal->getId(),
            ], [
                'applyDate' => 'ASC',
            ]);

            return $this->render('proposal/appliers.html.twig', [
                'appliers' => $appliers,
            ]);
        } else {
            return new NotFoundResourceException('Offre d\'emploi avec la référence "' . $ref . '" introuvable');
        }
    }

    /**
     * @Route("/_populars", name="proposal_populars")
     */
    public function populars(ProposalRepository $proposalRepository): Response
    {
        $populars = $proposalRepository->getPopulars();

        return $this->render('_partials/popular-post.html.twig', [
            'populars' => $populars,
        ]);
    }
}
