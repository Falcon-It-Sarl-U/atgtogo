<?php

namespace App\Controller;

use App\Entity\Admin\Produit;
use App\Entity\Admin\Service;
use App\Repository\Admin\AproposRepository;
use App\Repository\Admin\EquipeRepository;
use App\Repository\Admin\home\AboutRepository;
use App\Repository\Admin\ProduitRepository;
use App\Repository\Admin\ServiceRepository;
use App\Repository\Admin\TemoignageRepository;
use App\Repository\Home\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(
        SlideRepository $slideRepository,
        ServiceRepository $serviceRepository,
        ProduitRepository $produitRepository,
        AproposRepository $aproposRepository,
        EquipeRepository $equipeRepository,
        AboutRepository $aboutRepository
    ): Response
    {
        return $this->render('base.html.twig', [
            'slides' => $slideRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'produits' => $produitRepository->findAll(),
            'apropos' => $aproposRepository->findAll(),
            'equipes' => $equipeRepository->findAll(),
            'abouts' => $aboutRepository->findAll(),


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


    #[Route('/produits', name: 'app_produits_index', methods: ['GET'])]
    public function indexProduit(ProduitRepository $produitRepository): Response
    {
        return $this->render('client/produits/allProduits.html.twig', [
            'produits' => $produitRepository->findAll(),

        ]);
    }

    #[Route('produits/{id}', name: 'app_client_produit_show', methods: ['GET'])]
    public function showProduit(Produit $produit): Response
    {
        return $this->render('client/produits/produitDetail.html.twig', [
            'produit' => $produit,
        ]);
    }



    #[Route('/a-propos', name: 'app_apropos_index', methods: ['GET'])]
    public function indexApropos(ProduitRepository $produitRepository,
    AproposRepository $aproposRepository,
    EquipeRepository $equipeRepository,
    ServiceRepository $serviceRepository,
    TemoignageRepository $temoignageRepository

    ): Response
    {
        $services = $serviceRepository->findAll();
        $services = array_slice($services, 0, 3);
        return $this->render('client/apropos.html.twig', [
            'produits' => $produitRepository->findAll(),
            'apropos' => $aproposRepository->findAll(),
            'equipes' => $equipeRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'temoignages' => $temoignageRepository->findAll(),




        ]);
    }
    
}
