<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Certification;
use App\Form\Admin\CertificationType;
use App\Repository\Admin\CertificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/certification')]
class CertificationController extends AbstractController
{
    #[Route('/', name: 'app_admin_certification_index', methods: ['GET'])]
    public function index(CertificationRepository $certificationRepository): Response
    {
        return $this->render('admin/certification/index.html.twig', [
            'certifications' => $certificationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_certification_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $certification = new Certification();
        $form = $this->createForm(CertificationType::class, $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $certification->setImage($nomImage);
            $image->move($this->getParameter('certification_directory'), $nomImage);
            // $certification->setStatut(true);

            $entityManager->persist($certification);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_certification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/certification/new.html.twig', [
            'certification' => $certification,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_certification_show', methods: ['GET'])]
    public function show(Certification $certification): Response
    {
        return $this->render('admin/certification/show.html.twig', [
            'certification' => $certification,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_certification_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Certification $certification, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CertificationType::class, $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $certification->setImage($nomImage);
            $image->move($this->getParameter('certification_directory'), $nomImage);
            // $certification->setStatut(true)
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_certification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/certification/edit.html.twig', [
            'certification' => $certification,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_certification_delete', methods: ['POST'])]
    public function delete(Request $request, Certification $certification, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certification->getId(), $request->request->get('_token'))) {
            $entityManager->remove($certification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_certification_index', [], Response::HTTP_SEE_OTHER);
    }
}
