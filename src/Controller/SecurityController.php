<?php

namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/maleteo/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout() {
        return $this->redirectToRoute('maleteo-home');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function newUser(Request $request, EntityManagerInterface $doctrine, UserPasswordEncoderInterface $passwordEncoder) {
        $user = new User();
        $user->setUsername($request->get("username"));
        $user->setPassword($passwordEncoder->encodePassword($user, $request->get("password")));
        //$user->setRoles($request->get('roles'));

        $doctrine->persist($user);
        $doctrine->flush();

        return $this->render('success-register.html.twig');
    }
}