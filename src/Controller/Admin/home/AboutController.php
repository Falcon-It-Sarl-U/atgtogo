<?php

namespace App\Controller\Admin\home;

use App\Entity\Admin\home\About;
use App\Form\Admin\home\AboutType;
use App\Repository\Admin\home\AboutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/home/about')]
class AboutController extends AbstractController
{
    #[Route('/', name: 'app_admin_home_about_index', methods: ['GET'])]
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('admin/home/about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_home_about_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $about = new About();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $about->setStatut(true);
            $entityManager->persist($about);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_home_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/home/about/new.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_home_about_show', methods: ['GET'])]
    public function show(About $about): Response
    {
        return $this->render('admin/home/about/show.html.twig', [
            'about' => $about,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_home_about_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, About $about, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_home_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/home/about/edit.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_home_about_delete', methods: ['POST'])]
    public function delete(Request $request, About $about, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$about->getId(), $request->request->get('_token'))) {
            $entityManager->remove($about);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_home_about_index', [], Response::HTTP_SEE_OTHER);
    }
}
