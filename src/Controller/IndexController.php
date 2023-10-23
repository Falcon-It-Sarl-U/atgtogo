<?php

namespace App\Controller;

use App\Entity\Admin\Blog;
use App\Entity\Admin\Produit;
use App\Entity\Admin\Service;
use App\Repository\Admin\AproposRepository;
use App\Repository\Admin\BlogRepository;
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
        AboutRepository $aboutRepository,
        TemoignageRepository $temoignageRepository,
        BlogRepository $blogRepository
    ): Response
    {
        $services = $serviceRepository->findAll();
        $services = array_slice($services, 0, 4);

        $produits = $produitRepository->findAll();
        $produits = array_slice($produits, 0, 3);

        $blogs = $blogRepository->findAll();
        $blogs = array_slice($blogs, 0, 3);



        return $this->render('base.html.twig', [
            'slides' => $slideRepository->findAll(),
            'services' => $services,
            'produits' => $produits,
            'apropos' => $aproposRepository->findAll(),
            'equipes' => $equipeRepository->findAll(),
            'abouts' => $aboutRepository->findAll(),
            'blogs' => $blogRepository->findAll(),
            'temoignages' => $temoignageRepository->findAll(),
            'blogs' => $blogs,




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
        
        public function showServices(Service $service,ServiceRepository $serviceRepository,): Response
    {
        return $this->render('client/services/serviceDetail.html.twig', [
            'service' => $service,
            'services' => $serviceRepository->findAll(),

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

    #[Route('/blogs', name: 'app_blog_index', methods: ['GET'])]
    public function indexBlogs(BlogRepository $blogRepository): Response
    {
        return $this->render('client/blog.html.twig', [
            'blogs' => $blogRepository->findAll(),

        ]);
    }

    #[Route('blog/{id}', name: 'app_client_blog_show', methods: ['GET'])]
    public function showBlog(Blog $blog): Response
    {
        return $this->render('client/blog/blogDetail.html.twig', [
            'blog' => $blog,
        ]);
    }


    #[Route('/contacts', name: 'app_contact_index', methods: ['GET'])]
    public function indexContact(BlogRepository $blogRepository): Response
    {
        return $this->render('client/contact.html.twig', [
            'blogs' => $blogRepository->findAll(),

        ]);
    }

    
}
