<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\LanguageKnowledge;
use App\Entity\Other;
use App\Entity\Training;
use App\Entity\User;
use App\Entity\UserMotivation;
use App\Form\UserLanguageKnowledgeType;
use App\Form\UserMotivationType;
use App\Form\UserOtherType;
use App\Form\UserTrainingType;
use App\Form\UtilisateurAddressType;
use App\Form\UtilisateurExperienceType;
use App\Form\UtilisateurInfoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/inscription-old")
 */
class SignupController extends AbstractController
{
    /**
     * Create form interface
     *
     * @param Request $request
     * @param User $user
     * @return FormInterface
     */
    private function createUserInfoForm(Request $request, User &$user, ?string $target = null, ?string $id = null): FormInterface
    {
        $attrs = [
            'class' => 'ajax-form-submit',
            'id' => $id ? $id : uniqid('form-'),
        ];
        if ($target) {
            $attrs['data-target'] = $target;
        }
        $form = $this->createForm(UtilisateurInfoType::class, $user, [
            'action' => $this->generateUrl('signup_new'),
            'method' => 'POST',
            'attr' => $attrs,
        ]);
        $form->handleRequest($request);

        return $form;
    }

    /**
     * Create address form interface
     *
     * @param Request $request
     * @param User $user
     * @param string|null $target
     * @return FormInterface
     */
    private function createUserAddressForm(Request $request, User &$user, ?string $target = null, ?string $id = null): FormInterface
    {
        $atts = [
            'class' => 'ajax-form-submit',
            'id' => $id ? $id : uniqid('form-'),
        ];
        if ($target) {
            $atts['data-target'] = $target;
        }
        $form = $this->createForm(UtilisateurAddressType::class, $user, [
            'action' => $this->generateUrl('signup_address_update', ['user' => $user->getId()]),
            'method' => 'POST',
            'attr' => $atts,
        ]);
        $form->handleRequest($request);

        return $form;
    }

