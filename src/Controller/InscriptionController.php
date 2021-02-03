<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UtilisateurAddressType;
use App\Form\UtilisateurInfoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("inscription")
 */
class InscriptionController extends AbstractController
{
    /**
     * @Route("/", name="user_inscription")
     */
    public function information(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UtilisateurInfoType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Nouvel utilsateur créé');

            if ($user->getId()) {
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));
                $this->addFlash('info', sprintf('Vous êtes connecté en tant que <b>"%s"</b><br>Veuillez continuer à remplir vos informations', $user->getEmail()));

                return $this->redirectToRoute('user_address2');
            }
        }

        return $this->render('inscription/information.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
