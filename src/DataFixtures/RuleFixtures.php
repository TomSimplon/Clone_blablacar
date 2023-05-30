<?php

namespace App\DataFixtures;

use App\Entity\Rule;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RuleFixtures extends AbstractFixtures implements DependentFixtureInterface
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures

    public function load(ObjectManager $manager)
    {

      
		// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < 10; $i ++) {

			// Instancie un objet Product avec un nom
            $Rule= new Rule();
            $Rule->setName($this->faker->word());
            $Rule->setDescription($this->faker->word());
            // Pour définir la catégorie en relation avec mon produit j'utilise la méthode getReference
			      $Rule->setAuthor($this->getReference("user_" . $this->faker->numberBetween(0, 9)));

			// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($Rule);
            $this->setReference('rule_' . $i, $Rule);
        }

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }

    public function getDependencies()
    {
     return[
        UserFixtures::class,
     ];   
    }
}