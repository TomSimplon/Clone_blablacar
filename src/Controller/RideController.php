<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RideController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('ride/homepage.html.twig', [
            'controller_name' => 'RideController',
        ]);
    }

    #[Route('/annonce', name: 'annonce')]
    public function annonce(): Response
    {
         return $this->render('ride/annonce.html.twig', [
            'controller_name' => 'RideController',
        ]);
    }

    
}
