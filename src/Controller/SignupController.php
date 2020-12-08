<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\User;
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
 * @Route("/inscription")
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
    private function createUserInfoForm(Request $request, User &$user, ?string $target = null): FormInterface
    {
        $attrs = [
            'class' => 'ajax-form-submit',
            'id' => uniqid('form-'),
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
    private function createUserAddressForm(Request $request, User &$user, ?string $target = null): FormInterface
    {
        $atts = [
            'class' => 'ajax-form-submit',
            'id' => uniqid('form-'),
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
     * @Route("/", name="signup")
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createUserInfoForm($request, $user, '#addresses');

        return $this->render('signup/index.html.twig', [
            'form' => $form->createView(),
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
    public function experiences(Request $request, User $user, ?Experience $experience = null): Response
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
                'id' => uniqid('form-'),
            ],
        ]);
        $form->handleRequest($request);

        return $this->render('signup/form/experience.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/experience/save/{user}/{experience}", 
     *      name="signup_experience_save", 
     *      requirements={"user": "\d+", "experience": "\d*"})
     */
    public function experiencesSave(Request $request, User $user, ?Experience $experience = null): Response
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
            'experience' => $experience,
            'refresh' => $this->generateUrl('signup_experiences', [
                'user' => $user->getId(),
                'experience' => $experience->getId(),
            ]),
            'user' => $user,
        ]);
    }
}
