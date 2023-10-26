<?php

namespace App\Controller;

use App\Entity\Admin\Blog;
use App\Entity\Admin\Message;
use App\Entity\Admin\Produit;
use App\Entity\Admin\Service;
use App\Form\Admin\MessageType;
use App\Repository\Admin\AproposRepository;
use App\Repository\Admin\BlogRepository;
use App\Repository\Admin\CertificationRepository;
use App\Repository\Admin\ContactRepository;
use App\Repository\Admin\EquipeRepository;
use App\Repository\Admin\home\AboutRepository;
use App\Repository\Admin\ProduitRepository;
use App\Repository\Admin\ServiceRepository;
use App\Repository\Admin\TemoignageRepository;
use App\Repository\Home\SlideRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        // $blogs = $blogRepository->findAll();
        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);



        return $this->render('base.html.twig', [
            'slides' => $slideRepository->findAll(),
            'services' => $services,
            'produits' => $produits,
            'apropos' => $aproposRepository->findAll(),
            'equipes' => $equipeRepository->findAll(),
            'abouts' => $aboutRepository->findAll(),
            // 'blogs' => $blogRepository->findAll(),
            'temoignages' => $temoignageRepository->findAll(),
            'blogs' => $blogs,




        ]);
    }


    #[Route('/services', name: 'app_services_index', methods: ['GET'])]
    public function indexServices(ServiceRepository $serviceRepository,BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);

        return $this->render('client/services/allServices.html.twig', [
            'services' => $serviceRepository->findAll(),
            'blogs' => $blogs,


        ]);
    }

    #[Route('services/{id}', name: 'app_client_service_show', methods: ['GET'])]
        
        public function showServices(Service $service,ServiceRepository $serviceRepository,BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);

        return $this->render('client/services/serviceDetail.html.twig', [
            'service' => $service,
            'services' => $serviceRepository->findAll(),
            'blogs' => $blogs,


        ]);
    }


    #[Route('/produits', name: 'app_produits_index', methods: ['GET'])]
    public function indexProduit(ProduitRepository $produitRepository,BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);

        return $this->render('client/produits/allProduits.html.twig', [
            'produits' => $produitRepository->findAll(),
            'blogs' => $blogs,


        ]);
    }

    #[Route('produits/{id}', name: 'app_client_produit_show', methods: ['GET'])]
    public function showProduit(Produit $produit,BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);
        


        return $this->render('client/produits/produitDetail.html.twig', [
            'produit' => $produit,
            'blogs' => $blogs,

        ]);
    }



    #[Route('/a-propos', name: 'app_apropos_index', methods: ['GET'])]
    public function indexApropos(ProduitRepository $produitRepository,BlogRepository $blogRepository,
    AproposRepository $aproposRepository,
    EquipeRepository $equipeRepository,
    ServiceRepository $serviceRepository,
    TemoignageRepository $temoignageRepository

    ): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);


        $services = $serviceRepository->findAll();
        $services = array_slice($services, 0, 3);
        return $this->render('client/apropos.html.twig', [
            'produits' => $produitRepository->findAll(),
            'apropos' => $aproposRepository->findAll(),
            'equipes' => $equipeRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'temoignages' => $temoignageRepository->findAll(),
            'blogs' => $blogs,

        ]);
    }

    #[Route('/blogs', name: 'app_blog_index', methods: ['GET'])]
    public function indexBlogs(BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        // $blogs = array_slice($blogs, 0, 3);

        return $this->render('client/blog.html.twig', [
            // 'blogs' => $blogRepository->findAll(),
            'blogs' => $blogs,
            

        ]);
    }

    #[Route('blog/{id}', name: 'app_client_blog_show', methods: ['GET'])]
    public function showBlog(Blog $blog,BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);

        return $this->render('client/blog/blogDetail.html.twig', [
            'blog' => $blog,
            'blogs' => $blogs,

        ]);
    }


    #[Route('/contacts', name: 'app_contact_index', methods: ['GET','POST'])]
    public function indexContact(Request $request, EntityManagerInterface $entityManager,BlogRepository $blogRepository,ContactRepository $contactRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('client/contact.html.twig', [
            // 'blogs' => $blogRepository->findAll(),
            'contacts' => $contactRepository->findAll(),
            'message' => $message,
            'form' => $form,
            'blogs' => $blogs,



        ]);
    }

    #[Route('/certification', name: 'app_certification_index', methods: ['GET'])]
    public function indexCert(CertificationRepository $certificationRepository,BlogRepository $blogRepository): Response
    {

        $blogs = $blogRepository->findBy([], ['date' => 'DESC'], 3);
        $blogs = array_slice($blogs, 0, 3);
        
        return $this->render('client/certification.html.twig', [
            'certifications' => $certificationRepository->findAll(),
            'blogs' => $blogs,

        ]);
    }

}
