<?php

namespace App\Controller;

use App\Entity\Ride;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    public function annonce(EntityManagerInterface $entityManager): Response
    {
        $ridesRepository = $entityManager->getRepository(Ride::class);
        $rides = $ridesRepository->findAll();

         return $this->render('ride/annonce.html.twig', [
            'controller_name' => 'RideController',
            'rides' => $rides
        ]);
    }

  #[Route('/ride/details/{id}', name: 'details')]
    public function details(EntityManagerInterface $entityManager, string $id): Response
    {
    $ridesRepository = $entityManager->getRepository(Ride::class);
    $ride = $ridesRepository->find($id);

    if(!$ride) {
        return $this->render('ride/details.html.twig');
    }

    return $this->render('ride/details.html.twig', [
        'controller_name' => 'RideController',
        'ride' => $ride
    ]);
}

#[Route('/user', name: 'user')]
    public function user(): Response
    {
        return $this->render('ride/user.html.twig', [
            'controller_name' => 'RideController',
        ]);
    }
    
}