    /**
     * @Route("/{user}", name="signup", requirements={"user": "\d+"})
     */
    public function index(Request $request, ?User $user = null): Response
    {
        $user = is_null($user) ? new User() : $user;
        $form = $this->createUserInfoForm($request, $user, '#addresses', 'information-form');

        return $this->render('signup/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/nouveau", name="signup_new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createUserInfoForm($request, $user);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->json([
            'done' => $user->getId() ? true : false,
            'user' => $user,
            'next' => $this->generateUrl('signup_address', ['user' => $user->getId()]),
        ]);
    }

    /**
     * @Route("/adresse/{user}", 
     *      name="signup_address", 
     *      requirements={"user"="\d+"})
     */
    public function address(Request $request, User $user): Response
    {
        $form = $this->createUserAddressForm($request, $user, '#experiences');

        return $this->render('signup/form/address.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }


    /**
     * @Route("/adresse/mise-a-jour/{user}", 
     *      name="signup_address_update", 
     *      requirements={"user"="\d+"})
     */
    public function addressUpdate(Request $request, User $user): Response
    {
        $form = $this->createUserAddressForm($request, $user);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->json([
            'done' => true,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/experiences/{user}/{experience}", 
     *      name="signup_experiences", 
     *      requirements={"user": "\d+", "experience": "\d*"})
     */
    public function experience(Request $request, User $user, ?Experience $experience = null): Response
    {
        $experience = is_null($experience) ? new Experience() : $experience;
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

    /**
     * @Route("/experiences/new/{user}", name="signup_experience_new", requirements={"user": "\d+"})
     */
    public function experienceNew(Request $request, User $user): Response
    {
        $experience = new Experience();
        $form = $this->createForm(UtilisateurExperienceType::class, $experience, [
            'action' => $this->generateUrl('signup_experience_save', [
                'user' => $user->getId(),
                'experience' => (int)$experience->getId(),
            ]),
            'method' => 'POST',
            'attr' => [
                'class' => 'ajax-form-submit',
                // 'id' => 'experience-form',
            ],
        ]);
        $form->handleRequest($request);

        return $this->render('signup/form/experience-new.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'experienceId' => (int)$experience->getId(),
        ]);
    }

    /**
     * @Route("/experience/save/{user}/{experience}", 
     *      name="signup_experience_save", 
     *      requirements={"user": "\d+", "experience": "\d*"})
     */
    public function experienceSave(Request $request, User $user, ?Experience $experience = null): Response
    {
        $experience = is_null($experience) ? new Experience() : $experience;
        $form = $this->createForm(UtilisateurExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $experience->setOwner($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($experience);
            $manager->flush();
        }

        return $this->json([
            'done' => $experience->getId() ? true : false,
            'experienceId' => $experience->getId(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/experience/delete/{experience}", 
     *      name="signup_experience_delete", 
     *      requirements={"experience": "\d+"})
     */
    public function experienceDelete(Request $request, Experience $experience): Response
    {
        if ($experience) {
            $manager = $this->getDoctrine()->getManager();
            foreach ($experience->getExperienceSkills() as $expSkill) {
                $manager->remove($expSkill);
            }
            $manager->remove($experience);
            $manager->flush();
        }

        return $this->json([
            'done' => $experience->getId() ? false : true,
            'experienceId' => $experience->getId(),
        ]);
    }

    /**
     * @Route("/training/{user}/{training}", name="signup_training", requirements={"user": "\d+", "training": "\d+"})
     */
    public function training(Request $request, User $user, ?Training $training = null): Response
    {
        $training = is_null($training) ? new Training() : $training;
        $form = $this->createForm(UserTrainingType::class, $training, [
            'action' => $this->generateUrl('signup_training_save', [
                'user' => $user->getId(),
                'training' => (int)$training->getId(),
            ]),
            'method' => 'POST',
            'attr' => [
                'id' => 'training-form',
            ],
        ]);
        $form->handleRequest($request);

        return $this->render('signup/form/training.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'training' => $training,
        ]);
    }

    /**
     * @Route("/training/save/{user}/{training}", name="signup_training_save", requirements={"user": "\d+", "training": "\d+"})
     */
    public function trainingSave(Request $request, User $user, ?Training $training = null): Response
    {
        $training = is_null($training) ? new Training() : $training;
        $form = $this->createForm(UserTrainingType::class, $training);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training->setOwner($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($training);
            $manager->flush();
        }

        return $this->json([
            'done' => $training->getId() ? true : false,
            'user' => $user,
            'trainingId' => $training->getId(),
        ]);
    }

    /**
     * @Route("/other/{user}/{other}", name="signup_other", requirements={"user" : "\d+", "other" : "\d+"})
     */
    public function others(Request $request, User $user, ?Other $other = null): Response
    {
        $other = is_null($other) ? new Other() : $other;
        $form = $this->createForm(UserOtherType::class, $other, [
            'action' => $this->generateUrl('signup_other_save', [
                'user' => $user->getId(),
                'other' => (int)$other->getId(),
            ]),
            'method' => 'POST',
            'attr' => [
                'class' => 'other-forms',
            ],
        ]);
        $form->handleRequest($request);

        return $this->render('signup/form/other.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'otherId' => $other->getId(),
        ]);
    }

    /**
     * @Route("/other/save/{user}/{other}", name="signup_other_save", requirements={"user" : "\d+", "other" : "\d+"})
     */
    public function otherSave(Request $request, User $user, ?Other $other = null): Response
    {
        $other = is_null($other) ? new Other() : $other;
        $form = $this->createForm(UserOtherType::class, $other);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $other->setOwner($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($other);
            $manager->flush();
        }

        return $this->json([
            'done' => $other->getId() ? true : false,
            'user' => $user,
            'otherId' => $other->getId(),
        ]);
    }

    /**
     * @Route("/language/{user}/{language}", name="signup_language", requirements={"user": "\d+", "language": "\d+"})
     */
    public function language(Request $request, User $user, ?LanguageKnowledge $languageKnowledge = null): Response
    {
        $languageKnowledge = is_null($languageKnowledge) ? new LanguageKnowledge() : $languageKnowledge;
        $form = $this->createForm(UserLanguageKnowledgeType::class, $languageKnowledge);

        return $this->render('signup/form/language.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'languageKnowledgeId' => (int)$languageKnowledge->getId(),
        ]);
    }

    /**
     * @Route("/language/save/{user}/{language}", name="signup_language_save", requirements={"user": "\d+", "language": "\d+"})
     */
    public function languageSave(Request $request, User $user, ?LanguageKnowledge $languageKnowledge = null): Response
    {
        $languageKnowledge = is_null($languageKnowledge) ? new LanguageKnowledge() : $languageKnowledge;
        $form = $this->createForm(UserLanguageKnowledgeType::class, $languageKnowledge);
        if ($form->isSubmitted() && $form->isValid()) {
            $languageKnowledge->setOwner($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($languageKnowledge);
            $manager->flush();
        }

        return $this->json([
            'done' => $languageKnowledge->getId() ? true : false,
            'user' => $user,
            'languageKnowledgeId' => (int)$languageKnowledge->getId(),
        ]);
    }

    /**
     * @Route("/motivation/{user}/{motivation}", name="signup_motivation", requirements={"user": "\d+", "motivation": "\d+"})
     */
    public function motivation(Request $request, User $user, ?UserMotivation $userMotivation = null): Response
    {
        $userMotivation = is_null($userMotivation) ? new UserMotivation() : $userMotivation;
        $form = $this->createForm(UserMotivationType::class, $userMotivation);

        return $this->render('signup/form/motivation.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'UserMotivationId' => (int)$userMotivation->getId(),
        ]);
    }

    /**
     * @Route("/motivation/save/{user}/{motivation}", name="signup_motivation_save", requirements={"user": "\d+", "motivation": "\d+"})
     */
    public function motivationSave(Request $request, User $user, ?UserMotivation $userMotivation = null): Response
    {
        $userMotivation = is_null($userMotivation) ? new UserMotivation() : $userMotivation;
        $form = $this->createForm(UserMotivationType::class, $userMotivation);
        if ($form->isSubmitted() && $form->isValid()) {
            $userMotivation->setOwner($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($userMotivation);
            $manager->flush();
        }

        return $this->json([
            'done' => $userMotivation->getId() ? true : false,
            'user' => $user,
            'UserMotivationId' => (int)$userMotivation->getId(),
        ]);
    }
}
