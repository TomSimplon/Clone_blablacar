<?php

namespace App\Controller;

use App\Entity\Ride;
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
        $user = $this->security->getUser();

        $form = $this->createForm(RideType::class, $ride);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

          // dd($ride);
            
						// Persiste les données du formulaire dans l'entité Demo
            $ride = $form->getData();
            $ride->setCeated(new \DateTime());
            $ride->setDriver($user);
            $entityManagerInterface->persist($ride);
            $entityManagerInterface->flush();
  
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }

        return $this->render('ride/ride.html.twig', [
            'form' => $form
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

}