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

      $users = [
    [
        'email' => 'john@example.com',
        'password' => 'password123',
        'roles' => ['passager'],
        'prenom' => 'John',
        'nom' => 'Doe',
        'telephone' => '1234567890',
        'date_creation' => '2021-01-01',
    ],
    [
        'email' => 'jane@example.com',
        'password' => 'password456',
        'roles' => ['passager'],
        'prenom' => 'Jane',
        'nom' => 'Smith',
        'telephone' => '9876543210',
        'date_creation' => '2021-02-15',
    ],
    [
        'email' => 'alice@example.com',
        'password' => 'password789',
        'roles' => ['passager'],
        'prenom' => 'Alice',
        'nom' => 'Johnson',
        'telephone' => '5555555555',
        'date_creation' => '2021-03-10',
    ],
    [
        'email' => 'bob@example.com',
        'password' => 'passwordabc',
        'roles' => ['conducteur'],
        'prenom' => 'Bob',
        'nom' => 'Williams',
        'telephone' => '9999999999',
        'date_creation' => '2021-04-22',
    ],
    [
        'email' => 'emma@example.com',
        'password' => 'passworddef',
        'roles' => ['passager'],
        'prenom' => 'Emma',
        'nom' => 'Brown',
        'telephone' => '1111111111',
        'date_creation' => '2021-05-05',
    ],
    [
        'email' => 'michael@example.com',
        'password' => 'passwordghi',
        'roles' => ['conducteur'],
        'prenom' => 'Michael',
        'nom' => 'Davis',
        'telephone' => '2222222222',
        'date_creation' => '2021-06-30',
    ],
    [
        'email' => 'sarah@example.com',
        'password' => 'passwordjkl',
        'roles' => ['passager'],
        'prenom' => 'Sarah',
        'nom' => 'Taylor',
        'telephone' => '7777777777',
        'date_creation' => '2021-07-14',
    ],
    [
        'email' => 'alex@example.com',
        'password' => 'passwordmno',
        'roles' => ['conducteur'],
        'prenom' => 'Alex',
        'nom' => 'Wilson',
        'telephone' => '8888888888',
        'date_creation' => '2021-08-20',
    ],
    [
        'email' => 'laura@example.com',
        'password' => 'passwordpqr',
        'roles' => ['passager'],
        'prenom' => 'Laura',
        'nom' => 'Anderson',
        'telephone' => '3333333333',
        'date_creation' => '2021-09-08',
    ],
    [
        'email' => 'peter@example.com',
        'password' => 'passwordstu',
        'roles' => ['passager'],
        'prenom' => 'Peter',
        'nom' => 'Martin',
        'telephone' => '4444444444',
        'date_creation' => '2021-10-18',
    ],
];
				// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < $users; $i ++) {

						// Instancie un objet Product avec un nom
            $User = new User();
            $User->setEmail($this->faker->word());
            $User->setPassword($this->faker->word());
            $User->setFirstName($this->faker->word());
            $User->setLastName($this->faker->word());
            $User->setPhone(intval($this->faker->phoneNumber()));

						// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($User);
        }

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }
}