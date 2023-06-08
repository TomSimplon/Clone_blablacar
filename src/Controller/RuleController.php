<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\RuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RuleController extends AbstractController
{

  private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    #[Route('/rule', name: 'app_rule')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
      
        $rule = new Rule();
        $user = $this->security->getUser();

        $form = $this->createForm(RuleType::class, $rule);

				// Ecoute la soumission du formulaire
				$form->handleRequest($request);

				// Condition valide lorsque le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
						// Persiste les données du formulaire dans l'entité Demo
            $rule = $form->getData();
            $rule->setAuthor($user);
            $entityManagerInterface->persist($rule);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('user');
            // Exécuter la logique que vous souhaitez
						// par exemple enregistrer la nouvelle entité en base de données

        }
        
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('ride/rule.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/rule/edit/{id}', name: 'rule_edit')]
    public function editRule(Rule $rule, Request $request, EntityManagerInterface $entityManager): Response
    {
    if ($rule->getAuthor() !== $this->getUser()) {
        throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cette règle');
    }

    $form = $this->createForm(RuleType::class, $rule);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('user');
    }

    return $this->render('ride/rule.html.twig', [
        'form' => $form->createView(),
    ]);
}
}