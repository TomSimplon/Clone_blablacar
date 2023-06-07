<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Entity\Rule;
use App\Entity\Car;
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
        $rides = $ridesRepository->findBy([], ['id' => 'DESC']);

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


#[Route('/ride/user', name: 'user')]
    public function user(EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $cars = $entityManager->getRepository(Car::class)->findBy(['owner' => $user]);
        $rules = $entityManager->getRepository(Rule::class)->findBy(['author' => $user]);
        $rides = $entityManager->getRepository(Ride::class)->findBy(['driver' => $user]);
        // $rulesId = $entityManager->getRepository(Ride::class)->findBy(['rules' => $user]);

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('ride/user.html.twig', [
            'controller_name' => 'RideController',
            'cars' => $cars,
            'rules' => $rules,
            'rides' => $rides,
            // 'rulesId' => $rulesId
        ]);
    }

    
}
