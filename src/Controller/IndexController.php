<?php

namespace App\Controller;

use App\Entity\Admin\Service;
use App\Repository\Admin\ServiceRepository;
use App\Repository\Home\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(
        SlideRepository $slideRepository,
        ServiceRepository $serviceRepository
    ): Response
    {
        return $this->render('base.html.twig', [
            'slides' => $slideRepository->findAll(),
            'services' => $serviceRepository->findAll(),

        ]);
    }


    #[Route('/services', name: 'app_services_index', methods: ['GET'])]
    public function indexServices(ServiceRepository $serviceRepository): Response
    {
        return $this->render('client/services/allServices.html.twig', [
            'services' => $serviceRepository->findAll(),

        ]);
    }

    #[Route('services/{id}', name: 'app_client_service_show', methods: ['GET'])]
    public function showServices(Service $service): Response
    {
        return $this->render('client/services/serviceDetail.html.twig', [
            'service' => $service,
        ]);
    }
}
