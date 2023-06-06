<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $user = $form->getData();
            $user->setCreated(new \DateTime());
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('user');
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }
        
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('ride/UserForm.html.twig', [
            'form' => $form
        ]);
    }
}