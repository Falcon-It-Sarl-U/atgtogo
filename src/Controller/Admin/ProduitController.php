<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Produit;
use App\Form\Admin\ProduitType;
use App\Repository\Admin\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_admin_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $produit->setImage($nomImage);
            $image->move($this->getParameter('produits_directory'), $nomImage);
            $produit->setStatut(true);

            $image = $form->get('image2')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $produit->setImage2($nomImage);
            $image->move($this->getParameter('produits_directory'), $nomImage);
            $produit->setStatut(true);


            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $image = $form->get('image')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $produit->setImage($nomImage);
            $image->move($this->getParameter('produits_directory'), $nomImage);
            $produit->setStatut(true);

            $image = $form->get('image2')->getData();
            $nomImage = md5(uniqid()) . '.' . $image->guessExtension();
            $produit->setImage2($nomImage);
            $image->move($this->getParameter('produits_directory'), $nomImage);
            $produit->setStatut(true);



            $entityManager->flush();

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/activer', name: 'app_produit_activer', methods: ['GET','POST'])]
    public function activer( Produit $produit,EntityManagerInterface $entityManager): Response
    {
        $produit->setStatut(true);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}/desactiver', name: 'app_produit_desactiver', methods: ['GET','POST'])]
    public function desactiver( Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $produit->setStatut(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }


}
