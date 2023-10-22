<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Temoignage;
use App\Form\Admin\TemoignageType;
use App\Repository\Admin\TemoignageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/temoignage')]
class TemoignageController extends AbstractController
{
    #[Route('/', name: 'app_admin_temoignage_index', methods: ['GET'])]
    public function index(TemoignageRepository $temoignageRepository): Response
    {
        return $this->render('admin/temoignage/index.html.twig', [
            'temoignages' => $temoignageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_temoignage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $temoignage = new Temoignage();
        $form = $this->createForm(TemoignageType::class, $temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temoignage->setStatut(true);

            $entityManager->persist($temoignage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_temoignage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/temoignage/new.html.twig', [
            'temoignage' => $temoignage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_temoignage_show', methods: ['GET'])]
    public function show(Temoignage $temoignage): Response
    {
        return $this->render('admin/temoignage/show.html.twig', [
            'temoignage' => $temoignage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_temoignage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Temoignage $temoignage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TemoignageType::class, $temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_temoignage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/temoignage/edit.html.twig', [
            'temoignage' => $temoignage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_temoignage_delete', methods: ['POST'])]
    public function delete(Request $request, Temoignage $temoignage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$temoignage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($temoignage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_temoignage_index', [], Response::HTTP_SEE_OTHER);
    }
}
