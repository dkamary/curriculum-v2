<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\ExperienceSkill;
use App\Entity\User;
use App\Form\UtilisateurAddressType;
use App\Form\UtilisateurExperienceSkillType;
use App\Form\UtilisateurExperienceType;
use App\Form\UtilisateurInfoType;
use App\Repository\SkillCategoryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/utilisateur")
 */
class UserController extends AbstractController
{
    /**
     * Get Experience Forms
     *
     * @param User $user
     * @return UtilisateurExperienceType[]
     */
    private function getExperienceForms(User $user): array
    {
        $forms = [];
        foreach ($user->getExperiences() as $exp) {
            $f = $this->createForm(UtilisateurExperienceType::class, $exp, [
                'action' => $this->generateUrl('user_experience', ['user' => $user->getId(), 'experience' => $exp->getId()]),
                'attr' => [
                    'id' => 'exp-' . $exp->getId()
                ]
            ]);
            $forms[] = $f->createView();
        }

        return $forms;
    }

    /**
     * Get Assoc experiences list
     *
     * @param User $user
     * @return array
     */
    private function getExperiences(User $user): array
    {
        $experiences = [];
        foreach ($user->getExperiences() as $exp) {
            $experiences[$exp->getId()] = $exp;
        }

        return $experiences;
    }

    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UtilisateurInfoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvel utilsateur créé');

            return $request->isXmlHttpRequest() ?
                new JsonResponse([
                    'done' => true,
                    'user' => $user,
                ]) :
                $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/address/{user}", name="user_address", methods={"GET", "POST"}, requirements={"user"="\d+"})
     */
    public function address(Request $request, User $user): Response
    {
        $form = $this->createForm(UtilisateurAddressType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Adresse mis à jour');

            return $this->redirectToRoute('user_experience', [
                'user' => $user->getId(),
            ]);
        }

        return $this->render('user/address.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/experience/{user}/{experience}", 
     *      name="user_experience", 
     *      methods={"GET", "POST"}, 
     *      requirements={"user"="\d+", "experience"="\d+"})
     */
    public function experience(Request $request, User $user, ?Experience $experience = null): Response
    {
        $experience = is_null($experience) ? new Experience() : $experience;
        $form = $this->createForm(UtilisateurExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $experience->setOwner($user);
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash('success', 'Expériences professionelles mis à jour');
        }

        return $this->render('user/experience.html.twig', [
            'user' => $user,
            'experience' => $experience,
            'form' => $form->createView(),
            'experiences' => $this->getExperienceForms($user),
            'experience_list' => $this->getExperiences($user),
        ]);
    }

    /**
     * @Route("/experience/skill/{experience}/{experienceSkill}",
     *      name="user_experience_skill",
     *      requirements={"experience"="\d+", "experienceSkill"="\d+"}
     * )
     */
    public function experienceSkill(
        Request $request,
        Experience $experience,
        ?ExperienceSkill $experienceSkill = null
    ): Response {
        VarDumper::dump($experienceSkill);
        $experienceSkill = is_null($experienceSkill) ? new ExperienceSkill() : $experienceSkill;
        VarDumper::dump($experienceSkill);
        $form = $this->createForm(UtilisateurExperienceSkillType::class, $experienceSkill);
        $form->handleRequest($request);
        VarDumper::dump($experienceSkill);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $experienceSkill->setExperience($experience);
            $entityManager->persist($experienceSkill);
            $entityManager->flush();

            return $request->isXmlHttpRequest() ?
                new JsonResponse([
                    'done' => true,
                    'user' => $experienceSkill,
                ]) :
                $this->redirectToRoute('user_experience', ['user' => $experience->getOwner()->getId(), 'experience' => $experience->getId()]);
        }

        return $this->render('user/experience-skill.html.twig', [
            'experience' => $experience,
            'experienceSkill' => $experienceSkill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/experience/skill/{experienceSkill}/delete", name="user_experience_skill_delete", requirements={"experienceSkill": "\d+"})
     */
    public function experienceSkillDelete(EntityManagerInterface $manager, ExperienceSkill $experienceSkill): Response
    {
        $manager->remove($experienceSkill);
        $manager->flush();

        return $this->json([
            'done' => true,
            'expSkill' => $experienceSkill->getId(),
        ]);
    }

    /**
     * @Route("/experience/skill/{experience}/add", name="user_experience_skill_add", requirements={"experience": "\d+"})
     */
    public function experienceSkillAdd(Experience $experience, SkillCategoryRepository $skillCategoryRepository): Response
    {
        $categories = $skillCategoryRepository->findBy([], ['name' => 'ASC']);

        return $this->render('user/experience-skill-add.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UtilisateurInfoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
