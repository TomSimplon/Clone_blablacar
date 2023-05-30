<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures

    public function load(ObjectManager $manager)
    {

      
				// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < 10; $i ++) {

						// Instancie un objet Product avec un nom
            $User = new User();
            $User->setEmail($this->faker->word());
            $User->setPassword($this->faker->word());
            $User->setFirstName($this->faker->word());
            $User->setLastName($this->faker->word());
            $User->setPhone(intval($this->faker->phoneNumber()));
            $User->setCreated(new \DateTime());

						// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($User);
            $this->setReference('user_' . $i, $User);
        }

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }
}
