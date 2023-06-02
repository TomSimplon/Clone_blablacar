<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Form\RideType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RidesController extends AbstractController
{
    #[Route('/ride', name: 'app_ride')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $ride = new Ride();

        $form = $this->createForm(RideType::class, $ride);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $ride = $form->getData();
            $ride->setCeated(new \DateTime());
            $entityManagerInterface->persist($ride);
            $entityManagerInterface->flush();
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }

        return $this->render('ride/ride.html.twig', [
            'form' => $form
        ]);
    }
}