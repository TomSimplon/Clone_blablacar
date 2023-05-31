<?php

namespace App\DataFixtures;

use App\Entity\Ride;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RideFixtures extends AbstractFixtures implements DependentFixtureInterface
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures

    public function load(ObjectManager $manager)
    {

      
		// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < 10; $i ++) {

			// Instancie un objet Product avec un nom
            $Ride= new Ride();
            $Ride->setDeparture($this->faker->word());
            $Ride->setDestination($this->faker->word());
            $Ride->setSeats($this->faker->numberBetween(1, 8));
            $Ride->setPrice($this->faker->randomFloat(2, 10, 100));
            $Ride->setDate(new \DateTime());
            // Pour définir la catégorie en relation avec mon produit j'utilise la méthode getReference
            $Ride->setDriver($this->getReference("user_" . $this->faker->numberBetween(0, 9)));
            $Ride->setCeated(new \DateTime());

            for($o = 0; $o < 3; $o++) {
              $Ride->addRule($this->getReference('rule_' . $this->faker->numberBetween(0, 9)));
            }

			// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($Ride);
        }

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }

    public function getDependencies()
    {
     return[
        UserFixtures::class,
        RuleFixtures::class,
     ];   
    }
}
