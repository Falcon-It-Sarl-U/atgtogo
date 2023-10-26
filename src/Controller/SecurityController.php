<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\Admin\BlogRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, BlogRepository $blogRepository): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

            
            return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error,'blogs' => $blogs,]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }






    #[Route('/boss/atg/', name: 'ajouter_moi')]
    public function ajouterClient(AuthenticationUtils $authenticationUtils,Request $request, 
    EntityManagerInterface $entityManager,UserRepository $userRepository,
    UserPasswordHasherInterface $passwordHasher,BlogRepository $blogRepository,
    ): Response
    {
        $user = new User();
 
        $form = $this->createForm(UserType::class, $user);
        $error = $authenticationUtils->getLastAuthenticationError();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home_slide_index');
        }
        $blogs = $blogRepository-> findBy([], ['date' => 'DESC'], 3);

        return $this->render('security/register.html.twig', [

        'user' => $userRepository->findAll(),
        'form' => $form->createView(),
        'blogs' => $blogs,
        'error' => $error,

        ]);
    }






















}
