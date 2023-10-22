<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Equipe;
use App\Form\Admin\EquipeType;
use App\Repository\Admin\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/equipe')]
class EquipeController extends AbstractController
{
    #[Route('/', name: 'app_admin_equipe_index', methods: ['GET'])]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('admin/equipe/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $equipe->setImage($nomImage);
            $image->move($this->getParameter('equipe_directory'), $nomImage);
            $equipe->setStatut(true);

            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipe_show', methods: ['GET'])]
    public function show(Equipe $equipe): Response
    {
        return $this->render('admin/equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $equipe->setImage($nomImage);
            $image->move($this->getParameter('equipe_directory'), $nomImage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_equipe_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activer', name: 'app_equipe_activer', methods: ['GET','POST'])]
    public function activer( Equipe $equipe,EntityManagerInterface $entityManager): Response
    {
        $equipe->setStatut(true);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}/desactiver', name: 'app_equipe_desactiver', methods: ['GET','POST'])]
    public function desactiver( Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        $equipe->setStatut(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_equipe_index', [], Response::HTTP_SEE_OTHER);
    }

}
