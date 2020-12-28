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
use Exception;
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
     * @Route("/adresse", name="user_address2", methods={"GET", "POST"})
     */
    public function address2(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UtilisateurAddressType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Adresse mis à jour');

            return $this->redirectToRoute('user_address2');
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
     * @Route("/experiences", name="user_experiences")
     */
    public function experiences(Request $request): Response
    {
        $user = $this->getUser();
        $experience = new Experience();
        $form = $this->createForm(UtilisateurExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $experience->setOwner($user);
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash('success', 'Expérience professionelle ajoutée');
        }

        return $this->render('user/experiences.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/experiences/{id}/edit", name="user_experience_edit", requirements={"id"="\d+"})
     */
    public function experienceEdit(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(UtilisateurExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('success', 'Expérience professionelle mis à jour');
        }

        $skill = new ExperienceSkill();
        $skillForm = $this->createForm(UtilisateurExperienceSkillType::class, $skill);
        $skillForm->handleRequest($request);

        if ($skillForm->isSubmitted() && $skillForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $skill->setExperience($experience);
            $manager->persist($skill);
            try {
                $manager->flush();
                $this->addFlash('success', 'Nouvelle compétence ajoutée');
            } catch (Exception $ex) {
                $previous = $ex->getPrevious();
                if (23000 == $previous->getCode()) {
                    $this->addFlash('warning', 'Une compétence ne peut pas apparaitre 2 fois dans une expérience professionnelle');
                } else {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'enregistrement de la nouvelle compétence ' . $previous->getCode());
                }
            }
        }

        return $this->render('user/experience-edit.html.twig', [
            'form' => $form->createView(),
            'skill_form' => $skillForm->createView(),
            'experience' => $experience,
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
        $id = $experienceSkill->getId();
        $manager->remove($experienceSkill);
        $manager->flush();

        return $this->json([
            'done' => true,
            'skill' => [
                'id' => $id,
            ],
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
     * @Route("/{id}", name="user_show", methods={"GET"}, requirements={ "id" : "\d+" })
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
     * @Route("/edition", name="user_edition", methods={"GET","POST"})
     */
    public function edit2(Request $request): Response
    {
        $user = $this->getUser();
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

    /**
     * @Route("/", name="user_experience_2")
     */
    public function experience2(Request $request): Response
    {
        $user = $this->getUser();
        $experience = new Experience();
        $form = $this->createForm(UtilisateurExperienceType::class, $experience, [
            'action' => $this->generateUrl('signup_experience_save', [
                'user' => $user->getId(),
                'experience' => $experience->getId(),
            ]),
            'method' => 'POST',
            'attr' => [
                'class' => 'ajax-form-submit',
                'id' => 'experience-form',
            ],
        ]);
        $form->handleRequest($request);

        return $this->render('signup/form/experience.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'experienceId' => $experience->getId(),
        ]);
    }
}