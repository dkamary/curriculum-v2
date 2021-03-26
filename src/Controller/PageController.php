<?php

namespace App\Controller;

use App\Entity\Applier;
use App\Form\ApplierNewType;
use App\Repository\ProposalRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\VarDumper\VarDumper;

class PageController extends AbstractController
{
    /**
     * @Route("/{slug}.html", name="page")
     */
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/offres/{slug}", name="proposal_show", requirements={ "slug" = "[a-zA-Z0-9_-]+" })
     */
    public function proposal(string $slug, Request $request, ProposalRepository $proposalRepository): Response
    {
        $proposal = $proposalRepository->findOneBy(['slug' => $slug]);
        if (!$proposal) {
            throw new NotFoundResourceException("L'offre d'emploi `$slug` est introuvable");
        }

        $applier = new Applier();
        $form = $this->createForm(ApplierNewType::class, $applier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $applier
                ->setOwner($user)
                ->setProposal($proposal)
                ->setApplyDate(new DateTime());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($applier);
            $manager->flush();

            $this->addFlash('success', 'Votre candidature à cette annonce à été enregistrée');

            return $this->redirectToRoute('proposal_show', ['slug' => $proposal->getSlug()]);
        }

        return $this->render('proposal/show.html.twig', [
            'proposal' => $proposal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/user", name="front_user_update")
     */
    public function udpate(UserRepository $userRepository, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager): Response
    {
        foreach ($userRepository->findAll() as $user) {
            $encoded = $encoder->encodePassword($user, '123');
            $user->setPassword($encoded);
            VarDumper::dump($user);
        }
        $manager->flush();

        return new Response('done');
    }
}
