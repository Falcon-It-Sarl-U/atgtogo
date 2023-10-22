<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Service;
use App\Form\Admin\ServiceType;
use App\Repository\Admin\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/service')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'app_admin_service_index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('admin/service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $service->setImage($nomImage);
            $image->move($this->getParameter('services_directory'), $nomImage);
            $service->setStatut(true);

            $image = $form->get('image2')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $service->setImage2($nomImage);
            $image->move($this->getParameter('services_directory'), $nomImage);
            $service->setStatut(true);

            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('admin/service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            
            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $service->setImage($nomImage);
            $image->move($this->getParameter('services_directory'), $nomImage);
            $service->setStatut(true);

            $image = $form->get('image2')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $service->setImage2($nomImage);
            $image->move($this->getParameter('services_directory'), $nomImage);
            $service->setStatut(true);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_service_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/activer', name: 'app_services_activer', methods: ['GET','POST'])]
    public function activer(Service $service, EntityManagerInterface $entityManager): Response
    {
        $service->setStatut(true);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin_service_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}/desactiver', name: 'app_services_desactiver', methods: ['GET','POST'])]
    public function desactiver(Service $service, EntityManagerInterface $entityManager): Response
    {
        $service->setStatut(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_service_index', [], Response::HTTP_SEE_OTHER);
    }
}
