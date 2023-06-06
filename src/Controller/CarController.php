<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CarController extends AbstractController
{

  private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    #[Route('/car', name: 'app_car')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $car = new Car();
        $user = $this->security->getUser();

        $form = $this->createForm(CarType::class, $car);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $car = $form->getData();
            $car->setCreated(new \DateTime());
            $car->setOwner($user);
            $entityManagerInterface->persist($car);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('user');
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('ride/car.html.twig', [
            'form' => $form
        ]);
    }
}
