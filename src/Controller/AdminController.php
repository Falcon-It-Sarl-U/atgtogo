<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function indexAdmin(): Response
    {
        // return $this->render('admin/dashboardAdmin.html.twig');
        return $this->render('baseAdmin.html.twig');
    }

  
}
