<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\RuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RuleController extends AbstractController
{
    #[Route('/rule', name: 'app_rule')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $rule = new Rule();

        $form = $this->createForm(RuleType::class, $rule);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $rule = $form->getData();
            $entityManagerInterface->persist($rule);
            $entityManagerInterface->flush();
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }

        return $this->render('ride/rule.html.twig', [
            'form' => $form
        ]);
    }
}