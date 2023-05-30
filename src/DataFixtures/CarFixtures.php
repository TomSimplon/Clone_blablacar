<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarFixtures extends AbstractFixtures implements DependentFixtureInterface
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures

    public function load(ObjectManager $manager)
    {

      
				// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < 10; $i ++) {

						// Instancie un objet Product avec un nom
            $Car= new Car();
            $Car->setBrand($this->faker->word());
            $Car->setModel($this->faker->word());
            $Car->setSeats($this->faker->numberBetween(1, 8));
            $Car->setCreated(new \DateTime());
            // Pour définir la catégorie en relation avec mon produit j'utilise la méthode getReference
			$Car->setOwner($this->getReference("user_" . $this->faker->numberBetween(0, 9)));

						// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($Car);
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