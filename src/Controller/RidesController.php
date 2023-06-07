<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Entity\Rule;
use App\Form\RideType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RidesController extends AbstractController
{

  private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    #[Route('/ride', name: 'app_ride')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $ride = new Ride();
        $user = $this->getUser();
        $rules = $user ? $entityManagerInterface->getRepository(Rule::class)->findBy(['author' => $user]) : [];

        $form = $this->createForm(RideType::class, $ride);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $ride = $form->getData();
            $ride->setCeated(new \DateTime());
            $ride->setDriver($user);
            $entityManagerInterface->persist($ride);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('annonce');
  
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }
        
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('ride/ride.html.twig', [
            'form' => $form,
            'rules' => $rules
        ]);
    }

    public function details(Ride $ride)
    {
    // Récupérez les règles associées à l'annonce
    $rules = $ride->getRules();

    return $this->render('ride/details.html.twig', [
        'ride' => $ride,
        'rules' => $rules,
    ]);
  }

  #[Route('/ride/delete/{id}', name: 'ride_delete')]
public function delete(Ride $ride, EntityManagerInterface $entityManager): Response
{
    $entityManager->remove($ride);
    $entityManager->flush();

    return $this->redirectToRoute('annonce');
}

#[Route('/ride/edit/{id}', name: 'ride_edit')]
public function edit(Ride $ride, Request $request, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(RideType::class, $ride);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        // Redirigez l'utilisateur vers la page de détails de l'annonce ou toute autre page appropriée
        return $this->redirectToRoute('details', ['id' => $ride->getId()]);
    }

    return $this->render('ride/ride.html.twig', [
        'form' => $form->createView(),
    ]);
}

}