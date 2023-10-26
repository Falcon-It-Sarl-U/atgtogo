<?php

namespace App\Controller\Home;

use App\Entity\Home\Slide;
use App\Form\Home\SlideType;
use App\Repository\Home\SlideRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin//home/slide')]
class SlideController extends AbstractController
{
    #[Route('/', name: 'app_home_slide_index', methods: ['GET'])]
    public function index(SlideRepository $slideRepository): Response
    {
        return $this->render('admin/home/slide/index.html.twig', [
            'slides' => $slideRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_home_slide_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $slide = new Slide();
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $slide->setImage($nomImage);
            $image->move($this->getParameter('sliders_directory'), $nomImage);
            $slide->setStatut(true);


            $entityManager->persist($slide);
            $entityManager->flush();

            return $this->redirectToRoute('app_home_slide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/home/slide/new.html.twig', [
            'slide' => $slide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_slide_show', methods: ['GET'])]
    public function show(Slide $slide): Response
    {
        return $this->render('admin/home/slide/show.html.twig', [
            'slide' => $slide,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_home_slide_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Slide $slide, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $slide->setImage($nomImage);
            $image->move($this->getParameter('sliders_directory'), $nomImage);
            $slide->setStatut(true);

            $entityManager->flush();

            return $this->redirectToRoute('app_home_slide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/home/slide/edit.html.twig', [
            'slide' => $slide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_slide_delete', methods: ['POST'])]
    public function delete(Request $request, Slide $slide, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slide->getId(), $request->request->get('_token'))) {
            $entityManager->remove($slide);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_home_slide_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activer', name: 'app_slide_activer', methods: ['GET','POST'])]
    public function activer(Slide $slide, EntityManagerInterface $entityManager): Response
    {
        $slide->setStatut(true);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_home_slide_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}/desactiver', name: 'app_slide_desactiver', methods: ['GET','POST'])]
    public function desactiver(Slide $slide, EntityManagerInterface $entityManager): Response
    {
        $slide->setStatut(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_home_slide_index', [], Response::HTTP_SEE_OTHER);
    }



}
