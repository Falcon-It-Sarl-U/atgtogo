<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Apropos;
use App\Form\Admin\AproposType;
use App\Repository\Admin\AproposRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/apropos')]
class AproposController extends AbstractController
{
    #[Route('/', name: 'app_admin_apropos_index', methods: ['GET'])]
    public function index(AproposRepository $aproposRepository): Response
    {
        return $this->render('admin/apropos/index.html.twig', [
            'apropos' => $aproposRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_apropos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $apropo = new Apropos();
        $form = $this->createForm(AproposType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $apropo->setStatut(true);
            $entityManager->persist($apropo);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_apropos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/apropos/new.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apropos_show', methods: ['GET'])]
    public function show(Apropos $apropo): Response
    {
        return $this->render('admin/apropos/show.html.twig', [
            'apropo' => $apropo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_apropos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apropos $apropo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AproposType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_apropos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/apropos/edit.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apropos_delete', methods: ['POST'])]
    public function delete(Request $request, Apropos $apropo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apropo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($apropo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_apropos_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/activer', name: 'app_apropos_activer', methods: ['GET','POST'])]
    public function activer( Apropos $apropo,EntityManagerInterface $entityManager): Response
    {
        $apropo->setStatut(true);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin_apropos_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}/desactiver', name: 'app_apropos_desactiver', methods: ['GET','POST'])]
    public function desactiver( Apropos $apropo, EntityManagerInterface $entityManager): Response
    {
        $apropo->setStatut(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_apropos_index', [], Response::HTTP_SEE_OTHER);
    }

}
